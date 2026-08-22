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
                {{ __('Pesan Antar') }}
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
                    <i class="fa-solid fa-truck"></i>
                </div>

                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        {{ __('Pesan Antar Valuta Asing') }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ __('Pesan valuta asing dan dapatkan layanan pengantaran sesuai kebutuhan Anda.') }}
                    </p>
                </div>
            </div>

            <p class="text-sm text-gray-600 leading-relaxed">
                {{ __('Silakan buat akun atau masuk ke akun Anda untuk melakukan pemesanan valuta asing melalui layanan pesan antar.') }}
            </p>

        </div>
    </section>

    {{-- Pilihan --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Registrasi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                <i class="fa-solid fa-user-plus"></i>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-2">
                {{ __('Buat Akun') }}
            </h3>

            <p class="text-sm text-gray-500 leading-relaxed mb-6">
                {{ __('Belum memiliki akun? Daftarkan diri Anda terlebih dahulu untuk menggunakan layanan pesan antar.') }}
            </p>

            <button type="button"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-sm font-bold transition-colors">
                <i class="fa-solid fa-user-plus mr-2"></i>
                {{ __('Registrasi Akun') }}
            </button>

        </div>

        {{-- Masuk --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                <i class="fa-solid fa-right-to-bracket"></i>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-2">
                {{ __('Sudah Memiliki Akun?') }}
            </h3>

            <p class="text-sm text-gray-500 leading-relaxed mb-6">
                {{ __('Masuk ke akun Anda untuk melanjutkan ke proses pemesanan valuta asing.') }}
            </p>

            <button type="button"
                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2.5 rounded-xl text-sm font-bold transition-colors">
                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                {{ __('Masuk Akun') }}
            </button>

        </div>

    </section>
</main>

@include('layout.footer')