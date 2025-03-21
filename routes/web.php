<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Filament\Admin\Pages\Auth\Register;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProductCategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Frontend\ProductCollectionController;
use App\Http\Controllers\Frontend\ProductTagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdentifyController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/app', function () {
    return redirect('/');
})->name('app');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Category routes
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [ProductCategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/products', [ProductCategoryController::class, 'products'])->name('categories.products');

// Collection routes
Route::get('/collections', [ProductCollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/{collection}', [ProductCollectionController::class, 'show'])->name('collections.show');
Route::get('/collections/{collection}/products', [ProductCollectionController::class, 'products'])->name('collections.products');


// Tag routes
Route::get('/tags', [ProductTagController::class, 'index'])->name('tags.index');
Route::get('/tags/{tag}', [ProductTagController::class, 'show'])->name('tags.show');


// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'initiateCheckout'])->name('checkout.initiate');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'showConfirmation'])->name('checkout.confirmation');

// Shipping routes
Route::get('/shipping', [ShippingController::class, 'index'])->name('shipping.index');
Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
Route::put('/shipping/{shippingMethod}', [ShippingController::class, 'update'])->name('shipping.update');
Route::delete('/shipping/{shippingMethod}', [ShippingController::class, 'destroy'])->name('shipping.destroy');

// Order history routes
Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders.history');
Route::get('/orders/{id}', [OrderHistoryController::class, 'show'])->name('orders.show');

Route::prefix('payment_methods')->group(function () {
    Route::get('/', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
    Route::post('/store', [PaymentMethodController::class, 'addPaymentMethod'])->name('payment_methods.store');
    Route::get('/edit/{id}', [PaymentMethodController::class, 'editPaymentMethod'])->name('payment_methods.edit');
    Route::post('/update/{id}', [PaymentMethodController::class, 'editPaymentMethod'])->name('payment_methods.update');
    Route::delete('/destroy/{id}', [PaymentMethodController::class, 'deletePaymentMethod'])->name('payment_methods.destroy');
    Route::post('/set_default/{id}', [PaymentMethodController::class, 'setDefaultPaymentMethod'])->name('payment_methods.setDefault');
});

Route::post('/payment', [StripePaymentController::class, 'createOneTimePayment'])->name('payment.create');

Route::get('/subscriptions', [SubscriptionController::class, 'viewAvailableSubscriptions'])->name('subscriptions.view');
Route::post('/subscription', [SubscriptionController::class, 'subscribeToPlan'])->name('subscription.create');
Route::patch('/subscription/change', [SubscriptionController::class, 'changePlan'])->name('subscription.change-plan');
Route::delete('/subscription/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');

Route::post('/paypal/payment', [PaypalPaymentController::class, 'createOneTimePayment'])->name('paypal.payment.create');
Route::post('/paypal/subscription', [PayPalPaymentController::class, 'createSubscription'])->name('paypal.subscription.create');
Route::patch('/paypal/subscription/update', [PayPalPaymentController::class, 'updateSubscription'])->name('paypal.subscription.update');
Route::delete('/paypal/subscription/cancel', [PayPalPaymentController::class, 'cancelSubscription'])->name('paypal.subscription.cancel');


// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/product/{category}/{product}', [ProductController::class, 'show'])->name('products.show');
// Route::put('/product/{category}/{product}', [ProductController::class, 'update'])->name('products.update');
// Route::patch('/product/{category}/{product}', [ProductController::class, 'update']);
// Route::delete('/product/{category}/{product}', [ProductController::class, 'delete'])->name('products.delete');


// Ratings and reviews
Route::get('/product/{product}/reviews', [ReviewController::class, 'show'])->name('reviews.show');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/reviews/approve/{id}', [ReviewController::class, 'approve'])->name('reviews.approve');
Route::post('/reviews/{id}/vote', [ReviewController::class, 'vote'])->name('reviews.vote');

Route::get('/product/{product}/ratings/average', [RatingController::class, 'calculateAverageRating'])->name('ratings.average');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');


// New comparison routes
Route::post('/product/{category}/{product}/compare', [ProductController::class, 'addToCompare'])->name('products.addToCompare');
Route::get('/products/compare', [ProductController::class, 'compare'])->name('products.compare');
Route::delete('/product/{category}/{product}/compare', [ProductController::class, 'removeFromCompare'])->name('products.removeFromCompare');
Route::delete('/products/compare/clear', [ProductController::class, 'clearCompare'])->name('products.clearCompare');

Route::middleware('auth')->group(function () {
    Route::get('/download/{category}/{product}', [DownloadController::class, 'generateSecureLink'])->name('download.generate-link');
    Route::get('/download/file/{category}/{product}', [DownloadController::class, 'serveFile'])->name('download.serve-file');
});


Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site_settings.index');
Route::get('/site-settings/{id}/edit', [SiteSettingController::class, 'edit'])->name('site_settings.edit');
Route::post('/site-settings/{id}', [SiteSettingController::class, 'update'])->name('site_settings.update');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

// Cart routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    // Route::post('/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/update/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');
    // Route::delete('/remove/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
});

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

// Pages
// TODO: implement CMS features for page and form editing 
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('/shop', 'shop')->name('shop');

Route::view('/account', 'account')->middleware('auth')->name('about');
Route::get('/registeration',  Register::class)->name('registeration');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Blog routes
// Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('changeLang');

require __DIR__ . '/socialstream.php';

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::post('/verifyIdentifyId', [IdentifyController::class, 'verify']);
Route::post('/withdrawal', [WithdrawalController::class, 'store'])->name('withdrawal.store');

Route::post('/custom-login', [CustomLoginController::class, 'login'])->name('custom.login');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::post('/update-password', [CustomLoginController::class, 'update'])->name('password.update');

Route::get('/change-lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return redirect()->back();
})->name('changeLang');

