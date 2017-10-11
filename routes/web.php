<?php

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
Auth::routes();
Route::get('/register/confirm', 'Auth\RegisterConfirmationController@confirm')->name('register.confirm');
Route::get('/register/sendconfirmationrequest', 'Auth\RegisterConfirmationController@send')->name('register.send')->middleware('auth');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles.show');
Route::get('/user/{user}/notifications', 'NotificationsController@index')->name('notifications.index');
Route::delete('/user/{user}/notifications/{notification}', 'NotificationsController@markAsRead')->name('notifications.markAsRead');
Route::delete('/user/{user}/notifications', 'NotificationsController@markAllAsRead')->name('notifications.markAllAsRead');
Route::post('/user/{user}/avatar', 'AvatarsController@store')->name('avatars.store');


Route::resource('/tags', 'TagsController')->middleware('auth');
Route::resource('/posts', 'PostsController');
Route::get('/posts/{post}/replies', 'PostRepliesController@index')->name('post.replies.index');
Route::post('/posts/{post}/replies', 'PostRepliesController@store')->name('post.replies.store');
Route::patch('/posts/{post}/replies/{reply}', 'PostRepliesController@update')->name('post.replies.update');
Route::delete('/posts/{post}/replies/{reply}', 'PostRepliesController@destroy')->name('post.replies.destroy');


Route::redirect('/', '/main', 301);
Route::redirect('/home', '/main', 301);  // TEMPORARY: find actions that redirect home!

Route::get('/main/{locale?}', function ($locale = null) {
    if ($locale != 'ru') {
        $locale = 'en';
    }

    App::setLocale($locale);

    return view('pages.main', compact('locale'));
})->name('main');


