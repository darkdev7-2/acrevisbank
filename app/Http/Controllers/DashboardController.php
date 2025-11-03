<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // Get all accounts for the user
        $accounts = $user->accounts()->where('is_active', true)->get();

        // Get recent transactions across all accounts (last 10)
        $recentTransactions = Transaction::whereIn('account_id', $accounts->pluck('id'))
            ->orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();

        // Calculate total balance
        $totalBalance = $accounts->sum('balance');

        return view('pages.dashboard.index', compact('user', 'accounts', 'recentTransactions', 'totalBalance'));
    }

    public function account(Request $request, $locale, $id)
    {
        $user = Auth::user();
        $account = Account::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Build query with filters
        $query = $account->transactions()->orderBy('transaction_date', 'desc');

        // Apply filters
        if ($request->has('date_from') && $request->date_from) {
            $query->where('transaction_date', '>=', Carbon::parse($request->date_from));
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('transaction_date', '<=', Carbon::parse($request->date_to)->endOfDay());
        }

        if ($request->has('type') && $request->type && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->has('min_amount') && $request->min_amount) {
            $query->where('amount', '>=', $request->min_amount);
        }

        if ($request->has('max_amount') && $request->max_amount) {
            $query->where('amount', '<=', $request->max_amount);
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('recipient_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('reference', 'like', '%' . $searchTerm . '%');
            });
        }

        $transactions = $query->paginate(20)->appends($request->except('page'));

        return view('pages.dashboard.account', compact('account', 'transactions'));
    }

    public function transfer()
    {
        $user = Auth::user();
        $accounts = $user->accounts()->where('is_active', true)->get();
        $beneficiaries = $user->beneficiaries()->orderBy('name')->get();

        return view('pages.dashboard.transfer', compact('accounts', 'beneficiaries'));
    }

    public function confirmTransfer(Request $request)
    {
        $validated = $request->validate([
            'from_account' => 'required|exists:accounts,id',
            'recipient_iban' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $account = Account::where('id', $validated['from_account'])
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Check if sufficient balance
        if ($account->available_balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Solde insuffisant'])->withInput();
        }

        // Store transfer data in session
        session()->put('pending_transfer', [
            'account' => $account->toArray(),
            'recipient_iban' => $validated['recipient_iban'],
            'recipient_name' => $validated['recipient_name'],
            'amount' => $validated['amount'],
            'description' => $validated['description'],
        ]);

        return view('pages.dashboard.transfer-confirm', [
            'account' => $account,
            'transferData' => session('pending_transfer'),
        ]);
    }

    public function executeTransfer(Request $request)
    {
        $transferData = session('pending_transfer');

        if (!$transferData) {
            return redirect()->route('dashboard.transfer', ['locale' => app()->getLocale()])
                ->withErrors(['error' => 'Session expirée. Veuillez recommencer.']);
        }

        $user = Auth::user();
        $account = Account::where('id', $transferData['account']['id'])
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Check if sufficient balance again (security check)
        if ($account->available_balance < $transferData['amount']) {
            session()->forget('pending_transfer');
            return redirect()->route('dashboard.transfer', ['locale' => app()->getLocale()])
                ->withErrors(['amount' => 'Solde insuffisant']);
        }

        // Create debit transaction
        $newBalance = $account->balance - $transferData['amount'];
        $reference = 'TRF-' . strtoupper(uniqid()) . '-' . date('Y');

        $transaction = Transaction::create([
            'account_id' => $account->id,
            'type' => 'debit',
            'category' => 'transfer',
            'amount' => $transferData['amount'],
            'currency' => $account->currency,
            'balance_after' => $newBalance,
            'recipient_name' => $transferData['recipient_name'],
            'recipient_iban' => $transferData['recipient_iban'],
            'description' => $transferData['description'],
            'reference' => $reference,
            'status' => 'completed',
            'transaction_date' => Carbon::now(),
        ]);

        // Update account balance
        $account->update([
            'balance' => $newBalance,
            'available_balance' => $newBalance,
        ]);

        // Clear session
        session()->forget('pending_transfer');

        // Store transaction ID for receipt
        session()->flash('transfer_success', $transaction->id);

        return redirect()->route('dashboard.index', ['locale' => app()->getLocale()])
            ->with('success', 'Transfert effectué avec succès');
    }
}
