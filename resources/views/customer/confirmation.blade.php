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

            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('Konfirmasi Pesanan') }}
                </h2>
            </div>

        </div>

        {{-- Ringkasan Pesanan --}}
        <div class="p-5 rounded-xl bg-gray-50 border border-gray-200">

            <h3 class="font-bold text-gray-800 mb-4">
                {{ __('Ringkasan Pesanan') }}
            </h3>

            <div class="space-y-4 text-sm">

                {{-- Jenis Transaksi --}}
                <div class="flex justify-between gap-4">
                    <span class="text-gray-500">
                        {{ __('Jenis Transaksi') }}
                    </span>

                    <span class="font-semibold text-gray-800 text-right">
                        {{ $orderData['transaction_type'] === 'buy'
                            ? __('Beli Valuta')
                            : __('Jual Valuta') }}
                    </span>
                </div>

                {{-- Mata Uang --}}
                <div class="flex justify-between gap-4">
                    <span class="text-gray-500">
                        {{ __('Mata Uang') }}
                    </span>

                    <span class="font-semibold text-gray-800 text-right">
                        {{ $orderData['currency'] }}
                    </span>
                </div>

                {{-- Nominal --}}
                <div class="flex justify-between gap-4">
                    <span class="text-gray-500">
                        {{ __('Nominal Valuta') }}
                    </span>

                    <span class="font-semibold text-gray-800 text-right">
                        {{ number_format($orderData['amount'], 2, ',', '.') }}
                    </span>
                </div>

            </div>

        </div>

        {{-- Lokasi Pengantaran --}}
        <div class="mt-5 p-5 rounded-xl bg-gray-50 border border-gray-200">

            <h3 class="font-bold text-gray-800 mb-4">
                {{ __('Lokasi Pengantaran') }}
            </h3>

            <div class="space-y-4 text-sm">

                <div class="flex justify-between gap-4">
                    <span class="text-gray-500">
                        {{ __('Latitude') }}
                    </span>

                    <span class="font-semibold text-gray-800 text-right">
                        {{ $deliveryLocation['latitude'] }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-gray-500">
                        {{ __('Longitude') }}
                    </span>

                    <span class="font-semibold text-gray-800 text-right">
                        {{ $deliveryLocation['longitude'] }}
                    </span>
                </div>

            </div>

        </div>

        {{-- Informasi --}}
        <div class="mt-5 p-4 rounded-xl bg-blue-50 border border-blue-100 text-sm text-blue-800">

            <div class="flex gap-3">

                <i class="fa-solid fa-circle-info mt-0.5"></i>

                <p>
                    {{ __('Pastikan seluruh data pesanan dan lokasi pengantaran sudah benar sebelum melakukan konfirmasi.') }}
                </p>

            </div>

        </div>

        {{-- Tombol --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-6">

            {{-- Kembali --}}
            <a
                href="{{ route('customer.order') }}"
                class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-xl font-bold transition-colors text-center">

                <i class="fa-solid fa-arrow-left mr-2"></i>
                {{ __('Kembali') }}

            </a>

            {{-- Konfirmasi --}}
            <form
                action="{{ route('customer.order.confirm') }}"
                method="POST">

                @csrf

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition-colors">

                    <i class="fa-solid fa-paper-plane mr-2"></i>
                    {{ __('Konfirmasi & Kirim Pesanan') }}

                </button>

            </form>

        </div>

    </section>

</main>

@include('layout.footer')