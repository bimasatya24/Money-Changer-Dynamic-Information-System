@include('layout.header')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex flex-wrap justify-between items-center py-2.5">
        <div class="flex items-center space-x-1.5">
            <a href="#kalkulator-valas"
                class="px-3 py-2 rounded-xl text-xs font-semibold hover:bg-blue-500 transition-colors">
                {{ __('Kalkulator Konversi Valas') }}
            </a>
            <a href="#tabel-kurs-real-time"
                class="px-3 py-2 rounded-xl text-xs font-semibold hover:bg-blue-500 transition-colors">
                {{ __('Tabel Kurs Real-Time') }}
            </a>
            <a href="#company-profile"
                class="px-3 py-2 rounded-xl text-xs font-semibold hover:bg-blue-500 transition-colors">
                {{ __('Company Profile') }}
            </a>
            <a href="#cara-pesan-antar"
                class="px-3 py-2 rounded-xl text-xs font-semibold hover:bg-blue-500 transition-colors">
                {{ __('Cara Pesan Antar') }}
            </a>
            <a href="{{ route('pesan-antar') }}"
                class="px-3 py-2 rounded-xl text-xs font-semibold hover:bg-blue-500 transition-colors">
                {{ __('Pesan Antar') }}
            </a>
            <span class="px-3 py-2 rounded-xl text-xs font-semibold opacity-75 cursor-not-allowed">
                {{ __('Kasir') }}
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

    <section class="scroll-mt-20">
        <section id="kalkulator-valas" class="mb-12 scroll-mt-20">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        <i class="fa-solid fa-calculator"></i>
                    </div>
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                            {{ __('Kalkulator Konversi Valas') ?? 'Kalkulator Konversi Valas' }}
                        </h2>
                    </div>
                </div>

                {{-- Pilihan Tipe Transaksi (Tabs) --}}
                <div class="flex bg-gray-100 p-1.5 rounded-xl mb-6 max-w-md">
                    <button type="button" id="tabBeli" onclick="setCalcType('beli')"
                        class="flex-1 py-2 rounded-lg text-xs md:text-sm font-bold transition-all bg-blue-600 text-white shadow">
                        {{ __('Kami Jual') ?? 'Kami Jual' }}
                    </button>
                    <button type="button" id="tabJual" onclick="setCalcType('jual')"
                        class="flex-1 py-2 rounded-lg text-xs md:text-sm font-bold transition-all text-gray-600 hover:text-gray-900">
                        {{ __('Kami Beli') ?? 'Kami Beli' }}
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    {{-- Form Input --}}
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                {{ __('Pilih Mata Uang') ?? 'Pilih Mata Uang' }}
                            </label>
                            <select id="calcCurrency"
                                class="w-full py-2.5 px-4 bg-gray-50 border border-gray-300 rounded-xl text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
                                @foreach ($allUpload as $r)
                                <option value="{{ $r->MATA_UANG }}" data-beli="{{ $r->BELI }}"
                                    data-jual="{{ $r->JUAL }}" data-pecahan="{{ $r->PECAHAN }}">
                                    {{ $r->MATA_UANG }} ({{ $r->PECAHAN }})
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                {{ __('Jumlah / Nominal Valas') ?? 'Jumlah / Nominal Valas' }}
                            </label>
                            <input type="number" id="calcAmount" value="100" min="1" step="any"
                                placeholder="Contoh: 100"
                                class="w-full py-2.5 px-4 bg-gray-50 border border-gray-300 rounded-xl text-sm font-bold text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    {{-- Hasil Konversi (Card Preview) --}}
                    <div
                        class="bg-blue-50/60 border border-blue-100 rounded-2xl p-6 flex flex-col justify-between h-full">
                        <div>
                            <span id="calcLabelResult" class="text-xs font-bold uppercase tracking-wider text-blue-700">
                                {{ __('Estimasi Total yang Harus Dibayar') ?? 'Estimasi Total yang Harus Dibayar' }}:
                            </span>
                            <div class="text-2xl md:text-3xl font-extrabold text-blue-900 mt-2" id="calcResultDisplay">
                                Rp 0
                            </div>
                        </div>

                        <div
                            class="mt-4 pt-4 border-t border-blue-200/60 flex items-center justify-between text-xs text-gray-600 font-medium">
                            <span>{{ __('Kurs Acuan') ?? 'Kurs Acuan' }}:</span>
                            <span id="calcRateInfo" class="font-bold text-blue-800">1 USD = Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="tabel-kurs-real-time" class="text-center mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                {{ __('Tabel Kurs Real-Time') }}
            </h2>
        </div>

        <div
            class="bg-white p-4 rounded-2xl shadow-sm border border-gray-200 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="relative w-full">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="search" id="searchInput" placeholder="{{ __('Pencarian') }}..."
                    class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white text-sm font-semibold tracking-wide">
                            <th class="py-3.5 px-4 text-left pl-6">{{ __('MATA UANG') }}</th>
                            <th class="py-3.5 px-4">{{ __('PECAHAN') }}</th>
                            <th class="py-3.5 px-4 bg-blue-700">{{ __('BELI') }} (IDR)</th>
                            <th class="py-3.5 px-4 bg-blue-800">{{ __('JUAL') }} (IDR)</th>
                            <th class="py-2.5 px-4 text-center">
                                <div
                                    class="flex items-center justify-center gap-1.5 bg-blue-700/80 p-1 rounded-xl w-max mx-auto text-xs">
                                    <span
                                        class="mr-1 font-semibold text-white/90 uppercase tracking-wider text-[11px]">{{ __('TREN') }}:</span>
                                    <button type="button" id="btnTrend7d" onclick="switchTrendPeriod('7d')"
                                        class="px-2.5 py-1 rounded-lg font-bold transition-all bg-white text-blue-700 shadow text-[11px] cursor-pointer">
                                        {{ __('7 Hari') }}
                                    </button>
                                    <button type="button" id="btnTrend30d" onclick="switchTrendPeriod('30d')"
                                        class="px-2.5 py-1 rounded-lg font-bold transition-all text-blue-100 hover:text-white text-[11px] cursor-pointer">
                                        {{ __('1 Bulan') }}
                                    </button>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="rateTableBody"
                        class="divide-y divide-gray-100 text-sm md:text-base font-medium text-gray-700">
                        @foreach ($allUpload as $r)
                        @php
                        $cleanId = preg_replace('/[^A-Za-z0-9]/', '', $r->MATA_UANG . '_' . $r->PECAHAN);
                        @endphp
                        <tr class="hover:bg-blue-50/60 transition-colors">
                            <td class="py-3.5 px-4 text-left pl-6 font-bold text-blue-900 flex items-center gap-2">
                                <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span
                                    class="bg-gray-100 px-2.5 py-1 rounded-lg border border-gray-200 text-xs font-bold text-gray-800 tracking-wider">
                                    {{ $r->MATA_UANG }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-gray-600">
                                {{ $r->PECAHAN }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-emerald-600 bg-emerald-50/40">
                                {{ $r->BELI < 1000 && fmod($r->BELI, 1) != 0
                                        ? number_format($r->BELI, 2, ',', '.')
                                        : number_format($r->BELI, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-blue-700 bg-blue-50/40">
                                {{ $r->JUAL < 1000 && fmod($r->JUAL, 1) != 0
                                        ? number_format($r->JUAL, 2, ',', '.')
                                        : number_format($r->JUAL, 0, ',', '.') }}
                            </td>
                            <td class="py-2 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-28 h-9">
                                        <canvas id="chart-{{ $cleanId }}"
                                            class="w-full h-full sparkline-canvas"
                                            data-base-rate="{{ $r->BELI }}"
                                            data-currency="{{ $cleanId }}"></canvas>
                                    </div>
                                    <span id="badge-{{ $cleanId }}"
                                        class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600">
                                        +0.00%
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div
            class="mt-4 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-xl text-xs md:text-sm text-amber-800 flex flex-col md:flex-row justify-between items-center gap-2">
            <span>⚠️ <b>{{ __('HARGA SEWAKTU-WAKTU DAPAT BERUBAH') }}</b></span>
            <span><b>{{ __('UNTUK KETERSEDIAAN STOK HARAP KONFIRMASI TERLEBIH DAHULU!') }}</b></span>
        </div>
    </section>

    <section id="company-profile" class="mt-16 scroll-mt-20">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                        {{ __('Company Profile') }}
                    </h2>
                </div>
            </div>

            <div class="space-y-4 text-gray-600 text-sm md:text-base leading-relaxed text-justify">
                <p>
                    {{ __('PT Bina Sukses Valasindo adalah perusahaan resmi yang mengelola kegiatan usaha penukaran valuta asing bukan bank atau money changer, dan melayani kebutuhan pasar di Lampung serta sekitarnya. Didirikan dan diawasi sesuai aturan dari Bank Indonesia, PT Bina Sukses Valasindo berkomitmen untuk menyediakan layanan transaksi mata uang asing yang aman, dapat dipercaya, transparan, serta kompetitif.') }}
                </p>
                <p>
                    {{ __('Untuk memenuhi kebutuhan nasabah di wilayah Lampung Tengah secara lebih luas, PT Bina Sukses Valasindo membuka cabang operasional di Bandar Jaya yang siap melayani kebutuhan perorangan, bisnis, serta instansi lokal.') }}
                </p>
            </div>
        </div>
    </section>

    <section id="kantor-cabang" class="mt-16 scroll-mt-20">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                {{ __('Kantor Cabang') }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                {{ __('3 Kantor Money Changer di seluruh Provinsi Lampung') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex items-center gap-2.5 mb-3">
                        <i class="fa-solid fa-location-dot text-blue-600 text-lg"></i>
                        <h3 class="font-bold text-gray-800 text-lg">{{ __('Kantor Tanjung Karang') }}</h3>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-3">
                        <b>{{ __('No. Telepon') }}:</b> +62 821-6311-0597
                    </p>

                    <div class="bg-gray-50 p-3 rounded-xl text-xs text-gray-600 mb-4 space-y-1">
                        <p class="font-bold text-gray-700">{{ __('Jam Operasional') }}:</p>
                        <p>{{ __('Senin - Jum\'at') }}: 08.45 - 17.00</p>
                        <p>{{ __('Sabtu') }}: 08.45 - 14.30</p>
                        <p class="text-red-500 font-semibold">{{ __('Minggu & Hari Libur Nasional : Tutup') }}</p>
                    </div>

                    <div class="rounded-xl overflow-hidden border border-gray-200 h-36 mb-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.9952311825614!2d105.25108147354263!3d-5.417692654095081!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da5083c07229%3A0xaeb929b36ce55188!2sMoney%20Changer%20PT.%20Bina%20Sukses%20Valasindo!5e0!3m2!1sid!2sid!4v1785677896959!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <a href="http://wa.me/6282163110597" target="_blank" rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-colors">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>{{ __('Chat Via WhatsApp') }}</span>
                    </a>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex items-center gap-2.5 mb-3">
                        <i class="fa-solid fa-location-dot text-blue-600 text-lg"></i>
                        <h3 class="font-bold text-gray-800 text-lg">{{ __('Kantor Teluk Betung') }}</h3>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-3">
                        <b>{{ __('No. Telepon') }}:</b> (0721) 482884 / 488288
                    </p>

                    <div class="bg-gray-50 p-3 rounded-xl text-xs text-gray-600 mb-4 space-y-1">
                        <p class="font-bold text-gray-700">{{ __('Jam Operasional') }}:</p>
                        <p>{{ __('Senin - Jum\'at') }}: 08.30 - 16.30</p>
                        <p>{{ __('Sabtu') }}: 08.30 - 14.00</p>
                        <p class="text-red-500 font-semibold">{{ __('Minggu & Hari Libur Nasional : Tutup') }}</p>
                    </div>

                    <div class="rounded-xl overflow-hidden border border-gray-200 h-36 mb-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.7952780726473!2d105.26612162354303!3d-5.448020604333841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d97fdcc0d423%3A0xcbbab15ee8fb4841!2sJl.%20Laksamana%20Malahayati%20No.71%2F32%2C%20Tlk.%20Betung%2C%20Kec.%20Telukbetung%20Selatan%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1785678318613!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <span
                        class="flex items-center justify-center gap-2 w-full py-2.5 bg-gray-200 text-gray-600 rounded-xl text-xs font-bold">
                        <i class="fa-solid fa-phone text-sm"></i>
                        <span>(0721) 482884</span>
                    </span>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex items-center gap-2.5 mb-3">
                        <i class="fa-solid fa-location-dot text-blue-600 text-lg"></i>
                        <h3 class="font-bold text-gray-800 text-lg">{{ __('Kantor Bandar Jaya') }}</h3>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-3">
                        <b>{{ __('No. Telepon') }}:</b> +62 857-8951-0332
                    </p>

                    <div class="bg-gray-50 p-3 rounded-xl text-xs text-gray-600 mb-4 space-y-1">
                        <p class="font-bold text-gray-700">{{ __('Jam Operasional') }}:</p>
                        <p>{{ __('Senin - Jum\'at') }}: 08.10 - 16.00</p>
                        <p>{{ __('Sabtu') }}: 08.00 - 13.00</p>
                        <p class="text-red-500 font-semibold">{{ __('Minggu & Hari Libur Nasional : Tutup') }}</p>
                    </div>

                    <div class="rounded-xl overflow-hidden border border-gray-200 h-36 mb-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.03878828129!2d105.20950127353615!3d-4.933164150484241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40a884cc66ef45%3A0xa8bb5d73699ecf49!2sPT.%20Bina%20Sukses%20Valasindo!5e0!3m2!1sid!2sid!4v1785677732181!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <a href="http://wa.me/+6285369667788" target="_blank" rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-colors">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>{{ __('Chat Via WhatsApp') }}</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

</main>

<button id="scrollToTop" onclick="scrollToTop()"
    class="fixed bottom-5 right-5 btn btn-circle bg-black text-white border-2 border-white shadow-lg hidden z-50 hover:bg-gray-800"
    title="Scroll ke atas">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<div id="rateNotification"
    class="fixed top-5 right-5 z-100 hidden w-87.5 max-w-[calc(100vw-2rem)] bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">
    <div class="flex items-start gap-3 p-4">
        <div
            class="w-10 h-10 shrink-0 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
            <i class="fa-solid fa-bell"></i>
        </div>

        <div class="flex-1 min-w-0">
            <h3 id="rateNotificationTitle"
                class="font-bold text-gray-800 text-sm">
                {{ __('Perubahan Kurs') }}
            </h3>

            <p id="rateNotificationMessage"
                class="text-xs text-gray-600 mt-1 leading-relaxed">
            </p>
        </div>

        <button type="button"
            onclick="hideRateNotification()"
            class="text-gray-400 hover:text-gray-700 transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>

<section id="cara-pesan-antar" class="mt-16 scroll-mt-20">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

        <div class="flex items-center gap-3 mb-6">
            <div
                class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                <i class="fa-solid fa-truck"></i>
            </div>

            <div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-800">
                    {{ __('Cara Pesan Antar') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Ikuti beberapa langkah berikut untuk melakukan pemesanan layanan pesan antar.') }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Langkah 1 --}}
            <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <span
                        class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                        1
                    </span>
                    <h3 class="font-bold text-gray-800">
                        {{ __('Lengkapi Data') }}
                    </h3>
                </div>

                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ __('Lengkapi data pelanggan yang diperlukan sebelum melanjutkan proses pemesanan.') }}
                </p>
            </div>

            {{-- Langkah 2 --}}
            <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <span
                        class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                        2
                    </span>
                    <h3 class="font-bold text-gray-800">
                        {{ __('Tentukan Lokasi') }}
                    </h3>
                </div>

                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ __('Tentukan lokasi pengantaran yang akan digunakan untuk proses pesan antar.') }}
                </p>
            </div>

            {{-- Langkah 3 --}}
            <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <span
                        class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                        3
                    </span>
                    <h3 class="font-bold text-gray-800">
                        {{ __('Isi Pesanan') }}
                    </h3>
                </div>

                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ __('Tentukan mata uang, nominal, dan data pesanan yang diperlukan.') }}
                </p>
            </div>

            {{-- Langkah 4 --}}
            <div class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <span
                        class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                        4
                    </span>
                    <h3 class="font-bold text-gray-800">
                        {{ __('Kirim Pesanan') }}
                    </h3>
                </div>

                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ __('Periksa kembali data pesanan kemudian kirim pesanan untuk diproses.') }}
                </p>
            </div>

        </div>
    </div>
</section>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const filterValue = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#rateTableBody tr');

        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(filterValue) ? '' : 'none';
        });
    });

    // --- STATE PERIODE TREN (7 Hari / 1 Bulan) ---
    let currentTrendPeriod = '7d';

    function switchTrendPeriod(period) {
        currentTrendPeriod = period;
        const btn7d = document.getElementById('btnTrend7d');
        const btn30d = document.getElementById('btnTrend30d');

        if (period === '7d') {
            btn7d.className =
                'px-2.5 py-1 rounded-lg font-bold transition-all bg-white text-blue-700 shadow text-[11px] cursor-pointer';
            btn30d.className =
                'px-2.5 py-1 rounded-lg font-bold transition-all text-blue-100 hover:text-white text-[11px] cursor-pointer';
        } else {
            btn30d.className =
                'px-2.5 py-1 rounded-lg font-bold transition-all bg-white text-blue-700 shadow text-[11px] cursor-pointer';
            btn7d.className =
                'px-2.5 py-1 rounded-lg font-bold transition-all text-blue-100 hover:text-white text-[11px] cursor-pointer';
        }
        initAllSparklines();
    }

    // --- LOGIKA GENERATOR & RENDER GRAFIK SPARKLINE (7 HARI & 30 HARI) ---
    function get7DayHistory(baseRate, seedStr) {
        let hash = 0;
        for (let i = 0; i < seedStr.length; i++) hash = seedStr.charCodeAt(i) + ((hash << 5) - hash);
        const multipliers = [
            [-0.012, 0.005, -0.003, 0.008, -0.002, 0.004, 0],
            [0.015, -0.008, 0.012, -0.005, -0.008, 0.003, 0],
            [-0.008, -0.004, 0.006, 0.010, -0.005, -0.002, 0],
            [0.006, 0.012, -0.007, 0.003, -0.009, 0.006, 0]
        ];
        const pattern = multipliers[Math.abs(hash) % multipliers.length];
        return pattern.map(m => Math.round(baseRate * (1 + m) * 100) / 100);
    }

    function get30DayHistory(baseRate, seedStr) {
        let hash = 0;
        for (let i = 0; i < seedStr.length; i++) hash = seedStr.charCodeAt(i) + ((hash << 5) - hash);
        const points = [];
        let current = baseRate * (1 + ((Math.abs(hash) % 20) - 10) * 0.002);
        for (let i = 0; i < 30; i++) {
            const step = Math.sin((i + Math.abs(hash)) * 0.4) * 0.004 + (Math.cos(i * 0.7) * 0.002);
            current = current * (1 + step);
            points.push(Math.round(current * 100) / 100);
        }
        points[29] = baseRate; // Titik terakhir selalu harga kurs hari ini
        return points;
    }

    function renderSparklineChart(canvasId, badgeId, historyData, labels) {
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        if (canvas._chartInstance) {
            canvas._chartInstance.destroy();
        }

        const first = historyData[0];
        const last = historyData[historyData.length - 1];
        const diffPercent = first > 0 ? ((last - first) / first) * 100 : 0;
        const badge = document.getElementById(badgeId);
        if (badge) {
            const sign = diffPercent >= 0 ? '+' : '';
            badge.innerText = `${sign}${diffPercent.toFixed(2)}%`;
            if (diffPercent >= 0) {
                badge.className = 'text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600';
            } else {
                badge.className = 'text-[11px] font-bold px-2 py-0.5 rounded-full bg-rose-50 text-rose-600';
            }
        }

        const is7d = historyData.length <= 7;

        const verticalLinePlugin = {
            id: 'verticalLine',

            afterDraw(chart) {
                if (chart.tooltip?._active?.length) {
                    const activePoint = chart.tooltip._active[0];
                    const ctx = chart.ctx;
                    const x = activePoint.element.x;

                    const topY = chart.chartArea.top;
                    const bottomY = chart.chartArea.bottom;

                    ctx.save();

                    ctx.beginPath();
                    ctx.moveTo(x, topY);
                    ctx.lineTo(x, bottomY);

                    ctx.lineWidth = 1;
                    ctx.strokeStyle = '#9ca3af';
                    ctx.setLineDash([4, 4]);

                    ctx.stroke();
                    ctx.restore();
                }
            }
        };

        canvas._chartInstance = new Chart(ctx, {
            type: 'line',
            plugins: [verticalLinePlugin],
            data: {
                labels: labels,
                datasets: [{
                    data: historyData,
                    borderWidth: is7d ? 2 : 1.8,
                    pointRadius: 0, // 7 Hari titik jelas, 30 Hari titik halus
                    pointHoverRadius: 5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointBorderColor: '#1e40af',
                    tension: 0.35,
                    // KUNCI: Pewarnaan Dinamis Naik (Hijau) & Turun (Merah) dalam 1 gambar grafik
                    segment: {
                        borderColor: function(ctx) {
                            return ctx.p0.parsed.y <= ctx.p1.parsed.y ? '#059669' : '#dc2626';
                        }
                    }
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        position: 'nearest',
                        yAlign: 'bottom',
                        caretPadding: 10,
                        callbacks: {
                            label: function(context) {
                                const val = context.parsed.y;
                                return 'Rp ' + (val < 1000 && (val % 1 !== 0) ?
                                    val.toLocaleString('id-ID', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }) :
                                    Math.round(val).toLocaleString('id-ID'));
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        display: false
                    },
                    y: {
                        display: false
                    }
                }
            }
        });
    }

    function initAllSparklines() {
        const canvases = document.querySelectorAll('.sparkline-canvas');
        canvases.forEach(canvas => {
            const baseRate = parseFloat(canvas.getAttribute('data-base-rate')) || 0;
            const currency = canvas.getAttribute('data-currency') || 'VALAS';

            if (currentTrendPeriod === '7d') {
                const history = get7DayHistory(baseRate, currency);
                const labels = ['H-6', 'H-5', 'H-4', 'H-3', 'H-2', 'Kemarin', 'Hari ini'];
                renderSparklineChart(canvas.id, 'badge-' + currency, history, labels);
            } else {
                const history = get30DayHistory(baseRate, currency);
                const labels = Array.from({
                    length: 30
                }, (_, i) => i === 29 ? 'Hari ini' : (i === 28 ? 'Kemarin' : `H-${29 - i}`));
                renderSparklineChart(canvas.id, 'badge-' + currency, history, labels);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initAllSparklines();
    });

    window.addEventListener('scroll', function() {
        const button = document.getElementById('scrollToTop');

        if (window.scrollY > 300) {
            button.classList.remove('hidden');
        } else {
            button.classList.add('hidden');
        }
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    let currentCalcType = 'beli';

    function setCalcType(type) {
        currentCalcType = type;
        const tabBeli = document.getElementById('tabBeli');
        const tabJual = document.getElementById('tabJual');
        const labelResult = document.getElementById('calcLabelResult');

        if (type === 'beli') {
            tabBeli.className =
                'flex-1 py-2 rounded-lg text-xs md:text-sm font-bold transition-all bg-blue-600 text-white shadow';
            tabJual.className =
                'flex-1 py-2 rounded-lg text-xs md:text-sm font-bold transition-all text-gray-600 hover:text-gray-900';
            labelResult.innerText = "{{ __('Estimasi Total yang Harus Dibayar') }} (IDR):";
        } else {
            tabJual.className =
                'flex-1 py-2 rounded-lg text-xs md:text-sm font-bold transition-all bg-blue-600 text-white shadow';
            tabBeli.className =
                'flex-1 py-2 rounded-lg text-xs md:text-sm font-bold transition-all text-gray-600 hover:text-gray-900';
            labelResult.innerText = "{{ __('Estimasi Total yang Anda Dapatkan') }} (IDR):";
        }
        calculateConversion();
    }

    function calculateConversion() {
        const select = document.getElementById('calcCurrency');
        const amountInput = document.getElementById('calcAmount');
        const resultDisplay = document.getElementById('calcResultDisplay');
        const rateInfo = document.getElementById('calcRateInfo');

        if (!select || !select.selectedOptions.length) return;

        const selectedOption = select.selectedOptions[0];
        const currency = selectedOption.value;
        const rateBeli = parseFloat(selectedOption.getAttribute('data-beli')) || 0;
        const rateJual = parseFloat(selectedOption.getAttribute('data-jual')) || 0;
        const amount = parseFloat(amountInput.value) || 0;

        // Jika Beli Valas ➔ gunakan kurs Jual Money Changer. Jika Jual Valas ➔ gunakan kurs Beli Money Changer.
        const activeRate = currentCalcType === 'beli' ? rateJual : rateBeli;
        const totalIDR = amount * activeRate;

        // Format angka ke Rupiah
        const formattedTotal = totalIDR.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        });
        const formattedRate = activeRate.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        });

        resultDisplay.innerText = `Rp ${formattedTotal}`;
        rateInfo.innerText = `1 ${currency} = Rp ${formattedRate}`;
    }

    // Jalankan event listener saat input berubah
    document.getElementById('calcCurrency').addEventListener('change', calculateConversion);
    document.getElementById('calcAmount').addEventListener('input', calculateConversion);

    // Hitung otomatis pertama kali saat halaman dimuat
    calculateConversion();

    function fetchLiveRates() {
        let previousRates = null;
        let notificationTimeout = null;

        function formatRate(value) {
            const number = parseFloat(value) || 0;

            return number < 1000 && number % 1 !== 0 ?
                number.toLocaleString('id-ID', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) :
                number.toLocaleString('id-ID', {
                    maximumFractionDigits: 0
                });
        }

        function showRateNotification(changes) {
            const notification = document.getElementById('rateNotification');
            const title = document.getElementById('rateNotificationTitle');
            const message = document.getElementById('rateNotificationMessage');

            if (!notification || !changes.length) return;

            title.innerText = "{{ __('Perubahan Kurs') }}";

            if (changes.length === 1) {
                const change = changes[0];

                message.innerHTML = `
                <b>${change.currency}</b> (${change.pecahan})<br>
                ${change.beliChanged
                    ? `Beli: Rp ${formatRate(change.oldBeli)} → <b>Rp ${formatRate(change.newBeli)}</b><br>`
                    : ''
                }
                ${change.jualChanged
                    ? `Jual: Rp ${formatRate(change.oldJual)} → <b>Rp ${formatRate(change.newJual)}</b>`
                    : ''
                }
            `;
            } else {
                message.innerHTML =
                    `{{ __('Terdapat') }} <b>${changes.length}</b> {{ __('data kurs yang mengalami perubahan.') }}`;
            }

            notification.classList.remove('hidden');

            clearTimeout(notificationTimeout);

            notificationTimeout = setTimeout(() => {
                hideRateNotification();
            }, 7000);
        }

        function hideRateNotification() {
            const notification = document.getElementById('rateNotification');

            if (notification) {
                notification.classList.add('hidden');
            }
        }

        function updateRateTable(data) {
            const tbody = document.getElementById('rateTableBody');

            if (!tbody) return;

            const rows = tbody.querySelectorAll('tr');

            data.forEach(r => {
                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');

                    if (cells.length < 4) return;

                    const currency = cells[0].innerText.trim();
                    const denomination = cells[1].innerText.trim();

                    const cleanCurrency = currency
                        .replace(/\s+/g, ' ')
                        .trim();

                    if (
                        cleanCurrency.includes(r.MATA_UANG) &&
                        denomination === String(r.PECAHAN)
                    ) {
                        cells[2].innerText = formatRate(r.BELI);
                        cells[3].innerText = formatRate(r.JUAL);
                    }
                });
            });
        }

        function detectRateChanges(data) {
            if (!previousRates) {
                previousRates = data.map(r => ({
                    MATA_UANG: r.MATA_UANG,
                    PECAHAN: r.PECAHAN,
                    BELI: parseFloat(r.BELI),
                    JUAL: parseFloat(r.JUAL)
                }));

                return [];
            }

            const changes = [];

            data.forEach(current => {
                const old = previousRates.find(item =>
                    item.MATA_UANG === current.MATA_UANG &&
                    String(item.PECAHAN) === String(current.PECAHAN)
                );

                if (!old) return;

                const newBeli = parseFloat(current.BELI);
                const newJual = parseFloat(current.JUAL);

                const beliChanged = old.BELI !== newBeli;
                const jualChanged = old.JUAL !== newJual;

                if (beliChanged || jualChanged) {
                    changes.push({
                        currency: current.MATA_UANG,
                        pecahan: current.PECAHAN,
                        oldBeli: old.BELI,
                        newBeli: newBeli,
                        oldJual: old.JUAL,
                        newJual: newJual,
                        beliChanged: beliChanged,
                        jualChanged: jualChanged
                    });
                }
            });

            previousRates = data.map(r => ({
                MATA_UANG: r.MATA_UANG,
                PECAHAN: r.PECAHAN,
                BELI: parseFloat(r.BELI),
                JUAL: parseFloat(r.JUAL)
            }));

            return changes;
        }

        function fetchLiveRates() {
            fetch('{{ route('api.rates') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data kurs');
                    }

                    return response.json();
                })
                .then(data => {
                    const changes = detectRateChanges(data);

                    // Perbarui tabel kurs
                    updateRateTable(data);

                    // Tampilkan popup hanya jika ada perubahan
                    if (changes.length > 0) {
                        showRateNotification(changes);
                    }

                    // Update kalkulator dengan data terbaru
                    const select = document.getElementById('calcCurrency');

                    if (select) {
                        const selectedCurrency = select.value;

                        data.forEach(r => {
                            const option = Array.from(select.options).find(option =>
                                option.value === r.MATA_UANG &&
                                option.getAttribute('data-pecahan') === String(r.PECAHAN)
                            );

                            if (option) {
                                option.setAttribute('data-beli', r.BELI);
                                option.setAttribute('data-jual', r.JUAL);
                            }
                        });

                        calculateConversion();

                        select.value = selectedCurrency;
                    }

                    // Simpan waktu pembaruan
                    const now = new Date();

                    const options = {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    };

                    const lastUpdated = document.getElementById('lastUpdatedText');

                    if (lastUpdated) {
                        lastUpdated.innerText =
                            now.toLocaleDateString('id-ID', options).replace('.', ':');
                    }
                })
                .catch(err => {
                    console.error('Error fetching live rates:', err);
                });
        }

        fetchLiveRates();

        setInterval(fetchLiveRates, 15000);
    }

    // Ambil data ketika halaman pertama kali dibuka
    fetchLiveRates();

    // Ambil ulang data setiap 15 detik
    setInterval(fetchLiveRates, 15000);
</script>

@include('layout.footer')