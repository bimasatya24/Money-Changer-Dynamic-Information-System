<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Upload;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function ktp(Request $request)
    {
        $user = Auth::user();

        // Fitur Ingat Data Diri: Jika NIK & nama KTP sudah ada dan bukan mode edit (?edit=1), langsung ke order
        if (!empty($user->nik) && !empty($user->ktp_name) && !$request->has('edit')) {
            return redirect()->route('customer.order');
        }

        return view('customer.ktp', compact('user'));
    }

    public function saveKtp(Request $request)
    {
        $validated = $request->validate([
            'ktp_name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16', 'unique:users,nik,' . Auth::id()],
            'phone' => ['required', 'string', 'max:20'],
            'ktp_address' => ['required', 'string'],
            'rt_rw' => ['required', 'string', 'max:20'],
            'kelurahan_desa' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'occupation' => ['required', 'string', 'max:100'],
        ]);

        Auth::user()->update($validated);

        return redirect()
            ->route('customer.order')
            ->with('success', 'Data profil KTP berhasil disimpan.');
    }

    public function order()
    {
        $user = Auth::user();

        // Pastikan data KTP sudah ada sebelum order
        if (empty($user->nik) || empty($user->ktp_name)) {
            return redirect()
                ->route('customer.ktp')
                ->with('info', 'Silakan lengkapi data identitas KTP Anda terlebih dahulu sebelum melakukan pemesanan.');
        }

        $currencies = Upload::all();

        return view('customer.order', compact('user', 'currencies'));
    }

    public function saveOrder(Request $request)
    {
        $validated = $request->validate([
            'notes' => ['nullable', 'string', 'max:500'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.transaction_type' => ['required', 'in:buy,sell'],
            'items.*.currency' => ['required', 'string', 'max:20'],
            'items.*.amount' => ['required', 'numeric', 'min:1'],
        ]);

        session([
            'order_data' => [
                'pickup_location' => 'Kantor Tanjung Karang',
                'notes' => $validated['notes'] ?? null,
                'items' => $validated['items'],
            ],
        ]);

        return redirect()
            ->route('customer.order.confirmation');
    }

    public function confirmation()
    {
        $orderData = session('order_data');

        if (! $orderData || empty($orderData['items'])) {
            return redirect()
                ->route('customer.order')
                ->withErrors([
                    'order' => 'Data pesanan belum lengkap atau sudah kedaluwarsa.',
                ]);
        }

        $user = Auth::user();

        return view('customer.confirmation', compact(
            'orderData',
            'user'
        ));
    }

    public function confirmOrder(WhatsAppService $whatsappService)
    {
        $orderData = session('order_data');

        if (! $orderData || empty($orderData['items'])) {
            return redirect()
                ->route('customer.order')
                ->withErrors([
                    'order' => 'Data pesanan belum lengkap atau sudah kedaluwarsa.',
                ]);
        }

        $firstItem = $orderData['items'][0];
        $isSingle = count($orderData['items']) === 1;

        $order = Order::create([
            'user_id' => Auth::id(),
            'pickup_location' => 'Kantor Tanjung Karang',
            'transaction_type' => $isSingle ? $firstItem['transaction_type'] : 'multi',
            'currency' => $isSingle ? $firstItem['currency'] : 'MULTI',
            'amount' => $isSingle ? $firstItem['amount'] : collect($orderData['items'])->sum('amount'),
            'status' => 'pending',
            'notes' => $orderData['notes'] ?? null,
        ]);

        foreach ($orderData['items'] as $item) {
            $order->items()->create([
                'transaction_type' => $item['transaction_type'],
                'currency' => $item['currency'],
                'amount' => $item['amount'],
            ]);
        }

        $order->load(['user', 'items']);

        $whatsappService->sendOrderNotification($order);

        session()->forget('order_data');

        return redirect()
            ->route('customer.order.success');
    }

    public function success()
    {
        return view('customer.success');
    }
}
