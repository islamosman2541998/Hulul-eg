<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\FaqController;
use App\Http\Controllers\Site\JobController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\ServicesController;
use App\Http\Controllers\Site\SitemapController;
use App\Http\Controllers\Site\LlmsTxtController;
use App\Http\Controllers\Site\ContactUsController;
use App\Http\Controllers\Site\PortfolioController;
use App\Http\Controllers\Site\SubscribeController;

use App\Http\Controllers\Site\ServiceRequestController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// outside the localized group: one sitemap for both languages, no /ar or /en redirect
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
// a guide to the site for AI assistants (llmstxt.org); keep no public/llms.txt, it would win
Route::get('llms.txt', [LlmsTxtController::class, 'index'])->name('llms');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'], // Route translate middleware
    'as' => 'site.'
], function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('pages/{slug}', 'show')->name('pages.show');
    });

    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
    Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact.store');

    Route::get('faq-questions', [FaqController::class, 'index'])->name('faq-questions');
    Route::get('about-us', [AboutController::class, 'index'])->name('about-us');

    Route::get('/blogs', [BlogController::class, 'index'])->name('site.blogs.index');
    // {blog} is the article's slug; an old numeric id redirects to it
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('site.blogs.show');

    // news, products and product categories are leftovers of the templates the site was built on
    // (medical news, a flower shop): their URLs pass visitors and ranking on to the live section
    // closest to them instead of serving thin pages. Names kept so old views still build links.
    Route::get('/news', fn () => redirect()->route('site.site.blogs.index', [], 301))->name('news.index');
    Route::get('/news/{news}', fn () => redirect()->route('site.site.blogs.index', [], 301))->name('news.show');


    Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/{slug}', [ServicesController::class, 'show'])->name('services.show');
    Route::get('categories-services/{slug}', function ($slug) {
        // permanent: old menu links pass their ranking to the real service URL
        return redirect()->route('site.services.show', $slug, 301);
    })->name('categories-services.show');
    Route::get('/service_request', [ServiceRequestController::class, 'index'])->name('service_request.index');
Route::view('/thank-you', 'site.thank-you')
    ->name('thank-you');
    Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');

    Route::get('categories/{id}', fn () => redirect()->route('site.services.index', [], 301))->name('categories.show');
    Route::get('categories', fn () => redirect()->route('site.services.index', [], 301))->name('categories.index');
    Route::get('portfolio', [PortfolioController::class, 'index'])
        ->name('portfolio.index');
    Route::get('products/{id}', fn () => redirect()->route('site.services.index', [], 301))->name('products.show');
    Route::get('products', fn () => redirect()->route('site.services.index', [], 301))->name('products.index');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    // jobs open in a popup on the list (details and the apply form), so a job has no page of its own
    Route::get('/jobs/{slug}', fn () => redirect()->route('site.jobs.index', [], 301))->name('jobs.show');
});
