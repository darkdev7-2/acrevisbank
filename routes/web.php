<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\TransactionExportController;

// Redirect root to detected or default locale
Route::get('/', function () {
    $locale = session('locale', config('app.locale', 'fr'));
    return redirect()->route('home', ['locale' => $locale]);
});

// Locale switch routes
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'de', 'en', 'es'])) {
        session()->put('locale', $locale);

        // Get the current URL path
        $previousUrl = url()->previous();
        $parsedUrl = parse_url($previousUrl);
        $path = $parsedUrl['path'] ?? '/';

        // Extract the current locale from the path (e.g., /fr/services -> /de/services)
        $supportedLocales = ['fr', 'de', 'en', 'es'];
        foreach ($supportedLocales as $currentLocale) {
            if (str_starts_with($path, '/' . $currentLocale . '/') || $path === '/' . $currentLocale) {
                // Replace the locale in the path
                $path = preg_replace('#^/' . $currentLocale . '(/|$)#', '/' . $locale . '$1', $path);
                break;
            }
        }

        // If no locale was found in the path, prepend the new locale
        if (!str_starts_with($path, '/' . $locale)) {
            $path = '/' . $locale . ($path === '/' ? '' : $path);
        }

        return redirect($path);
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
        // Services index with dynamic filtering
        Route::get('/', [ServiceController::class, 'index'])->name('index');

        // Legacy routes redirect to new dynamic system
        Route::get('/accounts', function ($locale) {
            return redirect()->route('services.index', ['locale' => $locale, 'category' => 'Comptes & Cartes']);
        })->name('accounts');

        Route::get('/housing', function ($locale) {
            return redirect()->route('services.index', ['locale' => $locale, 'category' => 'Hypothèques & Financements']);
        })->name('housing');

        Route::get('/invest', function ($locale) {
            return redirect()->route('services.index', ['locale' => $locale, 'category' => 'Placements & Épargne']);
        })->name('invest');

        Route::get('/planning', function ($locale) {
            return redirect()->route('services.index', ['locale' => $locale, 'category' => 'Prévoyance']);
        })->name('planning');

        Route::get('/about', function ($locale) {
            return redirect()->route('services.index', ['locale' => $locale]);
        })->name('about');

        // Dynamic service detail page (database-driven)
        Route::get('/{slug}', [ServiceController::class, 'show'])->name('detail');
    });

    // Credit Request
    Route::get('/credit-request', function () {
        return view('pages.credit-request');
    })->name('credit.request');

    Route::get('/credit-confirmation', function () {
        return view('pages.credit-confirmation');
    })->name('credit.confirmation');

    // E-Banking - Redirect to main login (Fortify)
    Route::prefix('ebanking')->name('ebanking.')->group(function () {
        Route::get('/login', function ($locale) {
            return redirect()->route('login', ['locale' => $locale]);
        })->name('login');

        Route::get('/lost-password', function ($locale) {
            return redirect()->route('password.request', ['locale' => $locale]);
        })->name('lost-password');
    });

    // Agencies
    Route::get('/agencies', function () {
        return view('pages.agencies');
    })->name('agencies');

    // Blog
    Route::get('/blog', function () {
        $articles = \App\Models\Article::where('is_published', true)
            ->latest('published_at')
            ->get();
        return view('pages.blog.index', compact('articles'));
    })->name('blog');

    Route::get('/blog/{slug}', function ($locale, $slug) {
        $article = \App\Models\Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment views
        $article->increment('views');

        return view('pages.blog.show', compact('article'));
    })->name('blog.show');

    // About
    Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

    // Career
    Route::prefix('career')->name('career.')->group(function () {
        Route::get('/', [CareerController::class, 'index'])->name('index');
        Route::get('/{slug}', [CareerController::class, 'show'])->name('show');
    });

    // Newsletter
    Route::get('/newsletter', function () {
        return view('pages.newsletter');
    })->name('newsletter');

    // Contact
    Route::get('/contact', function () {
        return view('pages.contact');
    })->name('contact');

    // Dashboard (Customer Area) - Protected by auth middleware
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/account/{id}', [DashboardController::class, 'account'])->name('account');
        Route::get('/transfer', [DashboardController::class, 'transfer'])->name('transfer');
        Route::post('/transfer/confirm', [DashboardController::class, 'confirmTransfer'])->name('transfer.confirm');
        Route::post('/transfer/execute', [DashboardController::class, 'executeTransfer'])->name('transfer.execute');

        // Transaction exports
        Route::get('/account/{accountId}/export/pdf', [TransactionExportController::class, 'exportPDF'])->name('transactions.export.pdf');
        Route::get('/account/{accountId}/export/csv', [TransactionExportController::class, 'exportCSV'])->name('transactions.export.csv');
        Route::get('/transaction/{transactionId}/receipt', [TransactionExportController::class, 'downloadReceipt'])->name('transaction.receipt');

        // Beneficiaries management
        Route::prefix('beneficiaries')->name('beneficiaries.')->group(function () {
            Route::get('/', [BeneficiaryController::class, 'index'])->name('index');
            Route::get('/create', [BeneficiaryController::class, 'create'])->name('create');
            Route::post('/', [BeneficiaryController::class, 'store'])->name('store');
            Route::get('/{id}', [BeneficiaryController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [BeneficiaryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [BeneficiaryController::class, 'update'])->name('update');
            Route::delete('/{id}', [BeneficiaryController::class, 'destroy'])->name('destroy');
        });
    });

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

// Authentication routes (outside locale group for simplicity)
Route::get('/register-account', \App\Livewire\MultiStepRegistration::class)->name('auth.register-multistep');
Route::get('/pending-validation', function () {
    return view('pages.auth.pending-validation');
})->name('auth.pending-validation');
