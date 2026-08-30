@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
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

<main class="container mx-auto px-4 py-8 max-w-4xl font-verdana">

    {{-- Banner Data Profil Pelanggan (Ingat Data Diri) --}}
    <div
        class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 mb-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">{{ __('Pemesan Terdaftar:') }}</p>
                <h4 class="font-bold text-gray-800 text-sm md:text-base">{{ $user->ktp_name }} <span
                        class="text-xs font-normal text-gray-500">({{ $user->phone }})</span></h4>
                <p class="text-[11px] text-gray-500">NIK: {{ $user->nik }} | {{ $user->kelurahan_desa }},
                    {{ $user->kecamatan }}</p>
            </div>
        </div>
        <a href="{{ route('customer.ktp', ['edit' => 1]) }}"
            class="px-3.5 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-bold transition-colors whitespace-nowrap">
            <i class="fa-solid fa-pen-to-square mr-1"></i> {{ __('Ubah Data Diri') }}
        </a>
    </div>

    {{-- Card Lokasi Pengambilan: Kantor Pusat Tanjung Karang --}}
    <div class="bg-gradient-to-r from-blue-700 to-indigo-800 rounded-2xl text-white p-6 shadow-md mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div
                    class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold mb-2">
                    <i class="fa-solid fa-building-flag"></i> {{ __('Khusus Ambil di Kantor Pusat') }}
                </div>
                <h2 class="text-xl md:text-2xl font-extrabold tracking-tight">
                    {{ __('Kantor Tanjung Karang (Pusat No. 1)') }}</h2>
                <p class="text-xs md:text-sm text-blue-100 mt-1">
                    Jl. Raden Intan No. 71, Tanjung Karang, Bandar Lampung
                </p>
                <div class="mt-3 flex flex-wrap gap-3 text-xs text-blue-200">
                    <span><i class="fa-solid fa-clock mr-1"></i> <b>{{ __('Senin - Jum\'at') }}:</b> 08.45 - 17.00 |
                        <b>{{ __('Sabtu') }}:</b> 08.45 - 14.30</span>
                    <span><i class="fa-solid fa-phone mr-1"></i> +62 821-6311-0597</span>
                </div>
            </div>
            <div class="hidden lg:block text-right">
                <span class="inline-block px-4 py-2 bg-emerald-500/90 text-white rounded-xl text-xs font-bold shadow">
                    <i class="fa-solid fa-handshake mr-1"></i> {{ __('Siap Diambil di Lokasi') }}
                </span>
            </div>
        </div>
    </div>

    {{-- Form Pemesanan Multi-Item --}}
    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ __('Rincian Mata Uang Pesanan') }}
                    </h2>
                    <p class="text-xs text-gray-500">
                        {{ __('Anda dapat memesan lebih dari 1 mata uang dalam 1 formulir pesanan.') }}</p>
                </div>
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

        <form action="{{ route('customer.cart.add') }}" method="POST" id="orderForm">
            @csrf

            {{-- Container Baris Item Valas --}}
            <div id="itemsContainer" class="space-y-4 mb-6">
                {{-- Item 1 (Default) --}}
                <div class="item-row bg-gray-50 border border-gray-200 p-4 md:p-5 rounded-2xl relative transition-all"
                    data-index="0">
                    <div class="flex items-center justify-between mb-3">
                        <span
                            class="text-xs font-bold text-blue-700 bg-blue-100/70 px-2.5 py-1 rounded-lg item-number-badge">
                            {{ __('Item #1') }}
                        </span>
                        <button type="button"
                            class="btn-delete-item text-rose-500 hover:text-rose-700 text-xs font-bold px-2 py-1 rounded-lg hover:bg-rose-50 transition-colors hidden"
                            onclick="deleteItem(this)">
                            <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Hapus') }}
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        {{-- Jenis Transaksi --}}
                        <div class="md:col-span-4">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                {{ __('Jenis Transaksi') }}
                            </label>
                            <select name="items[0][transaction_type]"
                                class="item-type w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                onchange="updateLiveSummary()">
                                <option value="buy" selected>{{ __('Saya ingin beli') }}</option>
                                <option value="sell">{{ __('Saya ingin jual') }}</option>
                            </select>
                        </div>

                        {{-- Mata Uang --}}
                        <div class="md:col-span-4">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                {{ __('Mata Uang') }}
                            </label>
                            <select name="items[0][currency]" required
                                class="item-currency w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                onchange="updateLiveSummary()">
                                <option value="">{{ __('-- Pilih Mata Uang --') }}</option>
                                @if (isset($currencies) && $currencies->count() > 0)
                                    @foreach ($currencies as $c)
                                        <option value="{{ $c->MATA_UANG }}" {{ $loop->first ? 'selected' : '' }}>
                                            {{ $c->MATA_UANG }} ({{ $c->PECAHAN }})
                                        </option>
                                    @endforeach
                                @else
                                    <option value="USD" selected>USD - US Dollar</option>
                                    <option value="SGD">SGD - Singapore Dollar</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="MYR">MYR - Malaysian Ringgit</option>
                                    <option value="SAR">SAR - Saudi Riyal</option>
                                    <option value="JPY">JPY - Japanese Yen</option>
                                    <option value="AUD">AUD - Australian Dollar</option>
                                    <option value="CNY">CNY - Chinese Yuan</option>
                                @endif
                            </select>
                        </div>

                        {{-- Nominal --}}
                        <div class="md:col-span-4">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                {{ __('Nominal Valuta') }}
                            </label>
                            <input type="number" name="items[0][amount]" value="100" min="1" step="any"
                                required placeholder="Contoh: 100"
                                class="item-amount w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                oninput="updateLiveSummary()">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Tambah Item --}}
            <div class="mb-6">
                <button type="button" onclick="addNewItemRow()"
                    class="flex items-center justify-center gap-2 w-full py-3 bg-blue-50 hover:bg-blue-100 text-blue-700 border-2 border-dashed border-blue-300 rounded-xl text-sm font-bold transition-all cursor-pointer hover:shadow-sm">
                    <i class="fa-solid fa-circle-plus text-base"></i>
                    <span>{{ __('+ Tambah Mata Uang / Item Lain') }}</span>
                </button>
            </div>

            {{-- Catatan Tambahan --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                    {{ __('Catatan Tambahan (Opsional)') }}
                </label>
                <textarea name="notes" rows="2"
                    placeholder="{{ __('Misal: Perkiraan tiba jam 10 pagi, butuh pecahan baru...') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>

            {{-- Ringkasan Pesanan Live --}}
            <div class="p-5 rounded-2xl bg-gray-50 border border-gray-200 mb-6">
                <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-200">
                    <h3 class="font-bold text-gray-800 text-sm">
                        <i class="fa-solid fa-receipt text-blue-600 mr-1.5"></i> {{ __('Ringkasan Pemesanan') }}
                    </h3>
                    <span id="summaryTotalItems"
                        class="text-xs font-bold bg-blue-600 text-white px-2.5 py-0.5 rounded-full">
                        1 Item
                    </span>
                </div>
                <div id="summaryList" class="space-y-2 text-xs md:text-sm">
                    <!-- Dinamis terisi via JS -->
                </div>
                <div
                    class="mt-3 pt-3 border-t border-gray-200 flex items-center justify-between text-xs text-gray-500 font-medium">
                    <span><i class="fa-solid fa-location-dot text-red-500 mr-1"></i> {{ __('Lokasi Ambil:') }}</span>
                    <span class="font-bold text-gray-800">{{ __('Kantor Tanjung Karang (No. 1)') }}</span>
                </div>
            </div>

            {{-- Tombol Tambah ke Keranjang --}}
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-bold text-base shadow-md hover:shadow-lg transition-all cursor-pointer flex items-center justify-center gap-2">
                <span>{{ __('Tambah ke Konfirmasi Pesanan') }}</span>
                <i class="fa-solid fa-cart-plus"></i>
            </button>

            {{-- Tombol Lihat Keranjang --}}
            <a href="{{ route('customer.cart') }}"
                class="w-full mt-3 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-bold text-sm transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-cart-shopping"></i>
                {{ __('Lihat Keranjang') }}
            </a>
        </form>

    </section>

</main>

{{-- Template Options Valas untuk Dynamic Row --}}
<template id="currencyOptionsTemplate">
    <option value="">{{ __('-- Pilih Mata Uang --') }}</option>
    @if (isset($currencies) && $currencies->count() > 0)
        @foreach ($currencies as $c)
            <option value="{{ $c->MATA_UANG }}">
                {{ $c->MATA_UANG }} ({{ $c->PECAHAN }})
            </option>
        @endforeach
    @else
        <option value="USD">USD - US Dollar</option>
        <option value="SGD">SGD - Singapore Dollar</option>
        <option value="EUR">EUR - Euro</option>
        <option value="MYR">MYR - Malaysian Ringgit</option>
        <option value="SAR">SAR - Saudi Riyal</option>
        <option value="JPY">JPY - Japanese Yen</option>
        <option value="AUD">AUD - Australian Dollar</option>
        <option value="CNY">CNY - Chinese Yuan</option>
    @endif
</template>

<script>
    let itemCount = 1;

    function addNewItemRow() {
        const container = document.getElementById('itemsContainer');
        const index = itemCount;
        itemCount++;

        const optionsHtml = document.getElementById('currencyOptionsTemplate').innerHTML;

        const rowDiv = document.createElement('div');
        rowDiv.className =
            'item-row bg-gray-50 border border-gray-200 p-4 md:p-5 rounded-2xl relative transition-all animate-fadeIn';
        rowDiv.setAttribute('data-index', index);

        rowDiv.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-blue-700 bg-blue-100/70 px-2.5 py-1 rounded-lg item-number-badge">
                    {{ __('Item') }} #${container.children.length + 1}
                </span>
                <button type="button" class="btn-delete-item text-rose-500 hover:text-rose-700 text-xs font-bold px-2 py-1 rounded-lg hover:bg-rose-50 transition-colors" onclick="deleteItem(this)">
                    <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Hapus') }}
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        {{ __('Jenis Transaksi') }}
                    </label>
                    <select name="items[${index}][transaction_type]" class="item-type w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none" onchange="updateLiveSummary()">
                        <option value="buy" selected>{{ __('Saya ingin beli') }}</option>
                        <option value="sell">{{ __('Saya ingin jual') }}</option>
                    </select>
                </div>

                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        {{ __('Mata Uang') }}
                    </label>
                    <select name="items[${index}][currency]" required class="item-currency w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none" onchange="updateLiveSummary()">
                        ${optionsHtml}
                    </select>
                </div>

                <div class="md:col-span-4">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        {{ __('Nominal Valuta') }}
                    </label>
                    <input type="number" name="items[${index}][amount]" value="100" min="1" step="any" required placeholder="Contoh: 100" class="item-amount w-full px-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-bold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none" oninput="updateLiveSummary()">
                </div>
            </div>
        `;

        container.appendChild(rowDiv);
        refreshItemBadges();
        updateLiveSummary();
    }

    function deleteItem(btn) {
        const row = btn.closest('.item-row');
        const container = document.getElementById('itemsContainer');
        if (container.children.length > 1) {
            row.remove();
            refreshItemBadges();
            updateLiveSummary();
        }
    }

    function refreshItemBadges() {
        const rows = document.querySelectorAll('.item-row');
        rows.forEach((row, i) => {
            const badge = row.querySelector('.item-number-badge');
            if (badge) badge.innerText = `{{ __('Item') }} #${i + 1}`;
            const delBtn = row.querySelector('.btn-delete-item');
            if (delBtn) {
                if (rows.length > 1) {
                    delBtn.classList.remove('hidden');
                } else {
                    delBtn.classList.add('hidden');
                }
            }
        });
    }

    function updateLiveSummary() {
        const rows = document.querySelectorAll('.item-row');
        const summaryList = document.getElementById('summaryList');
        const summaryTotalItems = document.getElementById('summaryTotalItems');

        summaryTotalItems.innerText = `${rows.length} Item`;
        summaryList.innerHTML = '';

        rows.forEach((row, i) => {
            const type = row.querySelector('.item-type').value;
            const currency = row.querySelector('.item-currency').value || '-';
            const amount = parseFloat(row.querySelector('.item-amount').value) || 0;
            const formattedAmount = amount.toLocaleString('id-ID');

            const isBuy = type === 'buy';
            const badgeClass = isBuy ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700';
            const typeLabel = isBuy ? '{{ __('BELI') }}' : '{{ __('JUAL') }}';

            summaryList.innerHTML += `
                <div class="flex items-center justify-between py-1 border-b border-gray-100 last:border-0">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-gray-500">#${i + 1}</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold ${badgeClass}">${typeLabel}</span>
                        <span class="font-bold text-gray-800">${currency}</span>
                    </div>
                    <span class="font-bold text-gray-800">${formattedAmount} ${currency}</span>
                </div>
            `;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        refreshItemBadges();
        updateLiveSummary();
    });
</script>

@include('layout.footer')
