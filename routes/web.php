<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Member\MemberCartController;
use App\Http\Controllers\Member\MemberHomeController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Member\MemberProfileController;
use App\Http\Controllers\Member\MemberRankingController;
use App\Http\Controllers\Member\MemberCheckoutController;
use App\Http\Controllers\Member\MemberPortfolioController;
use App\Http\Controllers\Member\MemberWebDesignController;
use App\Http\Controllers\Admin\AdminDetailDesignController;
use App\Http\Controllers\Admin\AdminMemberProfileController;
use App\Http\Controllers\Member\MemberDetailDesignController;
use App\Http\Controllers\Member\MemberIllustrationController;
use App\Http\Controllers\Admin\AdminMemberPortfolioController;
use App\Http\Controllers\Admin\AdminUploadedHistoryController;
use App\Http\Controllers\Member\MemberDesignPostingController;
use App\Http\Controllers\Admin\AdminTransactionHistoryController;
use App\Http\Controllers\Member\MemberTransactionHistoryController;
use App\Http\Controllers\Admin\AdminMemberTransactionHistoryController;

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

//user(member)
Route::get('/', [MemberHomeController::class, 'getViewHome'])->name('member.home');
Route::get('/home', [MemberHomeController::class, 'getViewHome'])->name('member.home');
Route::get('/home/search', [MemberHomeController::class, 'searchDesignHome'])->name('member.home.search');

Route::get('/home/illustration', [MemberIllustrationController::class, 'getViewIllustration'])->name('member.home.illustration');
Route::get('/home/illustration/search', [MemberIllustrationController::class, 'searchDesignIllustration'])->name('member.home.illustration.search');

Route::get('/home/web-design', [MemberWebDesignController::class, 'getViewWebDesign'])->name('member.home.web-design');
Route::get('/home/web-design/search', [MemberWebDesignController::class, 'searchDesignWebDesign'])->name('member.home.web-design.search');

Route::get('/ranking', [MemberRankingController::class, 'getViewRanking'])->name('member.ranking');

Route::middleware('auth', 'is-member')->group(function () {

    //profile page==
    Route::get('/profile', [MemberProfileController::class, 'getViewProfile'])->name('member.profile');
    Route::post('/profile/profile/update', [MemberProfileController::class, 'updateProfile'])->name('member.profile.update');
    Route::post('/profile/wallet/update', [MemberProfileController::class, 'updateWallet'])->name('member.profile.wallet.update');

    //potfolio page==
    Route::get('/portfolio', [MemberPortfolioController::class, 'getViewPortfolio'])->name('member.portfolio');

    //design create page==
    Route::get('/design-posting', [MemberDesignPostingController::class, 'getViewPosting'])->name('member.design-posting');
    Route::post('/design-posting/create', [MemberDesignPostingController::class, 'createPosting'])->name('member.design-posting.create');

    //design edit page==
    Route::get('/design-posting/edit/{id}', [MemberDesignPostingController::class, 'getViewEditPosting'])->name('member.design-posting.edit');
    Route::post('/design-posting/update', [MemberDesignPostingController::class, 'updatePosting'])->name('member.design-posting.update');

    //detail design page==
    Route::get('/detail-design/{id}', [MemberDetailDesignController::class, 'getViewDetailDesign'])->name('member.detail-design');
    Route::post('/detail-design/feedback/create', [MemberDetailDesignController::class, 'createFeedback'])->name('member.detail-design.feedback.create');
    Route::post('/detail-design/feedback/delete', [MemberDetailDesignController::class, 'deleteFeedback'])->name('member.detail-design.feedback.delete');
    Route::get('/detail-design/like/create/{id}', [MemberDetailDesignController::class, 'createLike'])->name('member.detail-design.like.create');
    Route::get('/detail-design/cart/create/{id}', [MemberCartController::class, 'addToCart'])->name('member.detail-design.cart.create');
    Route::post('/detail-design/report/create', [MemberDetailDesignController::class, 'createReport'])->name('member.detail-design.report.create');
    Route::get('/detail-design/design-posting/delete/{id}', [MemberDesignPostingController::class, 'deletePosting'])->name('member.detail-design.design-posting.delete');

    //cart page==
    Route::get('/cart', [MemberCartController::class, 'getViewCart'])->name('member.cart');
    Route::post('/cart/delete', [MemberCartController::class, 'deleteCart'])->name('member.cart.delete');
    Route::post('/cart/set-select', [MemberCartController::class, 'setSelect'])->name('member.cart.set-select');

    //checkout page==
    Route::get('/detail-design/checkout/{id}', [MemberCheckoutController::class, 'getViewCheckoutWithoutCart'])->name('member.checkout.without-cart');
    Route::post('/detail-design/checkout/create', [MemberCheckoutController::class, 'createTransactionWithoutCart'])->name('member.checkout.without-cart.create');

    Route::get('/cart/checkout', [MemberCheckoutController::class, 'getViewCheckoutWithCart'])->name('member.checkout.with-cart');
    Route::post('/cart/checkout/remove-checkout', [MemberCheckoutController::class, 'removeCheckout'])->name('member.checkout.with-cart.remove-checkout');
    Route::post('/cart/checkout/create', [MemberCheckoutController::class, 'createTransactionWithCart'])->name('member.checkout.with-cart.create');

    //transaction history page==
    Route::get('/transaction-history', [MemberTransactionHistoryController::class, 'getViewTransactionHistory'])->name('member.transaction-history');
    Route::get('/transaction-history/download/{id}', [MemberTransactionHistoryController::class, 'downloadFile'])->name('member.transaction-history.download');
    Route::get('/transaction-history/pdf/{id}', [MemberTransactionHistoryController::class, 'Invoice'])->name('member.transaction-history.invoice');;
});



