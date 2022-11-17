<?php

use App\Helpers\Telegram;
use Illuminate\Support\Facades\Http;
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

//Route::get('/', function (Telegram $telegram) {
//    $buttons = [
//        'inline_keyboard' => [
//            [
//                [
//                    'text' => 'button1',
//                    'callback_data' => '1',
//                ],
//                [
//                    'text' => 'button2',
//                    'callback_data' => '2',
//                ],
//            ]
//        ]
//    ];
//
//    $send_message = $telegram->send_buttons(config('telegram.chat_id'), 'fsfsdfsd', json_encode($buttons));
//    $send_message = json_decode($send_message);
//    dd($send_message);
//});

Route::get('/', function(\App\Models\Order $order) {
    return view('site.order', ['orders' => $order->active()->get()]);
});

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::post('/order/store', 'OrderController@store')->name('order.store');
});

