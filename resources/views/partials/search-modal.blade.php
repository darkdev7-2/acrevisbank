@php
    $currentLocale = app()->getLocale();
@endphp

<!-- Search Modal -->
<div x-data="{
    open: false,
    query: '',
    results: [],
    loading: false,
    total: 0,
    hasMore: false,

    async search() {
        if (this.query.length < 2) {
            this.results = [];
            this.total = 0;
            this.hasMore = false;
            return;
        }

        this.loading = true;
        try {
            const response = await fetch('{{ route('search.ajax', ['locale' => $currentLocale]) }}?q=' + encodeURIComponent(this.query));
            const data = await response.json();
            this.results = data.results;
            this.total = data.total;
            this.hasMore = data.hasMore || false;
        } catch (error) {
            console.error('Search error:', error);
        } finally {
            this.loading = false;
        }
    },

    viewAll() {
        window.location.href = '{{ route('search.index', ['locale' => $currentLocale]) }}?q=' + encodeURIComponent(this.query);
    },

    reset() {
        this.query = '';
        this.results = [];
        this.total = 0;
        this.hasMore = false;
        this.loading = false;
    }
}"
     @open-search.window="open = true; $nextTick(() => $refs.searchInput.focus())"
     @keydown.escape.window="if (open) { open = false; reset(); }"
     x-show="open"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">

    <!-- Backdrop -->
    <div x-show="open"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false; reset();"
         class="fixed inset-0 bg-gray-900 bg-opacity-75"></div>

    <!-- Modal Content -->
    <div class="flex min-h-screen items-start justify-center p-4 pt-20">
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="relative w-full max-w-3xl bg-white rounded-2xl shadow-2xl"
             @click.away="open = false; reset();">

            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">{{ __('Recherche') }}</h3>
                    <button @click="open = false; reset();" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Search Input -->
                <div class="relative">
                    <input
                        x-ref="searchInput"
                        x-model="query"
                        @input.debounce.300ms="search()"
                        @keydown.enter="viewAll()"
                        type="search"
                        placeholder="{{ __('Rechercher...') }}"
                        class="w-full px-5 py-4 pl-12 pr-12 bg-gray-50 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-transparent text-lg"
                    >
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <div x-show="loading" class="absolute right-4 top-1/2 -translate-y-1/2">
                        <svg class="animate-spin h-5 w-5 text-pink-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div class="max-h-[60vh] overflow-y-auto">
                <!-- Empty State -->
                <div x-show="query.length === 0" class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <p class="text-gray-500">{{ __('Commencez à taper pour rechercher...') }}</p>
                </div>

                <!-- No Results -->
                <div x-show="query.length >= 2 && total === 0 && !loading" class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-600 font-medium mb-1">{{ __('Aucun résultat trouvé') }}</p>
                    <p class="text-sm text-gray-500">{{ __('Essayez d\'autres mots-clés') }}</p>
                </div>

                <!-- Results List -->
                <div x-show="results.length > 0" class="divide-y divide-gray-100">
                    <template x-for="result in results" :key="result.url">
                        <a :href="result.url"
                           class="block p-5 hover:bg-gray-50 transition-colors group"
                           @click="open = false; reset();">
                            <div class="flex items-start space-x-3">
                                <!-- Type Icon -->
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center text-xl"
                                     :class="{
                                         'bg-blue-100': result.type === 'article',
                                         'bg-green-100': result.type === 'service',
                                         'bg-purple-100': result.type === 'page',
                                         'bg-orange-100': result.type === 'agency'
                                     }">
                                    <span x-text="result.type === 'article' ? '📰' : result.type === 'service' ? '💳' : result.type === 'page' ? '📄' : '📍'"></span>
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base font-semibold text-gray-900 group-hover:text-pink-600 transition-colors mb-1 truncate" x-text="result.title"></h4>
                                    <p class="text-sm text-gray-600 line-clamp-2" x-text="result.excerpt"></p>
                                </div>

                                <!-- Arrow -->
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-pink-600 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    </template>
                </div>
            </div>

            <!-- Footer -->
            <div x-show="hasMore || total > 0" class="p-4 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
                <button @click="viewAll()"
                        class="w-full px-6 py-3 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-colors font-medium flex items-center justify-center space-x-2">
                    <span>{{ __('Voir tous les résultats') }}</span>
                    <span x-show="total > 0" x-text="'(' + total + ')'"></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
