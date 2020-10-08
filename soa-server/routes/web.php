<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use AvtoDev\JsonRPC\RpcRouter;

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

AvtoDev\JsonRpc\RpcRouter::on('get_page', 'App\Http\Controllers\PagesController@getPage');
AvtoDev\JsonRpc\RpcRouter::on('add_page', 'App\Http\Controllers\PagesController@addPage');

Route::post('/rpc', 'AvtoDev\\JsonRpc\\Http\\Controllers\\RpcController');