<?php

// Registration and Authorization routes
Auth::routes();
Route::get('/register/confirm', 'Auth\RegisterConfirmationController@confirm')->name('register.confirm');
Route::get('/register/sendconfirmationrequest', 'Auth\RegisterConfirmationController@send')->name('register.send')->middleware('auth');

// User profile routes
Route::prefix('/profiles')->group(function () {
    Route::get('/{user}', 'ProfilesController@show')->name('profiles.show')->middleware('auth');
    Route::post('/{user}/avatar', 'Api\UsersAvatarsController@store')->name('avatars.store')->middleware('auth');
    Route::patch('/{user}/data', 'Api\UsersDataController@data')->name('user.update.data')->middleware('auth');
    Route::patch('/{user}/role', 'Api\UsersDataController@role')->name('user.update.role')->middleware('auth');
    Route::patch('/{user}/password', 'Api\UsersDataController@password')->name('user.update.password')->middleware('auth');
    Route::get('/{user}/notifications', 'Api\NotificationsController@index')->name('notifications.index');
    Route::delete('/{user}/notifications/{notification}', 'Api\NotificationsController@markAsRead')->name('notifications.markAsRead');
    Route::delete('/{user}/notifications', 'Api\NotificationsController@markAllAsRead')->name('notifications.markAllAsRead');
});

// Posts routes
Route::resource('/posts', 'PostsController');
Route::prefix('/posts')->group(function () {
    Route::get('/{post}/adjustments', 'PostsAdjustmentsController@index')->name('adjustments.index');
    Route::get('/{post}/comments', 'Api\PostCommentsController@index')->name('post.comments.index');
    Route::post('/{post}/comments', 'Api\PostCommentsController@store')->name('post.comments.store');
    Route::patch('/{post}/comments/{comment}', 'Api\PostCommentsController@update')->name('post.comments.update');
    Route::delete('/{post}/comments/{comment}', 'Api\PostCommentsController@destroy')->name('post.comments.destroy');
});
Route::get('/search', 'PostsSearchController@search')->name('posts.search');
Route::get('/elasticsearch', 'PostsSearchController@elasticsearch')->name('posts.elasticsearch');

// Pages roues
Route::get('/main/{locale?}', 'PagesController@index')->name('main');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contacts', 'pages.contacts')->name('contacts');
Route::post('/feedback', 'FeedbackController@feedback')->name('feedback');
Route::view('/developers', 'pages.developers')->name('developers');
Route::view('/oauth', 'pages.oauth')->name('oauth')->middleware('auth');
Route::redirect('/', '/main', 301);

// TEMPORATY ROUTES: TESTING Social API

// Redirect to APP OAuth Route
// Route::get('/facebook/login', function () {
//     $fb = new Facebook;
//     return $fb->login();
// });

// Route::get('/facebook/callback', function (Request $request) {
//     // Get authentication code passed by Facebook Login
//     $code = $request->code;
//     // Confirm Identity: Exchanging Code for an User Access Token
//     $fb = new Facebook;
//     $app_access_token = $fb->getAppAccessToken();
//     $user_access_token = $fb->getUserAccessToken($code);
//     $page_access_token = $fb->getPageAccessToken($user_access_token);
//     // Inspect access token
//     if (!$page_access_token || !$fb->isValidAccessToken($page_access_token)) {
//         return 'Error: Something went wrong....';
//     }
//     // Post status to a page timeline on behalf of the Page
//     $result = $fb->postToPage(
//         $message = 'How cool is that!',
//         $link = 'https://laracasts.com/series/whats-new-in-laravel-5-5',
//         $page_access_token
//     );
//     return $result;
// });

// Route::get('/twitter/{id}', function ($id) {
//     $post = Post::findOrFail($id);
//     $result = (new Twitter())->publish($post);
//     dd(json_decode((string) $result->getBody(), true));
// });

// Route::get('/facebook/{id}', function ($id) {
//     $post = Post::findOrFail($id);
//     $result = (new Facebook())->publish($post);
//     dd(json_decode((string) $result->getBody(), true));
// });
