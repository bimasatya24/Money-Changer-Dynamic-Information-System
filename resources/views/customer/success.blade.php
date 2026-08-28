@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Pesanan Berhasil') }}
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

<main class="container mx-auto px-4 py-12 max-w-2xl font-verdana">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">

        {{-- Icon --}}
        <div class="mx-auto w-20 h-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center mb-6">
            <i class="fa-solid fa-circle-check text-4xl"></i>
        </div>

        {{-- Title --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-3">
            {{ __('Pesanan Berhasil Dikirim') }}
        </h2>

        {{-- Information --}}
        <div class="mt-6 p-5 rounded-2xl bg-blue-50/80 border border-blue-200 text-sm text-blue-900 text-left space-y-2">
            <div class="flex items-center gap-2 font-bold text-blue-950">
                <i class="fa-solid fa-building-circle-check text-blue-600 text-base"></i>
                <span>{{ __('Pengambilan di Kantor Tanjung Karang (Pusat No. 1)') }}</span>
            </div>
            <p class="text-xs text-gray-600">
                {{ __('Pesanan valuta asing Anda telah masuk ke sistem kami. Silakan datang ke Kantor Pusat Tanjung Karang pada jam operasional untuk melakukan transaksi dan serah terima valas.') }}
            </p>
            <div class="pt-2 border-t border-blue-200/60 text-xs flex flex-wrap justify-between text-gray-700">
                <span><b>Alamat:</b> Jl. Raden Intan No. 71, Tanjung Karang</span>
                <span><b>WhatsApp:</b> +62 821-6311-0597</span>
            </div>
        </div>

        {{-- Button --}}
        <a
            href="{{ route('home') }}"
            class="inline-block w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition-colors">

            <i class="fa-solid fa-house mr-2"></i>
            {{ __('Kembali ke Beranda') }}

        </a>

    </section>

</main>

@include('layout.footer')