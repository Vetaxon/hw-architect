<?php

use App\Tree\BalancedBinaryTree;
use App\Tree\Node;
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

    $tree = new BalancedBinaryTree();

    for ($i = 0; $i < 100; $i++) {
        $tree->insert(new Node($i, [$i]));
    }

    dump($tree->searchByKey(90));

    echo $tree;

    echo '<br>';

    echo $tree->searchByKey(70);

    echo '<br>';

    $tree->delete(70);
    $tree->balance();

    echo '<br>';

    echo $tree;


    $myArray = [9, 1, 2, 5, 9, 9, 2, 1, 3, 3];

    dump($myArray);
    \App\Tree\CountingSort::countingSort($myArray);

    dump($myArray);

    die();
//    return view('welcome');
});
