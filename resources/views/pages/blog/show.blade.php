<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
    @endphp

    <x-slot name="title">{{ $article->getTranslation('title', $currentLocale) }}</x-slot>
    <x-slot name="metaDescription">{{ $article->getTranslation('excerpt', $currentLocale) }}</x-slot>

    <!-- Hero -->
    <div class="relative bg-cover bg-center h-[400px]" style="background-image: url('{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1920&h=400&fit=crop' }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-end pb-12">
            <div class="flex items-center space-x-4 text-white/80 text-sm mb-4">
                <a href="{{ route('blog', ['locale' => $currentLocale]) }}" class="hover:text-white">
                    {{ $currentLocale === 'fr' ? '← Retour au blog' :
                       ($currentLocale === 'de' ? '← Zurück zum Blog' :
                       ($currentLocale === 'en' ? '← Back to blog' : '← Volver al blog')) }}
                </a>
                <span>•</span>
                <span>{{ $article->published_at->format('d.m.Y') }}</span>
                @if($article->category)
                    <span>•</span>
                    <span>{{ $article->category->getTranslation('name', $currentLocale) }}</span>
                @endif
                <span>•</span>
                <span>{{ $article->views }} {{ $currentLocale === 'fr' ? 'vues' : ($currentLocale === 'de' ? 'Ansichten' : ($currentLocale === 'en' ? 'views' : 'vistas')) }}</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white">
                {{ $article->getTranslation('title', $currentLocale) }}
            </h1>
        </div>
    </div>

    <!-- Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Excerpt -->
            @if($article->getTranslation('excerpt', $currentLocale))
                <div class="bg-pink-50 border-l-4 border-pink-600 p-6 mb-8">
                    <p class="text-lg text-gray-700 font-medium">
                        {{ $article->getTranslation('excerpt', $currentLocale) }}
                    </p>
                </div>
            @endif

            <!-- Article Content -->
            <div class="bg-white rounded-lg shadow-md p-8 prose max-w-none">
                {!! $article->getTranslation('content', $currentLocale) !!}
            </div>

            <!-- Author & Share -->
            <div class="mt-8 flex items-center justify-between bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center space-x-4">
                    @if($article->author)
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($article->author->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold">{{ $article->author->name }}</div>
                            <div class="text-sm text-gray-500">{{ $article->published_at->format('d.m.Y') }}</div>
                        </div>
                    @endif
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">
                        {{ $currentLocale === 'fr' ? 'Partager' :
                           ($currentLocale === 'de' ? 'Teilen' :
                           ($currentLocale === 'en' ? 'Share' : 'Compartir')) }}:
                    </span>
                    <button class="p-2 hover:bg-gray-100 rounded-full" onclick="navigator.share({title: '{{ $article->getTranslation('title', $currentLocale) }}', url: window.location.href})">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Related Articles -->
            @php
                $relatedArticles = \App\Models\Article::where('is_published', true)
                    ->where('id', '!=', $article->id)
                    ->where('category_id', $article->category_id)
                    ->latest('published_at')
                    ->take(3)
                    ->get();
            @endphp

            @if($relatedArticles->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold mb-6">
                        {{ $currentLocale === 'fr' ? 'Articles similaires' :
                           ($currentLocale === 'de' ? 'Ähnliche Artikel' :
                           ($currentLocale === 'en' ? 'Similar articles' : 'Artículos similares')) }}
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $related)
                            <a href="{{ route('blog.show', ['locale' => $currentLocale, 'slug' => $related->slug]) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                                <div class="h-48 bg-cover bg-center" style="background-image: url('{{ $related->featured_image ?? 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=300&fit=crop' }}');"></div>
                                <div class="p-4">
                                    <h3 class="font-semibold mb-2 hover:text-pink-600">
                                        {{ $related->getTranslation('title', $currentLocale) }}
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ $related->getTranslation('excerpt', $currentLocale) }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
