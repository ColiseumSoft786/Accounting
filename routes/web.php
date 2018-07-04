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
    return view('welcome');
});

Auth::routes();

// Home Controller

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/assets', 'HomeController@assets')->name('assets')->middleware('auth');
Route::get('/addnew', 'HomeController@addNewValue')->name('addnewvalue')->middleware('auth');
Route::get('/updatelevel', 'HomeController@updatelevel')->name('updatelevel')->middleware('auth');
Route::get('/deleteasset', 'HomeController@deleteasset')->name('deleteasset')->middleware('auth');
Route::get('/getjsonofassets','HomeController@getJson')->name('getJson')->middleware('auth');

//Journal Controller

Route::get('/generalJournal','JournalController@journal')->name('journal')->middleware('auth');


