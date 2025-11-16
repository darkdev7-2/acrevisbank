@php
    $title = 'Détails de la demande de prêt';
@endphp

<x-layouts.dashboard :title="$title">
    <div class="space-y-6">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a
                    href="{{ route('dashboard.credit-requests.index', ['locale' => app()->getLocale()]) }}"
                    class="text-gray-600 hover:text-gray-900"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Demande de prêt</h1>
                    <p class="mt-1 text-sm text-gray-600">Référence: {{ $creditRequest->reference_number }}</p>
                </div>
            </div>

            <!-- Status Badge -->
            <div>
                @if ($creditRequest->status === 'pending')
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        En attente
                    </span>
                @elseif ($creditRequest->status === 'in_review')
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        En cours d'examen
                    </span>
                @elseif ($creditRequest->status === 'approved')
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Approuvée
                    </span>
                @elseif ($creditRequest->status === 'rejected')
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        Rejetée
                    </span>
                @endif
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Loan Information -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informations sur le prêt
                    </h2>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Montant demandé</label>
                            <p class="mt-1 text-2xl font-bold text-gray-900">
                                {{ number_format($creditRequest->amount, 2, ',', ' ') }} {{ $creditRequest->currency }}
                            </p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Durée</label>
                            <p class="mt-1 text-2xl font-bold text-gray-900">
                                {{ $creditRequest->duration_months ?? 'N/A' }} mois
                            </p>
                        </div>

                        <div class="col-span-2">
                            <label class="text-sm font-medium text-gray-500">Motif du prêt</label>
                            <p class="mt-1 text-gray-900 bg-gray-50 rounded-lg p-4">
                                {{ $creditRequest->purpose }}
                            </p>
                        </div>

                        @if ($creditRequest->other_credit_details)
                            <div class="col-span-2">
                                <label class="text-sm font-medium text-gray-500">Personne à contacter</label>
                                <p class="mt-1 text-gray-900">
                                    {{ str_replace('Personne à contacter: ', '', $creditRequest->other_credit_details) }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Informations personnelles
                    </h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nom</label>
                            <p class="mt-1 text-gray-900">{{ $creditRequest->first_name }} {{ $creditRequest->last_name }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-gray-900">{{ $creditRequest->email }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Téléphone</label>
                            <p class="mt-1 text-gray-900">{{ $creditRequest->phone ?? 'Non renseigné' }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">WhatsApp</label>
                            <p class="mt-1 text-gray-900">{{ $creditRequest->whatsapp ?? 'Non renseigné' }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Pays</label>
                            <p class="mt-1 text-gray-900">{{ $creditRequest->country ?? 'Non renseigné' }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Ville</label>
                            <p class="mt-1 text-gray-900">{{ $creditRequest->city ?? 'Non renseignée' }}</p>
                        </div>

                        @if ($creditRequest->address)
                            <div class="col-span-2">
                                <label class="text-sm font-medium text-gray-500">Adresse</label>
                                <p class="mt-1 text-gray-900">{{ $creditRequest->address }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Admin Notes (if status is approved or rejected) -->
                @if ($creditRequest->admin_notes && in_array($creditRequest->status, ['approved', 'rejected']))
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            Commentaires de l'équipe
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-900">{{ $creditRequest->admin_notes }}</p>
                        </div>
                    </div>
                @endif

                <!-- Credit Disbursement Section (only if approved) -->
                @if ($creditRequest->status === 'approved')
                    @include('components.credit-disbursement-section', ['creditRequest' => $creditRequest])
                @endif
            </div>

            <!-- Right Column - Timeline & Status -->
            <div class="space-y-6">
                <!-- Timeline -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Chronologie</h2>

                    <div class="flow-root">
                        <ul class="-mb-8">
                            <!-- Created -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-900 font-medium">Demande créée</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time datetime="{{ $creditRequest->created_at }}">
                                                    {{ $creditRequest->created_at->format('d/m/Y') }}
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Reviewed (if applicable) -->
                            @if ($creditRequest->reviewed_at)
                                <li>
                                    <div class="relative pb-8">
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full {{ $creditRequest->status === 'approved' ? 'bg-green-500' : 'bg-red-500' }} flex items-center justify-center ring-8 ring-white">
                                                    @if ($creditRequest->status === 'approved')
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    @else
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                        </svg>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-900 font-medium">
                                                        {{ $creditRequest->status === 'approved' ? 'Demande approuvée' : 'Demande rejetée' }}
                                                    </p>
                                                    @if ($creditRequest->reviewer)
                                                        <p class="text-xs text-gray-500 mt-1">
                                                            Par {{ $creditRequest->reviewer->name }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    <time datetime="{{ $creditRequest->reviewed_at }}">
                                                        {{ $creditRequest->reviewed_at->format('d/m/Y') }}
                                                    </time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-lg shadow-sm p-6 border border-blue-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Informations</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-gray-700">
                                Vous ne pouvez pas modifier cette demande après sa soumission.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-700">
                                Vous recevrez un email dès que votre demande sera traitée.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-gray-700">
                                Délai de traitement: 48-72 heures ouvrées.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <a
                    href="{{ route('dashboard.credit-requests.index', ['locale' => app()->getLocale()]) }}"
                    class="block w-full text-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all shadow-md hover:shadow-lg"
                >
                    Retour à mes demandes
                </a>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
