<?php

use Illuminate\Support\Facades\Route;
use App\Models\{Message,Department,Phonebook,Send,Receiver,Attachement};
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/user/dashboard');
    })->name('dashboard');
});

Route::prefix('user')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        $all_phonebooks = Phonebook::count();
        $all_departments = Department::count();
        $all_messages = Message::count();
        return view('pages.dashboard',[
            'all_phonebooks' => $all_phonebooks,
            'all_departments' => $all_departments,
            'all_messages' => $all_messages
        ]);
    })->name('user.dashboard');

    Route::get('/departments', function () {
        return view('pages.departments');
    })->name('user.departments');

    Route::get('/message', function () {
        return view('pages.message');
    })->name('user.message');

    Route::get('/drafts', function () {
        return view('pages.drafts');
    })->name('user.drafts');

    Route::get('/events',function(){
        return view('pages.events');
    })->name('user.events');

    Route::get('/phonebook',function(){
        return view('pages.phonebook');
    })->name('user.phonebook');
});


