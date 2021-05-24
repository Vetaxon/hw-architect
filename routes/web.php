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
//    dd($redisClient);

    $redisClient->flushAll();

    $user = User::query()->first()->jsonSerialize();

    for ($i = 0; $i <= 2000; $i++) {

        try {

            if ($i <= 100) {
                $redisClient->set('user_' . ($i + 1) . '_' . 0, $user);
                continue;
            }

            $userKey = 'user_' . ($i + 1) . '_' . (60 + $i);
            $redisClient->set($userKey, $user, ['ex' => 60 + $i]);

            if ($i > 100 && $i <= 200) {
                $redisClient->get($userKey);
            }
        } catch (Throwable $throwable) {
            dump($throwable->getMessage());
            dump('Count of new records - ' . $i);
            break;
        }
    }

    $keys = [];

    foreach ($redisClient->keys('user_*') as $key) {
        $key = str_replace('laravel_database_user_', '', $key);
        $keys[str_replace('_', '', $key)] = $key;
    }

    ksort($keys);

    dump($keys);
    return view('welcome');
});

Route::get('/cached-prob-exp', function () {

    $redisClient = Redis::connection()->client();

    $cachedUsers = $redisClient->get('users');

    if (!$cachedUsers || rand(1, 100) === 10) {
        $cachedUsers = json_encode(User::all()->toArray());
        $redisClient->set('users', $cachedUsers);
    }

    dump(json_decode($cachedUsers, true));
    return view('welcome');
});
