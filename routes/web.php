<?php

use App\Models\User;
use App\Models\IndexUser;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Request;

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

Route::get('/users', function () {
    $dateOfBirthStart = Request::query('date_of_birth_start');
    $dateOfBirthEnd = Request::query('date_of_birth_end');

    $userQuery = User::query();

    if ($dateOfBirthStart) {
        $userQuery->where('date_of_birth', '>=', $dateOfBirthStart);
    }

    if ($dateOfBirthEnd) {
        $userQuery->where('date_of_birth', '<=', $dateOfBirthEnd);
    }

    $users = $userQuery
        ->get()
        ->toArray();

    dump($users);

    return view('welcome');
});

Route::get('/index-users', function () {

    $dateOfBirthStart = Request::query('date_of_birth_start');
    $dateOfBirthEnd = Request::query('date_of_birth_end');

    $userQuery = IndexUser::query();

    if ($dateOfBirthStart) {
        $userQuery->where('date_of_birth', '>=', $dateOfBirthStart);
    }

    if ($dateOfBirthEnd) {
        $userQuery->where('date_of_birth', '<=', $dateOfBirthEnd);
    }

    $users = $userQuery
        ->get()
        ->toArray();

    dump($users);

    return view('welcome');
});


