@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex flex-wrap justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}"
                class="px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-500 transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                {{ __('Kembali') }}
            </a>

            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Pemesanan Valas') }}
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

<main class="container mx-auto px-4 py-8 max-w-6xl font-verdana">

    {{-- Header --}}
    <section class="mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

            <div class="flex items-center gap-4 mb-4">
                <div
                    class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xl shadow-sm">
                    <i class="fa-solid fa-building-flag"></i>
                </div>

                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        {{ __('Pemesanan Valas (Ambil di Kantor Tanjung Karang)') }}
                    </h2>
                </div>
            </div>

            <p class="text-sm text-gray-600 leading-relaxed">
                {{ __('Pesan valuta asing secara online dan lakukan serah terima langsung di Kantor Pusat Tanjung Karang. Buat akun atau masuk ke akun Anda untuk memulai pemesanan multi-item.') }}
            </p>

            <div class="mt-4 p-4 rounded-xl bg-blue-50 border border-blue-100 flex items-center gap-3 text-xs text-blue-800">
                <i class="fa-solid fa-location-dot text-base text-blue-600"></i>
                <span><b>Lokasi Pengambilan:</b> PT Bina Sukses Valasindo - Jl. Raden Intan No. 71, Tanjung Karang, Bandar Lampung (+62 821-6311-0597)</span>
            </div>

        </div>
    </section>

    {{-- Alur Pemesanan Valas --}}
    <section class="mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

            <div class="flex items-center gap-3 mb-6">
                <div
                    class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                    <i class="fa-solid fa-list-check"></i>
                </div>

                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                        {{ __('Alur Pemesanan Valas') }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ __('4 langkah mudah melakukan pemesanan valas untuk serah terima di Kantor Tanjung Karang.') }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Langkah 1 --}}
                <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5 hover:border-blue-300 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            1
                        </span>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">
                            {{ __('Registrasi / Masuk') }}
                        </h3>
                    </div>

                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">
                        {{ __('Daftarkan akun baru atau masuk dengan akun Anda untuk memulai proses pemesanan.') }}
                    </p>
                </div>

                {{-- Langkah 2 --}}
                <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5 hover:border-blue-300 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            2
                        </span>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">
                            {{ __('Lengkapi Data KTP') }}
                        </h3>
                    </div>

                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">
                        {{ __('Isi data identitas KTP Anda sekali saja. Sistem otomatis mengingat data diri Anda untuk pemesanan seterusnya.') }}
                    </p>
                </div>

                {{-- Langkah 3 --}}
                <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5 hover:border-blue-300 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            3
                        </span>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">
                            {{ __('Pilih Valas (Multi-Item)') }}
                        </h3>
                    </div>

                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">
                        {{ __('Pilih jenis transaksi (Beli / Jual), mata uang, dan nominal. Anda bisa memesan lebih dari 1 jenis valas.') }}
                    </p>
                </div>

                {{-- Langkah 4 --}}
                <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5 hover:border-blue-300 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            4
                        </span>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">
                            {{ __('Ambil di Kantor Pusat') }}
                        </h3>
                    </div>

                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">
                        {{ __('Konfirmasi pesanan, lalu datang langsung ke Kantor Tanjung Karang untuk serah terima valas Anda.') }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Pilihan Registrasi / Masuk --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Registrasi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">

            <div>
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-user-plus"></i>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ __('Buat Akun') }}
                </h3>

                <p class="text-sm text-gray-500 leading-relaxed mb-6">
                    {{ __('Belum memiliki akun? Daftarkan diri Anda dan lengkapi KTP sekali saja untuk pemesanan seterusnya.') }}
                </p>
            </div>

            <a href="{{ route('customer.register') }}"
                class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-sm font-bold transition-colors shadow-sm">
                <i class="fa-solid fa-user-plus mr-2"></i>
                {{ __('Registrasi Akun') }}
            </a>

        </div>

        {{-- Masuk --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">

            <div>
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ __('Sudah Memiliki Akun?') }}
                </h3>

                <p class="text-sm text-gray-500 leading-relaxed mb-6">
                    {{ __('Masuk ke akun Anda untuk langsung memilih jenis dan nominal valuta asing yang ingin dipesan.') }}
                </p>
            </div>

            <a href="{{ route('customer.login') }}"
                class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 rounded-xl text-sm font-bold transition-colors">
                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                {{ __('Masuk Akun') }}
            </a>

        </div>

    </section>
</main>

@include('layout.footer')
