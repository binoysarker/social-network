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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/profile','profilesController');

Route::get('/search/{slug}','FriendshipController@searchAll');

Route::get('/add-friend/{id1}&{id2}','FriendshipController@add_friend');
Route::get('/accept-friend/{id1}&{id2}','FriendshipController@accept_friend');
Route::get('/remove-friend/{id1}&{id2}','FriendshipController@remove_friend');
Route::get('/all-friends/{id1}','FriendshipController@all_friends');
Route::get('/friend-request/{id1}','FriendshipController@show_friend_request');
Route::get('/friend-request/{id1}','FriendshipController@show_friend_request');
Route::get('/friends-id/{id}','FriendshipController@friends_id');
Route::get('/is-friends/{id1}&{id2}','FriendshipController@is_friends_with');
Route::get('/pending-request/{id1}','FriendshipController@has_pending_request');
Route::get('/pending-request-sent/{id}','FriendshipController@has_pending_request_sent');
Route::get('/pending-request-from/{id1}&{id2}','FriendshipController@has_pending_friend_request_from');
Route::get('/pending-request-sent-to/{id1}&{id2}','FriendshipController@has_pending_friend_request_sent_to');
