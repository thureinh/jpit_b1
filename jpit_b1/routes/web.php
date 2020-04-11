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
//Home Route
Route::get('/home', 'HomeController@index')->name('home');

//Routes accessible only by Teacher
Route::middleware(['auth', 'sensei'])->group(function() {
	Route::get('/senseihome', 'PagesController@senseihome')->name('senseihome');
});

//Routes accessible only by Student
Route::middleware(['auth', 'gakusei'])->group(function() {
	Route::get('/studenthome', 'PagesController@studenthome')->name('studenthome');
	//Control Route Of Student
	Route::name('student.')->prefix('student')->group(function () {
	    Route::get('showall', 'StudentController@index')->name('showall');
	    Route::get('show', 'StudentController@show')->name('show');
		Route::get('edit', 'StudentController@edit')->name('edit');
		Route::put('update', 'StudentController@update')->name('update');
		Route::get('setting', function() {
			return redirect()->route('student.edit');
		})->middleware(['password.confirm', 'verified'])->name('setting');
	});
});

Route::get('/', 'PagesController@index')->name('index');

Auth::routes(['verify' => true]);

//Student Setting Route


// resource controller

Route::resource('vocab', 'VocabController');

Route::resource('vocabdetail', 'VocabdetailController');
