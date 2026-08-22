@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <a href="{{ route('pesan-antar') }}"
                class="px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-500 transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                {{ __('Kembali') }}
            </a>

            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Masuk') }}
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

<main class="container mx-auto px-4 py-10 max-w-lg font-verdana">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

        {{-- Icon --}}
        <div class="flex justify-center mb-5">
            <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-right-to-bracket"></i>
            </div>
        </div>

        {{-- Judul --}}
        <div class="text-center mb-7">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                {{ __('Masuk Akun') }}
            </h2>
        </div>

        {{-- Form --}}
        <form>

            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('Email') }}
                </label>

                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="{{ __('Masukkan email Anda') }}"
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('Password') }}
                </label>

                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="{{ __('Masukkan password Anda') }}"
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
            </div>

            {{-- Tombol --}}
            <button
                type="button"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-sm font-bold transition-colors"
            >
                <i class="fa-solid fa-right-to-bracket mr-2"></i>
                {{ __('Masuk') }}
            </button>

        </form>

        {{-- Link Register --}}
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                {{ __('Belum punya akun?') }}

                <a href="{{ route('customer.register') }}"
                    class="text-blue-600 hover:text-blue-700 font-bold">
                    {{ __('Daftar') }}
                </a>
            </p>
        </div>

    </section>

</main>

@include('layout.footer')