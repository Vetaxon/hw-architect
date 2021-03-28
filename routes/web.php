<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

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
    dump(User::all()->toArray());
    return view('welcome');
});

Route::get('/cached', function () {

    $redisClient = Redis::connection()->client();

    $cachedUsers = $redisClient->get('users');

    if (!$cachedUsers) {
        $cachedUsers = json_encode(User::all()->toArray());
        $redisClient->set('users', $cachedUsers);
    }

    dump(json_decode($cachedUsers, true));
    return view('welcome');
});

Route::get('/cached-prob-exp', function () {

    $redisClient = Redis::connection()->client();

    $cachedUsers = $redisClient->get('users');

    if (!$cachedUsers || rand(1, 10) === 10) {
        $cachedUsers = json_encode(User::all()->toArray());
        $redisClient->set('users', $cachedUsers);
    }

    dump(json_decode($cachedUsers, true));
    return view('welcome');
});
