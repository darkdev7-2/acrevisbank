<?php

namespace App\Http\Controllers;

use App\Models\CreditRequest;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CreditDisbursementController extends Controller
{
    /**
     * Génère un code de déboursement unique pour un crédit approuvé
     * Cette méthode est appelée par le CLIENT après que son crédit soit approuvé
     */
    public function generateCode(Request $request, $creditRequestId)
    {
        $creditRequest = CreditRequest::where('id', $creditRequestId)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->firstOrFail();

        // Vérifier qu'un code n'a pas déjà été généré
        if ($creditRequest->disbursement_code) {
            // Si le code existe déjà, on peut le régénérer si expiré ou refuser
            if ($creditRequest->disbursement_status === 'validated') {
                return back()->with('error', __('Ce crédit a déjà été déboursé.'));
            }

            // Vérifier si le code a expiré (plus de 24h)
            if ($creditRequest->disbursement_code_generated_at &&
                $creditRequest->disbursement_code_generated_at->addHours(24)->isPast()) {
                // Régénérer un nouveau code
                $code = $this->createUniqueCode();
            } else {
                return back()->with('info', __('Un code a déjà été généré pour ce crédit. Veuillez le valider.'));
            }
        } else {
            // Générer un nouveau code
            $code = $this->createUniqueCode();
        }

        // Mise à jour du crédit avec le code
        $creditRequest->update([
            'disbursement_code' => $code,
            'disbursement_code_generated_at' => now(),
            'disbursement_status' => 'code_generated'
        ]);

        // Log l'activité
        activity()
            ->performedOn($creditRequest)
            ->causedBy(auth()->user())
            ->log('Code de déboursement généré');

        return back()->with('success', __('Code de déboursement généré avec succès. Contactez votre conseiller pour obtenir la validation.'));
    }

    /**
     * Valide le code de déboursement et crédite le compte
     * Cette méthode est appelée par le CLIENT après avoir reçu le code de l'ADMIN
     */
    public function validateCode(Request $request, $creditRequestId)
    {
        $request->validate([
            'code' => 'required|string|size:8',
            'account_id' => 'required|exists:accounts,id'
        ]);

        $creditRequest = CreditRequest::where('id', $creditRequestId)
            ->where('user_id', auth()->id())
            ->where('status', 'approved')
            ->firstOrFail();

        // Vérifier que le crédit n'a pas déjà été déboursé
        if ($creditRequest->disbursement_status === 'validated') {
            return back()->with('error', __('Ce crédit a déjà été déboursé.'));
        }

        // Vérifier qu'un code a été généré
        if (!$creditRequest->disbursement_code) {
            return back()->with('error', __('Aucun code n\'a été généré pour ce crédit. Veuillez d\'abord générer un code.'));
        }

        // Vérifier que le code n'a pas expiré (24h)
        if ($creditRequest->disbursement_code_generated_at->addHours(24)->isPast()) {
            $creditRequest->update(['disbursement_status' => 'expired']);
            return back()->with('error', __('Le code a expiré. Veuillez générer un nouveau code.'));
        }

        // Vérifier que le code correspond
        if ($request->code !== $creditRequest->disbursement_code) {
            // Log la tentative échouée
            activity()
                ->performedOn($creditRequest)
                ->causedBy(auth()->user())
                ->withProperties(['code_attempted' => $request->code])
                ->log('Tentative de validation avec code incorrect');

            return back()->with('error', __('Le code saisi est incorrect. Veuillez vérifier et réessayer.'));
        }

        // Vérifier que le compte appartient bien à l'utilisateur
        $account = Account::where('id', $request->account_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Tout est OK, on procède au déboursement
        DB::beginTransaction();
        try {
            // Créditer le compte
            $account->increment('balance', $creditRequest->amount);

            // Créer la transaction
            Transaction::create([
                'account_id' => $account->id,
                'type' => 'credit',
                'category' => 'loan_disbursement',
                'amount' => $creditRequest->amount,
                'currency' => $creditRequest->currency ?? 'CHF',
                'description' => 'Déboursement crédit - Réf: ' . $creditRequest->reference_number,
                'reference' => $creditRequest->reference_number,
                'status' => 'completed',
                'balance_after' => $account->balance,
                'transaction_date' => now(),
            ]);

            // Mettre à jour le crédit
            $creditRequest->update([
                'disbursement_status' => 'validated',
                'account_id' => $account->id,
                'disbursed_at' => now()
            ]);

            // Log l'activité
            activity()
                ->performedOn($creditRequest)
                ->causedBy(auth()->user())
                ->withProperties([
                    'account_id' => $account->id,
                    'amount' => $creditRequest->amount
                ])
                ->log('Crédit déboursé avec succès');

            DB::commit();

            return redirect()->route('dashboard.credit-requests.show', [
                'locale' => app()->getLocale(),
                'id' => $creditRequest->id
            ])->with('success', __('Votre crédit a été déboursé avec succès! Le montant de :amount :currency a été crédité sur votre compte.', [
                'amount' => number_format($creditRequest->amount, 2),
                'currency' => $creditRequest->currency ?? 'CHF'
            ]));

        } catch (\Exception $e) {
            DB::rollBack();

            // Log l'erreur
            activity()
                ->performedOn($creditRequest)
                ->causedBy(auth()->user())
                ->withProperties(['error' => $e->getMessage()])
                ->log('Erreur lors du déboursement du crédit');

            return back()->with('error', __('Une erreur est survenue lors du déboursement. Veuillez contacter le support.'));
        }
    }

    /**
     * Affiche la liste des codes générés pour l'admin
     * Accessible uniquement aux administrateurs
     */
    public function adminViewCodes(Request $request)
    {
        // S'assurer que l'utilisateur est admin
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $codes = CreditRequest::whereNotNull('disbursement_code')
            ->with(['user', 'account'])
            ->orderBy('disbursement_code_generated_at', 'desc')
            ->paginate(20);

        return view('admin.credit-disbursement-codes', compact('codes'));
    }

    /**
     * Génère un code unique de 8 caractères (chiffres uniquement pour faciliter la saisie)
     */
    private function createUniqueCode(): string
    {
        do {
            // Générer un code de 8 chiffres
            $code = str_pad((string) random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        } while (CreditRequest::where('disbursement_code', $code)->exists());

        return $code;
    }

    /**
     * Annule un code de déboursement (admin seulement)
     * Utile si un code a été généré par erreur
     */
    public function cancelCode(Request $request, $creditRequestId)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $creditRequest = CreditRequest::findOrFail($creditRequestId);

        if ($creditRequest->disbursement_status === 'validated') {
            return back()->with('error', __('Impossible d\'annuler un code déjà validé.'));
        }

        $creditRequest->update([
            'disbursement_code' => null,
            'disbursement_code_generated_at' => null,
            'disbursement_status' => null
        ]);

        activity()
            ->performedOn($creditRequest)
            ->causedBy(auth()->user())
            ->log('Code de déboursement annulé par admin');

        return back()->with('success', __('Code de déboursement annulé avec succès.'));
    }
}