//admin
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth', 'is-admin')->group(function () {
    //home page==
    Route::get('/admin/home', [AdminHomeController::class, 'getViewAdminHome'])->name('admin.home');
    Route::get('/admin/home/report/delete{id}', [AdminHomeController::class, 'deleteReport'])->name('admin.home.report.delete');

    //detail design page==
    Route::get('/admin/detail-design/{id}', [AdminDetailDesignController::class, 'getViewDetailDesign'])->name('admin.detail-design');
    Route::post('/admin/detail-design/design-posting/delete', [AdminDetailDesignController::class, 'deletePosting'])->name('admin.detail-design.design-posting.delete');

    //uploaded history page==
    Route::get('/admin/uploaded-history', [AdminUploadedHistoryController::class, 'getViewUploadedHistory'])->name('admin.uploaded-history');
    Route::get('/admin/uploaded-history/filter-date', [AdminUploadedHistoryController::class, 'filterDate'])->name('admin.uploaded-history.filter-date');

    //transaction history page==
    Route::get('/admin/transaction-history', [AdminTransactionHistoryController::class, 'getViewTransactionHistory'])->name('admin.transaction-history');
    Route::get('/admin/transaction-history/filter-date', [AdminTransactionHistoryController::class, 'filterDate'])->name('admin.transaction-history.filter-date');

    //member page==
    Route::get('/admin/member', [AdminMemberController::class, 'getViewMember'])->name('admin.member');
    Route::get('/admin/member/search', [AdminMemberController::class, 'searchMember'])->name('admin.member.search');
    Route::get('/admin/member/set-status/{id}', [AdminMemberController::class, 'setStatus'])->name('admin.member.set-status');

    //member profile page==
    Route::get('/admin/member/profile/{id}', [AdminMemberProfileController::class, 'getViewMemberProfile'])->name('admin.member.profile');

    //member portfolio page==
    Route::get('/admin/member/portfolio/{id}', [AdminMemberPortfolioController::class, 'getViewMemberPortfolio'])->name('admin.member.portfolio');
    Route::get('/admin/member/portfolio/filter-date/{id}', [AdminMemberPortfolioController::class, 'filterDate'])->name('admin.member.portfolio.filter-date');

    //member transaction history page==
    Route::get('/admin/member/transaction-history/{id}', [AdminMemberTransactionHistoryController::class, 'getViewMembertransactionHistory'])->name('admin.member.transaction-history');
    Route::get('/admin/member/transaction-history/filter-date/{id}', [AdminMemberTransactionHistoryController::class, 'filterDate'])->name('admin.member.transaction-history.filter-date');

    //profile page==
    Route::get('/admin/profile', [AdminProfileController::class, 'getViewProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
});

require __DIR__ . '/auth.php';



Route::get('/register/admin.key=4421', [AdminAuthController::class, 'viewRegister'])
    ->name('register.admin.view');

Route::post('register/store/admin', [AdminAuthController::class, 'registerStore'])->name('register.admin.store');
