@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Keranjang Pesanan') }}
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

<main class="container mx-auto px-4 py-8 max-w-4xl font-verdana">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('Keranjang Pesanan') }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                {{ __('Periksa kembali valuta yang ingin Anda pesan.') }}
            </p>
        </div>

        <a href="{{ route('customer.order') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl text-sm font-bold transition-colors">
            <i class="fa-solid fa-plus"></i>
            {{ __('Tambah Valuta') }}
        </a>

    </div>

    @if(session('success'))
        <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm">
            <i class="fa-solid fa-circle-check mr-1"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
            <i class="fa-solid fa-circle-exclamation mr-1"></i>
            {{ session('error') }}
        </div>
    @endif

    @if(count($cart) > 0)

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-5 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-cart-shopping text-blue-600"></i>
                    <span class="font-bold text-gray-800">
                        {{ __('Item Pesanan') }}
                    </span>
                </div>

                <span class="text-xs font-bold bg-blue-600 text-white px-2.5 py-1 rounded-full">
                    {{ count($cart) }} {{ __('Item') }}
                </span>
            </div>

            <div class="divide-y divide-gray-100">

                @foreach($cart as $index => $item)

                    @php
                        $isBuy = $item['transaction_type'] === 'buy';
                    @endphp

                    <div class="p-5">

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                </div>

                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-800">
                                            {{ $item['currency'] }}
                                        </span>

                                        @if($isBuy)
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-700">
                                                {{ __('BELI') }}
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-100 text-blue-700">
                                                {{ __('JUAL') }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ __('Nominal') }}
                                    </p>
                                </div>

                            </div>

                            <div class="flex items-center gap-2">

                                <form
                                    action="{{ route('customer.cart.update', $index) }}"
                                    method="POST"
                                    class="flex items-center gap-2">

                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="number"
                                        name="amount"
                                        value="{{ $item['amount'] }}"
                                        min="1"
                                        step="any"
                                        required
                                        class="w-32 px-3 py-2.5 border border-gray-300 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                                    <button
                                        type="submit"
                                        title="{{ __('Ubah jumlah') }}"
                                        class="px-3 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-bold transition-colors">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                </form>

                                <form
                                    action="{{ route('customer.cart.remove', $index) }}"
                                    method="POST"
                                    onsubmit="return confirm('{{ __('Hapus item ini dari keranjang?') }}')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="{{ __('Hapus') }}"
                                        class="px-3 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-sm font-bold transition-colors">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                </form>

                            </div>

                        </div>

                        <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between text-sm">
                            <span class="text-gray-500">
                                {{ __('Jumlah') }}
                            </span>

                            <span class="font-bold text-blue-900">
                                {{ number_format($item['amount'], 2, ',', '.') }}
                                {{ $item['currency'] }}
                            </span>
                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        <div class="mt-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">

            <a
                href="{{ route('customer.order') }}"
                class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm text-center transition-colors">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                {{ __('Tambah Valuta Lain') }}
            </a>

            <a
                href="{{ route('customer.checkout') }}"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm text-center shadow-sm transition-colors">
                {{ __('Lanjut ke Checkout') }}
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>

        </div>

    @else

        <div class="bg-white rounded-2xl shadow-sm border border-dashed border-gray-300 p-10 text-center">

            <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-2xl mb-4">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <h2 class="font-bold text-gray-700 text-lg">
                {{ __('Keranjang masih kosong') }}
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                {{ __('Pilih mata uang yang ingin Anda pesan terlebih dahulu.') }}
            </p>

            <a
                href="{{ route('customer.order') }}"
                class="inline-flex items-center gap-2 mt-5 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm transition-colors">
                <i class="fa-solid fa-plus"></i>
                {{ __('Pilih Mata Uang') }}
            </a>

        </div>

    @endif

</main>

@include('layout.footer')