<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;

// Redirect root to default locale
Route::get('/', function () {
    return redirect()->route('home', ['locale' => config('app.locale', 'fr')]);
});

// Locale switch routes
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'de', 'en', 'es'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.switch');

Route::get('/segment/{segment}', function ($segment) {
    if (in_array($segment, ['privat', 'business'])) {
        session()->put('segment', $segment);
    }
    return redirect()->back();
})->name('segment.switch');

// Multilingual routes
Route::prefix('{locale}')->middleware(SetLocale::class)->group(function () {

    // Home
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    // Services
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/accounts', function () {
            return view('pages.services.accounts');
        })->name('accounts');

        Route::get('/housing', function () {
            return view('pages.services.housing');
        })->name('housing');

        Route::get('/invest', function () {
            return view('pages.services.invest');
        })->name('invest');

        Route::get('/planning', function () {
            return view('pages.services.planning');
        })->name('planning');

        Route::get('/about', function () {
            return view('pages.services.about');
        })->name('about');

        Route::get('/{slug}', function ($locale, $slug) {
            // Service detail page
            return view('pages.services.detail', compact('slug'));
        })->name('detail');
    });

    // Credit Request
    Route::get('/credit-request', function () {
        return view('pages.credit-request');
    })->name('credit.request');

    Route::get('/credit-confirmation', function () {
        return view('pages.credit-confirmation');
    })->name('credit.confirmation');

    // E-Banking
    Route::prefix('ebanking')->name('ebanking.')->group(function () {
        Route::get('/login', function () {
            return view('pages.ebanking.login');
        })->name('login');

        Route::get('/lost-password', function () {
            return view('pages.ebanking.lost-password');
        })->name('lost-password');
    });

    // Agencies
    Route::get('/agencies', function () {
        return view('pages.agencies');
    })->name('agencies');

    // Blog
    Route::get('/blog', function () {
        return view('pages.blog.index');
    })->name('blog');

    Route::get('/blog/{slug}', function ($locale, $slug) {
        return view('pages.blog.show', compact('slug'));
    })->name('blog.show');

    // About
    Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

    // Career
    Route::get('/career', function () {
        return view('pages.career');
    })->name('career');

    // Newsletter
    Route::get('/newsletter', function () {
        return view('pages.newsletter');
    })->name('newsletter');

    // Contact
    Route::get('/contact', function () {
        return view('pages.contact');
    })->name('contact');

    // Legal pages
    Route::prefix('legal')->name('legal.')->group(function () {
        Route::get('/privacy', function () {
            return view('pages.legal.privacy');
        })->name('privacy');

        Route::get('/terms', function () {
            return view('pages.legal.terms');
        })->name('terms');

        Route::get('/impressum', function () {
            return view('pages.legal.impressum');
        })->name('impressum');
    });
});
