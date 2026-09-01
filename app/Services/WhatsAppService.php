<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Mengirim pesan teks melalui WhatsApp Cloud API.
     */
    public function sendTextMessage(string $to, string $message): bool
    {
        if (! config('services.whatsapp.enabled')) {
            Log::info('WhatsApp notification disabled.', [
                'to' => $to,
            ]);

            return false;
        }

        $phoneNumberId = config('services.whatsapp.phone_number_id');
        $accessToken = config('services.whatsapp.access_token');

        if (! $phoneNumberId || ! $accessToken) {
            Log::warning('WhatsApp API credentials are not configured.');

            return false;
        }

        try {
            $response = Http::withToken($accessToken)
                ->post(
                    "https://graph.facebook.com/v23.0/{$phoneNumberId}/messages",
                    [
                        'messaging_product' => 'whatsapp',
                        'recipient_type' => 'individual',
                        'to' => $to,
                        'type' => 'text',
                        'text' => [
                            'preview_url' => false,
                            'body' => $message,
                        ],
                    ]
                );

            if ($response->successful()) {
                Log::info('WhatsApp message sent successfully.', [
                    'to' => $to,
                ]);

                return true;
            }

            Log::error('WhatsApp message failed.', [
                'to' => $to,
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            return false;
        } catch (\Throwable $e) {
            Log::error('WhatsApp API exception.', [
                'to' => $to,
                'message' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function sendOrderNotification($order): bool
    {
        $adminPhone = config('services.whatsapp.admin_phone');

        if (! $adminPhone) {
            Log::warning('WhatsApp admin phone number is not configured.');

            return false;
        }

        $message = "🔔 *Pesanan Baru Money Changer (Ambil di Lokasi)*\n\n";

        $message .= "📋 *Informasi Pesanan*\n";
        $message .= "Kode Pesanan: #{$order->id}\n";
        $message .= "🏢 *Lokasi Pengambilan*: Kantor Tanjung Karang (No. 1)\n\n";

        $message .= "💱 *Daftar Item Valuta:*\n";
        if ($order->items && $order->items->count() > 0) {
            foreach ($order->items as $index => $item) {
                $type = $item->transaction_type === 'buy' ? 'Beli' : 'Jual';
                $amountFormatted = number_format($item->amount, 2, ',', '.');
                $num = $index + 1;
                $message .= "{$num}. [{$type}] {$amountFormatted} {$item->currency}\n";
            }
        } elseif ($order->currency && $order->amount) {
            $type = $order->transaction_type === 'buy' ? 'Beli' : 'Jual';
            $amountFormatted = number_format($order->amount, 2, ',', '.');
            $message .= "1. [{$type}] {$amountFormatted} {$order->currency}\n";
        }

        $message .= "\n👤 *Data Pelanggan:*\n";
        if ($order->user) {
            $message .= 'Nama: '.($order->user->ktp_name ?? '-')."\n";
            $message .= 'No. HP: '.($order->user->phone ?? '-')."\n";
            $message .= 'NIK: '.($order->user->nik ?? '-')."\n";
            $message .= 'Alamat KTP: '.($order->user->ktp_address ?? '-')."\n";
        }

        $message .= "\nMohon siapkan valuta asing di Kantor Tanjung Karang untuk diambil oleh pelanggan.";

        return $this->sendTextMessage($adminPhone, $message);
    }
}
