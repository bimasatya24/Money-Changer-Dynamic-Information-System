<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function ktp()
    {
        $user = Auth::user();

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
            ->route('customer.location')
            ->with('success', 'Data KTP berhasil disimpan.');
    }

    public function location()
    {
        return view('customer.location');
    }

    public function saveLocation(Request $request)
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        session([
            'delivery_location' => [
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
            ],
        ]);

        return redirect()
            ->route('customer.order')
            ->with('success', 'Lokasi pengantaran berhasil dipilih.');
    }

    public function order()
    {
        return view('customer.order');
    }

    public function saveOrder(Request $request)
    {
        $validated = $request->validate([
            'transaction_type' => ['required', 'in:buy,sell'],
            'currency' => ['required', 'string', 'max:10'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $deliveryLocation = session('delivery_location');

        if (! $deliveryLocation) {
            return redirect()
                ->route('customer.location')
                ->withErrors([
                    'location' => 'Lokasi pengantaran belum dipilih.',
                ]);
        }

        session([
            'order_data' => [
                'transaction_type' => $validated['transaction_type'],
                'currency' => $validated['currency'],
                'amount' => $validated['amount'],
            ],
        ]);

        return redirect()
            ->route('customer.order.confirmation');
    }

    public function confirmation()
    {
        $orderData = session('order_data');
        $deliveryLocation = session('delivery_location');

        if (! $orderData || ! $deliveryLocation) {
            return redirect()
                ->route('customer.order')
                ->withErrors([
                    'order' => 'Data pesanan belum lengkap.',
                ]);
        }

        return view('customer.confirmation', compact(
            'orderData',
            'deliveryLocation'
        ));
    }

    public function confirmOrder(WhatsAppService $whatsappService)
    {
        $orderData = session('order_data');
        $deliveryLocation = session('delivery_location');

        if (! $orderData || ! $deliveryLocation) {
            return redirect()
                ->route('customer.order')
                ->withErrors([
                    'order' => 'Data pesanan belum lengkap.',
                ]);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'transaction_type' => $orderData['transaction_type'],
            'currency' => $orderData['currency'],
            'amount' => $orderData['amount'],
            'latitude' => $deliveryLocation['latitude'],
            'longitude' => $deliveryLocation['longitude'],
            'status' => 'pending',
        ]);

        $order->load('user');

        $whatsappService->sendOrderNotification($order);

        session()->forget([
            'order_data',
            'delivery_location',
        ]);

        return redirect()
            ->route('customer.order.success');
    }

    public function success()
    {
        return view('customer.success');
    }
}
