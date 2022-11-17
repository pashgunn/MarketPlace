<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Order $order, Request $request, Telegram $telegram)
    {
        $key = base64_encode(md5(uniqid()));
        $order = $order->create([
            'name' => $request->input('name'),
            'email' => $request->input('email2'),
            'product' => $request->input('product'),
            'secret_key' => $key,
        ]);

        $data = [
            'id' => $order->id,
            'name' => $order->name,
            'email' => $order->email,
            'product' => $order->product,
        ];

        $reply_markup = [
            'inline_keyboard' =>
                [
                    [
                        [
                            'text' => 'Принять',
                            'callback_data' => '1|'.$key,
                        ],
                        [
                            'text' => 'Отклонить',
                            'callback_data' => '0|'.$key,
                        ],
                    ]
                ]
        ];

        $telegram->send_buttons(config('telegram.chat_id'), (string)view('site.messages.new-order', $data), $reply_markup);
        return response()->redirectTo('/');
    }
}
