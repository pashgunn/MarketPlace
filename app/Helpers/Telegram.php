<?php

namespace App\Helpers;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Telegram
{
    protected Http $http;
    protected string $bot;

    private string $url = 'https://api.telegram.org/bot';

    public function __construct(Http $http, string $bot)
    {
        $this->http = $http;
        $this->bot = $bot;
    }

    public function send_message(int $chat_id, string $message)
    {
        return $this->http::post($this->url . $this->bot . "/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
        ]);
    }

    public function edit_message(int $chat_id, string $message, $message_id)
    {
        return $this->http::post($this->url . $this->bot . "/editMessageText", [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'message_id' => $message_id,
        ]);
    }

    public function send_buttons(int $chat_id, string $message, $button)
    {
        return $this->http::post($this->url . $this->bot . "/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $button,
        ]);
    }

    public function edit_buttons(int $chat_id, string $message, $button, $message_id)
    {
        return $this->http::post($this->url . $this->bot . "/editMessageText", [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $button,
            'message_id' => $message_id,
        ]);
    }

}
