<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of beneficiaries
     */
    public function index()
    {
        $user = Auth::user();
        $beneficiaries = $user->beneficiaries()
            ->orderBy('is_favorite', 'desc')
            ->orderBy('name')
            ->get();

        return view('pages.dashboard.beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new beneficiary
     */
    public function create()
    {
        return view('pages.dashboard.beneficiaries.create');
    }

    /**
     * Store a newly created beneficiary
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'iban' => 'required|string|max:34',
            'bank_name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
            'is_favorite' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['is_favorite'] = $request->has('is_favorite');

        // Remove spaces from IBAN
        $validated['iban'] = str_replace(' ', '', $validated['iban']);

        Beneficiary::create($validated);

        $locale = app()->getLocale();
        return redirect()->route('dashboard.beneficiaries.index', ['locale' => $locale])
            ->with('success', $this->getTranslation('beneficiary_created', $locale));
    }

    /**
     * Show the form for editing the specified beneficiary
     */
    public function edit($locale, $id)
    {
        $beneficiary = Beneficiary::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('pages.dashboard.beneficiaries.edit', compact('beneficiary'));
    }

    /**
     * Update the specified beneficiary
     */
    public function update(Request $request, $locale, $id)
    {
        $beneficiary = Beneficiary::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'iban' => 'required|string|max:34',
            'bank_name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
            'is_favorite' => 'boolean',
        ]);

        $validated['is_favorite'] = $request->has('is_favorite');

        // Remove spaces from IBAN
        $validated['iban'] = str_replace(' ', '', $validated['iban']);

        $beneficiary->update($validated);

        return redirect()->route('dashboard.beneficiaries.index', ['locale' => $locale])
            ->with('success', $this->getTranslation('beneficiary_updated', $locale));
    }

    /**
     * Remove the specified beneficiary
     */
    public function destroy($locale, $id)
    {
        $beneficiary = Beneficiary::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $beneficiary->delete();

        return redirect()->route('dashboard.beneficiaries.index', ['locale' => $locale])
            ->with('success', $this->getTranslation('beneficiary_deleted', $locale));
    }

    /**
     * Get beneficiary data as JSON (for AJAX)
     */
    public function show($locale, $id)
    {
        $beneficiary = Beneficiary::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json($beneficiary);
    }

    /**
     * Helper method for translations
     */
    private function getTranslation($key, $locale)
    {
        $translations = [
            'fr' => [
                'beneficiary_created' => 'Bénéficiaire ajouté avec succès',
                'beneficiary_updated' => 'Bénéficiaire mis à jour avec succès',
                'beneficiary_deleted' => 'Bénéficiaire supprimé avec succès',
            ],
            'de' => [
                'beneficiary_created' => 'Begünstigter erfolgreich hinzugefügt',
                'beneficiary_updated' => 'Begünstigter erfolgreich aktualisiert',
                'beneficiary_deleted' => 'Begünstigter erfolgreich gelöscht',
            ],
            'en' => [
                'beneficiary_created' => 'Beneficiary added successfully',
                'beneficiary_updated' => 'Beneficiary updated successfully',
                'beneficiary_deleted' => 'Beneficiary deleted successfully',
            ],
            'es' => [
                'beneficiary_created' => 'Beneficiario agregado exitosamente',
                'beneficiary_updated' => 'Beneficiario actualizado exitosamente',
                'beneficiary_deleted' => 'Beneficiario eliminado exitosamente',
            ],
        ];

        return $translations[$locale][$key] ?? $translations['fr'][$key];
    }
}
