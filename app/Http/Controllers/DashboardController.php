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

    public function account($id)
    {
        $user = Auth::user();
        $account = Account::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $transactions = $account->transactions()
            ->orderBy('transaction_date', 'desc')
            ->paginate(20);

        return view('pages.dashboard.account', compact('account', 'transactions'));
    }

    public function transfer()
    {
        $user = Auth::user();
        $accounts = $user->accounts()->where('is_active', true)->get();

        return view('pages.dashboard.transfer', compact('accounts'));
    }

    public function storeTransfer(Request $request)
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
            return back()->withErrors(['amount' => 'Solde insuffisant']);
        }

        // Create debit transaction
        $newBalance = $account->balance - $validated['amount'];

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'debit',
            'category' => 'transfer',
            'amount' => $validated['amount'],
            'currency' => $account->currency,
            'balance_after' => $newBalance,
            'recipient_name' => $validated['recipient_name'],
            'recipient_iban' => $validated['recipient_iban'],
            'description' => $validated['description'],
            'reference' => 'REF' . rand(100000, 999999),
            'status' => 'completed',
            'transaction_date' => Carbon::now(),
        ]);

        // Update account balance
        $account->update([
            'balance' => $newBalance,
            'available_balance' => $newBalance,
        ]);

        return redirect()->route('dashboard', ['locale' => app()->getLocale()])
            ->with('success', 'Transfert effectué avec succès');
    }
}
