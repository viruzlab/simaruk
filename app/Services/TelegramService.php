<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $botToken;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
    }

    /**
     * Send a Telegram message to a specific user.
     *
     * @param \App\Models\User $user
     * @param string $message
     * @return bool
     */
    public function sendToUser($user, $message)
    {
        if (!$user->telegram_chat_id) {
            Log::warning("User {$user->email} does not have a telegram_chat_id. Cannot send Telegram message.");
            return false;
        }

        return $this->sendMessage($user->telegram_chat_id, $message);
    }

    /**
     * Send a Telegram message to a specific Chat ID.
     *
     * @param string $chatId
     * @param string $message
     * @return bool
     */
    public function sendMessage($chatId, $message)
    {
        if (!$this->botToken) {
            Log::error('TELEGRAM_BOT_TOKEN is not set in .env');
            return false;
        }

        try {
            $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
            ]);

            if ($response->successful()) {
                return true;
            }

            Log::error('Telegram send message failed: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('Telegram service connection failed: ' . $e->getMessage());
            return false;
        }
    }
}
