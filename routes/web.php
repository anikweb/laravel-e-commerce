<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BackendControllers,
    CartControllers,
    FrontendController,
    CategoryControllers,
    CheckoutController,
    CouponController,
    SubcategoryController,
    ProductControllers,
    RoleController,
    CustomerController,
    SslCommerzPaymentController,
};

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Front end
Route::get('/',[FrontendController::class, 'frontend'])->name('frontend');
Route::get('/product-details/{slug}',[FrontendController::class, 'productDetails'])->name('productDetails');
Route::get('/get/color/size/{cid}/{pid}',[FrontendController::class, 'getColorSizeId'])->name('getColorSizeId');
// Invoice Download
Route::get('download/customer/invoice/{billing_id}',[BackendControllers::class,'downloadCustomerInvoice'])->middleware(['iscustomer'])->name('download.customer.invoice');
Route::get('dashboard/orders',[CustomerController::class,'orders'])->middleware(['iscustomer'])->name('orders.index');



// carts
Route::get('/carts',[CartControllers::class, 'cartView'])->name('cartView');
Route::get('/carts/{coupon}',[CartControllers::class, 'cartView']);
Route::post('/cart-post',[CartControllers::class, 'cartPost'])->name('cartPost');
// Dashboard
Route::get('dashboard',[BackendControllers::class, 'dashboard'])->name('dashboard');
// Categories
Route::get('categories',[CategoryControllers::class, 'categories'])->name('categories');
Route::get('add-category',[CategoryControllers::class, 'AddCategory'])->name('AddCategory');
Route::post('post-category',[CategoryControllers::class, 'PostCategory'])->name('PostCategory');
Route::get('edit-category/{id}',[CategoryControllers::class,'editCategory'])->name('editCategory');
Route::post('update-category',[CategoryControllers::class, 'updateCategory'])->name('updateCategory');
Route::get('delete-category/{id}',[CategoryControllers::class, 'DeleteCategory'])->name('DeleteCategory');
Route::post('delete-all-categories',[CategoryControllers::class, 'deleteAll'])->name('deleteAll');
// Trash Category
Route::get('category-trashed',[CategoryControllers::class, 'trashedCategories'])->name('trashedCategories');
Route::get('restore-category/{id}',[CategoryControllers::class,'restoreCategory'])->name('restoreCategory');
Route::post('delete-all-categories-trash',[CategoryControllers::class, 'deleteAllTrash'])->name('deleteAllTrash');
//  category trash
Route::get('permanent-delete-category/{id}',[CategoryControllers::class,'permanentCategory'])->name('permanentCategory');
Route::post('permanent-delete-category-security',[CategoryControllers::class, 'permanentDeleteCategorySequrity'])->name('permanentDeleteCategorySequrity');
// subcategory
Route::get('subcategories',[SubcategoryController::class, 'viewSubcategories'])->name('viewSubcategories');
Route::get('add-subcategory',[SubcategoryController::class, 'addSubcategory'])->name('addSubcategory');
Route::post('post-subcategory',[SubcategoryController::class, 'postSubcategory'])->name('postSubcategory');
Route::get('edit-subcategory/{id}',[SubcategoryController::class, 'editSubcategory'])->name('editSubcategory');
Route::post('update-subcategory',[SubcategoryController::class, 'updateSubcategory'])->name('updateSubcategory');
Route::get('delete-subcategory/{id}',[SubcategoryController::class, 'deleteSubcategory'])->name('deleteSubcategory');
Route::get('subcategory-trashed',[SubcategoryController::class, 'trashedSubcategory'])->name('trashedSubcategory');
Route::get('restore-subcategory/{id}',[SubcategoryController::class, 'restoreSubcategory'])->name('restoreSubcategory');
Route::post('permanent-delete-subcategory-security',[SubcategoryController::class, 'permanentDeleteSubcategory'])->name('permanentDeleteSubcategory');
Route::get('permanent-delete-subcategory/{id}',[SubcategoryController::class, 'pdeleteSubcatWithoutSecu'])->name('pdeleteSubcatWithoutSecu');
Route::post('delete-all-subcategories',[SubcategoryController::class, 'deleteAllSubcategories'])->name('deleteAllSubcategories');
Route::post('delete-all-subcategories-trash',[SubcategoryController::class, 'deleteAllTrashSubcategories'])->name('deleteAllTrashSubcategories');
// Products
Route::get('products-list',[ProductControllers::class , 'viewProducts'])->middleware(['auth'])->name('viewProducts');
Route::get('dashboard/products/stockout',[ProductControllers::class , 'viewStockOutProducts'])->middleware(['auth'])->name('viewStockOutProducts');
Route::get('add-product',[ProductControllers::class , 'addProducts'])->middleware(['auth'])->name('addProducts');
Route::post('post-product',[ProductControllers::class , 'postProducts'])->middleware(['auth'])->name('postProducts');
Route::get('product-delete/{id}',[ProductControllers::class , 'postProducts'])->middleware(['auth'])->name('postProducts');
// ajax for subcategory
Route::get('api/get-subcat-list/{cat_id}',[ProductControllers::class , 'getSubCat'])->middleware(['auth'])->name('getSubCat');
Route::get('edit-product/{slug}',[ProductControllers::class , 'editProduct'])->middleware(['auth'])->name('editProduct');
Route::post('product-update-post',[ProductControllers::class , 'updatePostProduct'])->middleware(['auth'])->name('updatePostProduct');
// Coupon
Route::get('coupon/trash',[CouponController::class , 'trash'])->middleware(['auth'])->name('coupon.trash');
Route::get('coupon/trash/{id}/restore',[CouponController::class , 'restore'])->middleware(['auth'])->name('coupon.restore');
Route::get('coupon/trash/{id}/details',[CouponController::class , 'trashDetails'])->middleware(['auth'])->name('coupon.trash.details');
Route::resource('coupon', CouponController::class);
// Role
Route::get('dashboard/role/assign/user',[RoleController::class , 'assignUser'])->middleware(['auth'])->name('assign.user');
Route::post('dashboard/role/assign/user/post',[RoleController::class , 'assignUserStore'])->middleware(['auth'])->name('assign.user.store');
Route::get('dashboard/add/user',[RoleController::class , 'addUser'])->middleware(['auth'])->name('add.user');
Route::post('dashboard/add/user/post',[RoleController::class , 'addUserStore'])->middleware(['auth'])->name('add.user.store');
Route::resource('role', RoleController::class);

Route::get('checkout',[CheckoutController::class , 'checkout'])->middleware(['auth'])->name('checkout');
Route::post('checkoutStore',[CheckoutController::class , 'checkoutStore'])->middleware(['auth'])->name('checkout.store');
Route::post('get/state/list',[CheckoutController::class , 'getState'])->middleware(['auth'])->name('getState');
Route::post('get/city/list',[CheckoutController::class , 'getCityList'])->middleware(['auth'])->name('getCityList');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

require __DIR__.'/auth.php';
