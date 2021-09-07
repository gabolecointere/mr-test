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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    $users = \App\Models\User::query()
        ->with([
            'posts' => function ($query) {
                $query->withCount('attachments');
                $query->withCount('comments');
            },
            'posts.comments' => function ($query) {
                $query->withCount('attachments');
            },
        ])
        ->get();

    return view('index', [
        'users' => $users
    ]);
});
