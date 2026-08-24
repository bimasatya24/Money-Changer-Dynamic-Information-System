@include('layout.header')

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Isi Pesanan') }}
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
                <i class="fa-solid fa-money-bill-transfer"></i>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('Isi Pesanan') }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Tentukan valuta asing dan nominal yang ingin dipesan.') }}
                </p>
            </div>

        </div>

        <form action="#" method="POST">
            @csrf

            {{-- Jenis Transaksi --}}
            <div class="mb-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('Jenis Transaksi') }}
                </label>

                <div class="grid grid-cols-2 gap-3">

                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            name="transaction_type"
                            value="buy"
                            class="peer sr-only"
                            checked>

                        <div class="border border-gray-300 rounded-xl p-4 text-center
                                    peer-checked:border-blue-600
                                    peer-checked:bg-blue-50
                                    peer-checked:text-blue-700
                                    transition-all">

                            <i class="fa-solid fa-arrow-down mr-2"></i>
                            {{ __('Beli Valuta') }}

                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            name="transaction_type"
                            value="sell"
                            class="peer sr-only">

                        <div class="border border-gray-300 rounded-xl p-4 text-center
                                    peer-checked:border-blue-600
                                    peer-checked:bg-blue-50
                                    peer-checked:text-blue-700
                                    transition-all">

                            <i class="fa-solid fa-arrow-up mr-2"></i>
                            {{ __('Jual Valuta') }}

                        </div>
                    </label>

                </div>

            </div>

            {{-- Mata Uang --}}
            <div class="mb-5">

                <label
                    for="currency"
                    class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('Mata Uang') }}
                </label>

                <select
                    id="currency"
                    name="currency"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="">
                        {{ __('Pilih Mata Uang') }}
                    </option>

                    <option value="USD">USD - US Dollar</option>
                    <option value="SGD">SGD - Singapore Dollar</option>
                    <option value="MYR">MYR - Malaysian Ringgit</option>
                    <option value="EUR">EUR - Euro</option>
                    <option value="SAR">SAR - Saudi Riyal</option>

                </select>

            </div>

            {{-- Nominal --}}
            <div class="mb-5">

                <label
                    for="amount"
                    class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('Nominal Valuta') }}
                </label>

                <div class="relative">

                    <i class="fa-solid fa-money-bill-wave absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        min="1"
                        step="any"
                        required
                        placeholder="{{ __('Masukkan nominal valuta') }}"
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>

            </div>

            {{-- Ringkasan --}}
            <div class="mt-6 p-5 rounded-xl bg-gray-50 border border-gray-200">

                <h3 class="font-bold text-gray-800 mb-4">
                    {{ __('Ringkasan Pesanan') }}
                </h3>

                <div class="space-y-3 text-sm">

                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">
                            {{ __('Jenis Transaksi') }}
                        </span>

                        <span id="summary-type" class="font-semibold text-gray-800">
                            {{ __('Beli Valuta') }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">
                            {{ __('Mata Uang') }}
                        </span>

                        <span id="summary-currency" class="font-semibold text-gray-800">
                            -
                        </span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-gray-500">
                            {{ __('Nominal') }}
                        </span>

                        <span id="summary-amount" class="font-semibold text-gray-800">
                            -
                        </span>
                    </div>

                </div>

            </div>

            {{-- Lanjut --}}
            <button
                type="submit"
                class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition-colors">

                <i class="fa-solid fa-arrow-right mr-2"></i>
                {{ __('Lanjut') }}

            </button>

        </form>

    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const currency = document.getElementById('currency');
        const amount = document.getElementById('amount');

        const summaryCurrency = document.getElementById('summary-currency');
        const summaryAmount = document.getElementById('summary-amount');
        const summaryType = document.getElementById('summary-type');

        function updateSummary() {

            const selectedCurrency =
                currency.options[currency.selectedIndex]?.text || '-';

            const selectedAmount =
                amount.value ? amount.value : '-';

            const selectedType =
                document.querySelector(
                    'input[name="transaction_type"]:checked'
                );

            if (currency.value) {
                summaryCurrency.textContent = selectedCurrency;
            } else {
                summaryCurrency.textContent = '-';
            }

            summaryAmount.textContent = selectedAmount;

            if (selectedType) {
                summaryType.textContent =
                    selectedType.value === 'buy'
                        ? '{{ __("Beli Valuta") }}'
                        : '{{ __("Jual Valuta") }}';
            }
        }

        currency.addEventListener('change', updateSummary);
        amount.addEventListener('input', updateSummary);

        document
            .querySelectorAll('input[name="transaction_type"]')
            .forEach(function (radio) {
                radio.addEventListener('change', updateSummary);
            });

        updateSummary();

    });
</script>

@include('layout.footer')