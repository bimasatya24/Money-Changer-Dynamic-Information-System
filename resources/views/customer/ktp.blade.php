@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Data KTP') }}
            </span>
        </div>

        <div class="flex items-center space-x-1.5 bg-blue-700 p-1 rounded-xl text-xs font-semibold">
            <a href="{{ route('lang.switch', 'id') }}"
                class="px-3 py-1.5 rounded-lg {{ app()->getLocale() == 'id' ? 'bg-white text-blue-700 shadow font-bold' : 'text-blue-100' }}">
                🇮🇩 ID
            </a>

            <a href="{{ route('lang.switch', 'en') }}"
                class="px-3 py-1.5 rounded-lg {{ app()->getLocale() == 'en' ? 'bg-white text-blue-700 shadow font-bold' : 'text-blue-100' }}">
                🇺🇸 EN
            </a>
        </div>

    </div>
</nav>

<main class="container mx-auto px-4 py-8 max-w-3xl font-verdana">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                <i class="fa-solid fa-id-card"></i>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('Lengkapi Data KTP') }}
                </h2>
            </div>
        </div>

        @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('customer.ktp.save') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Nama sesuai KTP') }}
                    </label>

                    <input type="text"
                        name="ktp_name"
                        value="{{ old('ktp_name', $user->ktp_name) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">

                    @error('ktp_name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('NIK') }}
                    </label>

                    <input type="text"
                        name="nik"
                        value="{{ old('nik', $user->nik) }}"
                        maxlength="16"
                        inputmode="numeric"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">

                    @error('nik')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Nomor Telepon') }}
                    </label>

                    <input type="text"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">

                    @error('phone')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('RT/RW') }}
                    </label>

                    <input type="text"
                        name="rt_rw"
                        value="{{ old('rt_rw', $user->rt_rw) }}"
                        placeholder="Contoh: 001/002"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    
                    @error('rt_rw')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Kelurahan/Desa') }}
                    </label>

                    <input type="text"
                        name="kelurahan_desa"
                        value="{{ old('kelurahan_desa', $user->kelurahan_desa) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    
                    @error('kelurahan_desa')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Kecamatan') }}
                    </label>

                    <input type="text"
                        name="kecamatan"
                        value="{{ old('kecamatan', $user->kecamatan) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    
                    @error('kecamatan')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Alamat KTP') }}
                    </label>

                    <textarea
                        name="ktp_address"
                        rows="3"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('ktp_address', $user->ktp_address) }}</textarea>

                    @error('ktp_address')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror    
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Pekerjaan') }}
                    </label>

                    <input type="text"
                        name="occupation"
                        value="{{ old('occupation', $user->occupation) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">

                    @error('occupation')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror    
                </div>

            </div>

            <button type="submit"
                class="w-full mt-7 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition-colors">
                <i class="fa-solid fa-arrow-right mr-2"></i>
                {{ __('Lanjut ke Pesanan') }}
            </button>

        </form>

    </section>

</main>

@include('layout.footer')