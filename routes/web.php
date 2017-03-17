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

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Search Routes

Route::get('/keywords_query', 'SearchController@algoliaSearch');

Route::get('/search', 'SearchController@executeSearch');

//Publication Routes

Route::get('publish_property', 'PublishController@goToPublishProperty')->middleware('auth');

Route::get('locate_property', 'PublishController@goToPropertyLocation')->middleware('auth');

Route::get('set_location', 'PublishController@setTypeAndCategory')->middleware('auth');

Route::get('describe_property', 'PublishController@setLocation')->middleware('auth');

Route::get('post_residence', 'PublishController@postResidence')->middleware('auth');

Route::get('review_publication/{residence}', 'PublishController@goToReview')->middleware('auth');

Route::post('/file-upload/{residence}', 'ResidenceController@postPhotos')->middleware('auth');

Route::post('/file-upload-profile/{residence}', 'ResidenceController@postProfilePhoto')->middleware('auth');

Route::post('/uploads/delete/{photo}', 'ResidenceController@deletePhotos')->middleware('auth');

Route::get('/uploaded/delete/{photo}', 'ResidenceController@deleteUploadedPhotos')->middleware('auth');

Route::get('/report/{residence}', 'ResidenceController@reportResidence');

//Dashboard Routes

Route::get('/residence_main/{residence}', 'DashboardController@goToResidenceMain');

Route::get('/dashboard', 'DashboardController@goToDashboard')->middleware('auth');

Route::get('/manage_properties', 'DashboardController@goToManageResidences')->middleware('auth');

Route::get('/property/{residence}', 'DashboardController@goToEditResidence')->middleware('auth');

Route::patch('/edit_residence/{residence}', 'ResidenceController@editResidence')->middleware('auth');

//Notifications Routes

Route::post('/notification/{residence}', 'NotificationController@postNotification');

//Favorites Routes

Route::get('/favorites/{residence}', 'FavoriteController@addResidenceToFavorites')->middleware('auth');

Route::get('/my_favorites', 'FavoriteController@goToFavorites')->middleware('auth');

Route::get('/my_favorites/remove/{residence}', 'FavoriteController@removeFromFavorites')->middleware('auth');