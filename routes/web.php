<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Models\Post;
use App\Models\User;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use App\Models\ContactForm;



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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//searching and seeing users profile
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
Route::get('/profile/{user}', [DashboardController::class, 'showProfile'])->name('profile.profile');

//faq
Route::get('/faq', [FaqController::class, 'showFaqPage'])->name('faq.faqPage');

//contact
Route::get('/contact', [ContactController::class, 'showContact'])->name('contact.contactPage');
Route::post('/contact/send', [ContactController::class, 'storeContactForm'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/{id}', [Usercontroller::class, 'show'])->name('user.show');
    Route::get('/user/{id}/promote', [Usercontroller::class, 'promoteToAdmin'])->name('user.promote');
    Route::get('/user/{id}/demote', [Usercontroller::class, 'demoteFromAdmin'])->name('user.demote');

});
Route::middleware('auth','auth.admin')->group(function () {
  
Route::get('profile/admin', [AdminController::class, 'index'])->name('profile.admin');
    
});



Route::middleware(['auth', 'admin'])->group(function () {

    //create post
    Route::get('/posts/create', [PostController::class, 'showPostForm'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    //edit post
    Route::get('/posts/{post}/edit', [PostController::class, 'editPost'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'updatePost'])->name('posts.update');
    //delete post
    Route::delete('post/{post}', [PostController::class, 'deletePost'])->name('posts.delete');
    //promote user to admin
    Route::post('/users/{user}/promote', [UserController::class, 'promoteUser'])->name('users.promote');
    Route::post('/users/{user}/demote', [UserController::class, 'demoteUser'])->name('users.demote');




    //category form
    Route::get('/faq/create', [FaqController::class, 'createCategory'])->name('faq.create-category');
    //store category
    Route::post('/faq/create/store', [FaqController::class, 'storeCategory'])->name('faq.store-category');
    //item form
    Route::get('/faq/{category}/create-item', [FaqController::class, 'createItem'])->name('faq.create-item');
    //item store
    Route::post('/faq/{category}/create-item', [FaqController::class, 'storeItem'])->name('faq.store-item');
    //delete category
    Route::delete('/faq/category/{category}', [FaqController::class, 'deleteCategory'])->name('faq.delete-category');
    // Delete Item
    Route::delete('/faq/item/{item}', [FaqController::class, 'deleteItem'])->name('faq.delete-item');
    //admin contact page
    Route::get('/contactAdmin', [ContactController::class, 'showAdminContactPage'])->name('contact.contactAdminPage');


});
Route::get('/posts', [PostController::class, 'showPosts'])->name('posts.show');
Route::get('/posts/{post}', [PostController::class, 'showPost'])->name('posts.showPost');

Route::get('/faq', [FaqController::class, 'showFaqPage'])->name('faq.faqPage');
Route::get('/faq/{category}', [FaqController::class, 'showCategory'])->name('faq.showCategory');
Route::get('/faq/{category}/{item}', [FaqController::class, 'showItem'])->name('faq.showItem');

Route::get('/about', function () {
    return view('Profile/about');
})->name('about');

Route::get('/faqs', function () {
    return view('profile/faqPage');
})->name('faqPage');

Route::get('/welcome/contact', function () {
    return view('contact/contact-page');
})->name('contact.page');


require __DIR__.'/auth.php';
