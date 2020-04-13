<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blogs\PostsController;

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

Route::get('/',"WelcomeController@index")->name("welcome");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//

Route::get('blog/posts/{post}', [PostsController::class, 'show'])->name('blog.show');
Route::get('blog/categories/{category}', [PostsController::class, 'category'])->name('blog.category');
Route::get('blog/tags/{tag}', [PostsController::class, 'tag'])->name('blog.tag');





Route::middleware("auth")->group(function(){

        Route::get('/categories/new','CategoriesController@new');
        Route::post("/categories/create",'CategoriesController@create');
        Route::get("categories",'CategoriesController@categories');
        Route::get("category/delete/{category}",'CategoriesController@delete');
        Route::get("category/show/{category}",'CategoriesController@show');
        Route::post("category/edit/{category}",'CategoriesController@edit');


        Route::resource('posts','PostController')->middleware("auth");
        Route::get("trashed-posts","PostController@trashed")->name("trashed-posts.index");
        Route::get("restore-post/{post}","PostController@restore")->name("restore-post");
        Route::resource("tags","TagController");

});

Route::middleware(['auth','admin'])->group(function(){
    Route::get("users/profile","UserController@edit")->name("users.edit-profile");
    Route::put("users/profile","UserController@update")->name("users.update-profile");
    Route::get("users","UserController@index")->name("users.index");
    Route::post("users/{user}/make-admin","UserController@makeAdmin")->name("users.make-admin");
});

