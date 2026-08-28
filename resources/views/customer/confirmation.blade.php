@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Konfirmasi Pesanan') }}
            </span>
        </div>

        <div class="flex items-center space-x-1.5 bg-blue-700 p-1 rounded-xl text-xs font-semibold">
            <a href="{{ route('lang.switch', 'id') }}"
                class="px-3 py-1.5 rounded-lg transition-all {{ app()->getLocale() == 'id' ? 'bg-white text-blue-700 shadow font-bold' : 'text-blue-100 hover:text-white' }}">
                🇮🇩 ID
            </a>

            <a href="{{ route('lang.switch', 'en') }}"
                class="px-3 py-1.5 rounded-lg transition-all {{ app()->getLocale() == 'en' ? 'bg-white text-blue-700 shadow font-bold' : 'text-blue-100 hover:text-white' }}">
                🇺🇸 EN
            </a>
        </div>

    </div>
</nav>

<main class="container mx-auto px-4 py-8 max-w-3xl font-verdana">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('Konfirmasi Pemesanan Valas') }}
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    {{ __('Periksa kembali rincian valuta asing dan lokasi pengambilan Anda.') }}
                </p>
            </div>
        </div>

        {{-- Daftar Rincian Multi-Item Valas --}}
        <div class="p-5 rounded-2xl bg-gray-50 border border-gray-200 mb-5">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
                <h3 class="font-bold text-gray-800 text-sm md:text-base flex items-center gap-2">
                    <i class="fa-solid fa-money-bill-transfer text-blue-600"></i>
                    {{ __('Daftar Mata Uang yang Dipesan') }}
                </h3>
                <span class="text-xs font-bold px-2.5 py-1 bg-blue-600 text-white rounded-full">
                    {{ count($orderData['items']) }} Item Valas
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="text-xs text-gray-500 border-b border-gray-200">
                            <th class="pb-2">#</th>
                            <th class="pb-2">{{ __('Jenis') }}</th>
                            <th class="pb-2">{{ __('Mata Uang') }}</th>
                            <th class="pb-2 text-right">{{ __('Nominal Valas') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orderData['items'] as $index => $item)
                        @php
                            $isBuy = $item['transaction_type'] === 'buy';
                        @endphp
                        <tr class="font-semibold text-gray-800">
                            <td class="py-3 text-gray-400 text-xs">{{ $index + 1 }}</td>
                            <td class="py-3">
                                @if($isBuy)
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-arrow-down mr-1"></i> {{ __('Saya ingin beli') }}
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-arrow-up mr-1"></i> {{ __('Saya ingin jual') }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3">
                                <span class="bg-gray-100 px-2.5 py-1 rounded-md text-xs font-bold text-gray-700">
                                    {{ $item['currency'] }}
                                </span>
                            </td>
                            <td class="py-3 text-right font-bold text-blue-900">
                                {{ number_format($item['amount'], 2, ',', '.') }} {{ $item['currency'] }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(!empty($orderData['notes']))
            <div class="mt-4 pt-3 border-t border-gray-200 text-xs text-gray-600">
                <span class="font-bold text-gray-700">{{ __('Catatan:') }}</span> {{ $orderData['notes'] }}
            </div>
            @endif
        </div>

        {{-- Lokasi Pengambilan: Kantor Pusat Tanjung Karang --}}
        <div class="p-5 rounded-2xl bg-blue-50/60 border border-blue-200 mb-5">
            <h3 class="font-bold text-blue-900 text-sm mb-3 flex items-center gap-2">
                <i class="fa-solid fa-location-dot text-blue-600"></i>
                {{ __('Lokasi Pengambilan / Datang ke Lokasi:') }}
            </h3>

            <div class="space-y-2 text-xs md:text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('Kantor Cabang') }}:</span>
                    <span class="font-bold text-blue-900 text-right">{{ __('Kantor Tanjung Karang (Pusat No. 1)') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('Alamat') }}:</span>
                    <span class="font-semibold text-gray-800 text-right">Jl. Raden Intan No. 71, Tanjung Karang, Bandar Lampung</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('Jam Buka') }}:</span>
                    <span class="font-semibold text-gray-800 text-right">Senin - Jum'at: 08.45 - 17.00 | Sabtu: 08.45 - 14.30</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('WhatsApp / Telp') }}:</span>
                    <span class="font-bold text-emerald-600 text-right">+62 821-6311-0597</span>
                </div>
            </div>
        </div>

        {{-- Data Pemesan --}}
        <div class="p-5 rounded-2xl bg-gray-50 border border-gray-200 mb-6">
            <h3 class="font-bold text-gray-800 text-sm mb-3 flex items-center gap-2">
                <i class="fa-solid fa-id-card text-gray-600"></i>
                {{ __('Data Identitas Pemesan (KTP)') }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs md:text-sm">
                <div>
                    <span class="text-gray-500 block">{{ __('Nama sesuai KTP') }}:</span>
                    <span class="font-bold text-gray-800">{{ $user->ktp_name }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">{{ __('NIK (16 Digit)') }}:</span>
                    <span class="font-bold text-gray-800">{{ $user->nik }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">{{ __('Nomor Telepon') }}:</span>
                    <span class="font-bold text-gray-800">{{ $user->phone }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">{{ __('Alamat') }}:</span>
                    <span class="font-bold text-gray-800">{{ $user->ktp_address }} (RT/RW: {{ $user->rt_rw }}, {{ $user->kelurahan_desa }}, {{ $user->kecamatan }})</span>
                </div>
            </div>
        </div>

        {{-- Tombol Navigasi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <a href="{{ route('customer.order') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3.5 rounded-xl font-bold transition-colors text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>{{ __('Ubah Pesanan') }}</span>
            </a>

            <form action="{{ route('customer.order.confirm') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-bold transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>{{ __('Konfirmasi & Kirim Pesanan') }}</span>
                </button>
            </form>
        </div>

    </section>

</main>

@include('layout.footer')