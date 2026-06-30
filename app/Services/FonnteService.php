<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    /**
     * Send WhatsApp notification via Fonnte Gateway.
     *
     * @param string $target Target phone number (e.g., 628123456789 or 08123456789)
     * @param string $message The message body
     * @return bool
     */
    public static function sendWhatsApp(string $target, string $message): bool
    {
        $token = config('services.fonnte.token');
        if (!$token) {
            Log::warning('Fonnte API Token tidak terkonfigurasi di config/services.php');
            return false;
        }

        // Clean target number (ensure only numbers remain)
        $cleanTarget = preg_replace('/[^0-9]/', '', $target);

        // Normalize leading 0 to 62 standard format
        if (str_starts_with($cleanTarget, '0')) {
            $cleanTarget = '62' . substr($cleanTarget, 1);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $cleanTarget,
                'message' => $message,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                Log::info("WhatsApp berhasil terkirim ke {$cleanTarget}");
                return true;
            }

            Log::error("Fonnte API Error response: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("Gagal mengirim WhatsApp ke {$cleanTarget}: " . $e->getMessage());
            return false;
        }
    }
}
