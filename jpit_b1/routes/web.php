<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index')->name('index');

Route::get('/studenthome', 'PagesController@studenthome')->name('studenthome')->middleware('auth');

Route::get('/senseihome', 'PagesController@senseihome')->name('senseihome');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings/security/{id}', function($id) {
	return redirect()->route('students.edit', ['student' => $id]);
})->middleware(['auth', 'password.confirm']);

Route::resource('students', 'StudentController');
