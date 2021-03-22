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

Route::get('/ga', function () {

    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST', 'https://analytics.google.com/g/collect?v=2&tid=G-M8MV83S2JG', [
        'form_params' => [
            'dl' => 'http://app.test1',
            'en' => 'test_event',
            'dt' => 'Lara2',
            'epn.event_name' =>  1,
            'epn.test2' =>  33
        ]]);

    echo 'GA page';
    exit();
});
