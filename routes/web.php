<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [FrontEndController::class, 'index'])->name('index');


// Enables the user to login, register, reset passwords, logout 
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');

// The default page when the site is loaded | Home screen
Route::get('/home/user=${id}', [HomeController::class, 'home'])->name('home');


// Relocates to a 'create a new topic' page
Route::get('/new-topic', function() { return view('client.topic-new'); });

// Relocates to 'category-overview' page
Route::get('/category/overview/${id}', [FrontEndController::class,'categoryOverview'])->name('category.overview');

// Relocates to the 'topic' page 
Route::get('/forum/overview/${id}', [FrontEndController::class, 'forumOverview'])->name('forum.overview');

Route::get('/topic', function() {
    return view('client.topic');
});

// Relocates to the ADMIN's 'dashboard' page
Route::get('dashboard/home', 'App\Http\Controllers\DashboardController@home')->name('dashboard.home');



/* Category Routes */

// Goes to a 'create a category' page that enables the user to make a category
Route::get('dashboard/category/new', [CategoryController::class, 'create'])->name('category.new');

// Gets the data from the 'create a category' page and stores it in the database
Route::post('dashboard/category/new', [CategoryController::class, 'store'])->name('category.store');

// Shows all categories
Route::get('dashboard/categories', [CategoryController::class, 'index'])->name('categories');

// Shows an individual category 
Route::get('dashboard/categories/${id}', [CategoryController::class, 'show'])->name('category');

// Goes to a 'edit a category' page that allows the ADMIN to edit the selected category
Route::get('dashboard/categories/edit/${id}', [CategoryController::class, 'edit'])->name('category.edit');

// Gets the data from 'edit a category' page and updates the database with the new data
Route::post('dashboard/categories/edit/${id}', [CategoryController::class, 'update'])->name('category.update');

// Deletes the selected category from the database
Route::get('dashboard/categories/delete/${id}', [CategoryController::class, 'destroy'])->name('category.destroy');
/* end of Category Routes */

// ============================================

/* Forum Routes */

// Goes to a 'create a forum' page that enables the user to make a new forum
Route::get('dashboard/forum/new', [ForumController::class, 'create'])->name('forum.new');

// Gets the data from the 'create a forum' page and stores it in the database
Route::post('dashboard/forum/new', [ForumController::class, 'store'])->name('forum.storе');

// Shows all forums
Route::get('dashboard/forums', [ForumController::class, 'index'])->name('forums');

// Shows an individual forum
Route::get('dashboard/forums/${id}', [ForumController::class, 'show'])->name('forum');

// Allows the ADMIN to edit the forum
Route::get('dashboard/forums/edit/${id}', [ForumController::class, 'edit'])->name('forum.edit');

// Gets the new data for the forum and updates the databse
Route::post('dashboard/forums/edit/${id}', [ForumController::class, 'update'])->name('forum.update');

// Deletes the selected forum from the database
Route::get('dashboard/forums/destroy/${id}', [ForumController::class, 'destroy'])->name('forum.destroy');

/* end of Forum Routes */


/* end of ADMIN section */

// ============================================

/* Topic Routes */

// Shows all topics in the admin panel
Route::get('dashboard/topics', [DiscussionController::class, 'index'])->name('topic');

// Deletes topic from the admin panel
Route::get('dashboard/ranks/delete/{id}', [DiscussionController::class, 'topicDestroy'])->name('topic.delete');

// Goes to a 'create a topic' page that enables the user to make a new topic
Route::get('client/topic/new/{id}', [DiscussionController::class, 'create'])->name('topic.new');

// Gets the data from the 'create a topic' page and stores it in the database
Route::post('client/topic/new', [DiscussionController::class, 'store'])->name('topic.store');

// Shows the user selected topic
Route::get('client/topic/{id}', [DiscussionController::class, 'show'])->name('topics');

// Gets the data from the reply and adds it to the database
Route::post('client/topic/reply/{id}', [DiscussionController::class, 'reply'])->name('topic.reply');

// Deletes the reply
Route::get('/topic/reply/delete/{id}', [DiscussionController::class, 'destroy'])->name('reply.delete');

// Like button
Route::get('/reply/like/{id}', [DiscussionController::class, 'like'])->name('reply.like');
Route::get('/reply/dislike/{id}', [DiscussionController::class, 'dislike'])->name('reply.dislike');




/* end of Topic Routes */



// ===================================
/* User Routes */

Route::get('/updates', [FrontEndController::class, 'updates']);
Route::post('/user/update/{id}', [HomeController::class, 'update'])->name('update.user');

Route::get('/dashboard/users/{id}', [DashboardController::class, 'show'])->name('admin.show');

Route::get('/admin/make/{id}', [DashboardController::class, 'adminMake'])->name('make.admin');
Route::get('/admin/destroy/{id}', [DashboardController::class, 'adminDestroy'])->name('destroy.admin');

// Shows user as a user ( NOT AS ADMIN )
Route::get('/client/users/{id}', [HomeController::class, 'userShow'])->name('user.show');

Route::get('/dashboard/users', [UserController::class, 'index'])->name('users');

Route::get('/dashboard/delete/${id}', [UserController::class, 'delete'])->name('user.delete');

/* end of User Routes */


/* Rank Routes */

// Shows all ranks
Route::get('dashboard/ranks', [RankController::class, 'index'])->name('ranks');

// Goes to a 'create a rank' page that enables the user to make a rank
Route::get('dashboard/ranks/new', [RankController::class, 'create'])->name('ranks.new');

// Gets the data from the 'create a rank' page and stores it in the database
Route::post('dashboard/ranks/new', [RankController::class, 'store'])->name('ranks.store');

// Goes to a 'edit a rank' page that allows the ADMIN to edit the selected rank
Route::get('dashboard/categories/edit/{id}', [RankController::class, 'edit'])->name('ranks.edit');

// Gets the data from 'edit a rank' page and updates the database with the new data
Route::post('dashboard/categories/edit/{id}', [RankController::class, 'update'])->name('ranks.update');

// Deletes the selected rank from the database
Route::get('dashboard/categories/delete/{id}', [RankController::class, 'destroy'])->name('ranks.destroy');

/* end of Rank Routes */

