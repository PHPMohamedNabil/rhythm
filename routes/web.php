<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;

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

Route::post('image/page',[App\Http\Controllers\PageController::class,'uploadPostImage'])->name('upload_page_photo');

// view one page data

Route::get('/pages/{slug}/',[App\Http\Controllers\PageController::class,'pageView'])->name('pageView');

// publish status change

Route::post('/page/publish',[App\Http\Controllers\PageController::class,'pageStatus'])->name('publishe_status');

// trashed Pages
Route::get('/page/archive',[App\Http\Controllers\PageController::class,'pageArchive'])->name('page_archive');

// restore Pages
Route::post('/page/restore',[App\Http\Controllers\PageController::class,'restoreArchiveData'])->name('page_restore');

// delete Pages
Route::post('/page/permanent/delete',[App\Http\Controllers\PageController::class,'deleteArchive'])->name('page_delete');

// delete page history (page versions)

Route::post('/page/history/delete',[App\Http\Controllers\PageController::class,'deletePageHistory'])->name('page_delete_history');

// Update History Pages
Route::get('/page/history/{id}',[App\Http\Controllers\PageController::class,'PageHistory'])->name('history_page_edit');

// view categories data and it is pages

Route::get('/categories/{id}/',[App\Http\Controllers\CategoryController::class,'getCategoryPages'])->name('categories_view');

Route::get('/category/list/',[App\Http\Controllers\CategoryController::class,'getCategoryAll'])->name('categories_all');

/*Questions pages */
Route::get('/questions/{id}/view',[App\Http\Controllers\QuestionController::class,'questionViewOne'])->name('question_view');
Route::get('/questions/search',[App\Http\Controllers\QuestionController::class,'questionSearch'])->name('question_search');

Route::post('/question/delete/attachment',[App\Http\Controllers\QuestionController::class,'questionDeleteAtt'])->name('question_del_att');
/*End Questions pages */
/*search query*/
Route::get('/page/keyword/',[App\Http\Controllers\PageController::class,'pageSearch'])->name('page_keywords');
/*end search query*/

//page search view resultes

Route::get('/page/view/search',[App\Http\Controllers\PageController::class,'pageSearchView'])->name('p_search');


//template search
Route::get('/templates/search',[App\Http\Controllers\ShortCutController::class,'templateSearch'])->name('template_search');

Route::get('/', function () {

    // return dd(auth()->user()->role->permission->permissions['categories']['can-view']);
    return view('admin.layouts.app');
})->name('home_admin')->middleware('auth');

Route::get('/systemlinks/all',[App\Http\Controllers\SystemLinkController::class,'getLinksView'])->name('systemlinks');
//Route::get('/system',[,''])
// wall delete attachment


Route::post('/wall/delete/attachment',[App\Http\Controllers\WallController::class,'wallDeleteAtt'])->name('wall_del_att');
//wall daily

Route::get('walls/all',[App\Http\Controllers\WallController::class,'getAllWalls'])->name('walls_all');

//Route::get('walls/{id}/user/all',[App\Http\Controllers\SystemLinkController::class,'getAllWallsUser']);
Route::get('walls/home/create',[App\Http\Controllers\SystemLinkController::class,'getAllWalls']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/bulk/action',[App\Http\Controllers\PageController::class,'bulkAction'])->name('bulk_action');

Route::resources([
    'category'         =>App\Http\Controllers\CategoryController::class,
    'question'         =>App\Http\Controllers\QuestionController::class,
    'page'             =>App\Http\Controllers\PageController::class,
    'shortcut'         =>App\Http\Controllers\ShortCutController::class,
    'template'         =>App\Http\Controllers\TemplateController::class,
    'systemlink'       =>App\Http\Controllers\SystemLinkController::class,
    'permission'       =>App\Http\Controllers\PermissionController::class,
    'role'             =>App\Http\Controllers\RoleController::class,
    'user'             =>App\Http\Controllers\UserController::class,
    'wall'            =>App\Http\Controllers\WallController::class
]);


