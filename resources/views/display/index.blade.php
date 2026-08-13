@include('layout.header')
    <div class="container mx-auto px-4">
        <h2 class="text-center mb-4 font-verdana text-[32px]">Kurs Hari Ini</h2>
        <div>
            <p class="font-bold text-right mb-4 font-verdana text-[27px]">Terakhir diperbarui : {{ $lastUpdated ?? '-' }}</p>
            <div class="flex justify-center">
                <table class="w-[91%] border-collapse text-center mb-4 border border-slate-300 font-verdana text-[32px]">
                    <thead>
                        <tr class="font-bold">
                            <th class="bg-[rgb(220,53,69)] text-white border border-slate-300 p-1 align-middle">MATA UANG</th>
                            <th class="bg-[rgb(118,117,125)] text-white border border-slate-300 p-1 align-middle">PECAHAN</th>
                            <th class="bg-[rgb(255,193,7)] text-black border border-slate-300 p-1 align-middle">BELI</th>
                            <th class="bg-[rgb(25,135,84)] text-black border border-slate-300 p-1 align-middle">JUAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allUpload as $r)
                        @php
                        $group = floor($loop->index / 5) % 5;

                        $bgColor = match($group) {
                        0 => 'bg-[#fff9c4]',
                        1 => 'bg-[#c8e6c9]',
                        2 => 'bg-[#b3e5fc]',
                        3 => 'bg-[#ffccbc]',
                        4 => 'bg-[#ffcc80]',
                        };
                        @endphp

                        <tr class="{{ $bgColor }} font-verdana text-[32px] font-bold">
                            <td class="border border-slate-300 p-2 align-middle">
                                {{ $r->MATA_UANG }}
                            </td>
                            <td class="border border-slate-300 p-2 align-middle">
                                {{ $r->PECAHAN }}
                            </td>
                            <td class="border border-slate-300 p-2 align-middle">
                                {{ $r->BELI < 1000 && fmod($r->BELI, 1) != 0 
                                ? number_format($r->BELI, 2, ',', '.') 
                                : number_format($r->BELI, 0, ',', '.') }}
                            </td>
                            <td class="border border-slate-300 p-2 align-middle">
                                {{ $r->JUAL < 1000 && fmod($r->JUAL, 1) != 0 
                                ? number_format($r->JUAL, 2, ',', '.') 
                                : number_format($r->JUAL, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center font-verdana text-[32px] font-bold text-[rgb(220,53,69)]">
                <b>HARGA SEWAKTU-WAKTU DAPAT BERUBAH</b>
                <br>
                <b>UNTUK KETERSEDIAAN STOK HARAP KONFIRMASI TERLEBIH DAHULU!</b>
            </div>
        </div>
    </div>

    <script>
        function getBgColorClass(index) {
            const group = Math.floor(index / 5) % 5;
            switch(group) {
                case 0: return 'bg-[#fff9c4]';
                case 1: return 'bg-[#c8e6c9]';
                case 2: return 'bg-[#b3e5fc]';
                case 3: return 'bg-[#ffccbc]';
                case 4: return 'bg-[#ffcc80]';
                default: return 'bg-[#fff9c4]';
            }
        }
        function formatNumber(val) {
            const num = parseFloat(val);
            if (isNaN(num)) return '-';
            if (num < 1000 && (num % 1 !== 0)) {
                return num.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
            return Math.round(num).toLocaleString('id-ID');
        }
        function fetchLiveRates() {
            fetch('{{ route("api.rates") }}')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('displayTableBody');
                    if (!tbody) return;
                    tbody.innerHTML = '';
                    data.forEach((r, index) => {
                        const bgColor = getBgColorClass(index);
                        const formatBeli = formatNumber(r.BELI);
                        const formatJual = formatNumber(r.JUAL);
                        tbody.innerHTML += `
                            <tr class="${bgColor} font-verdana text-[32px] font-bold transition-all duration-300">
                                <td class="border border-slate-300 p-2 align-middle">${r.MATA_UANG}</td>
                                <td class="border border-slate-300 p-2 align-middle">${r.PECAHAN}</td>
                                <td class="border border-slate-300 p-2 align-middle">${formatBeli}</td>
                                <td class="border border-slate-300 p-2 align-middle">${formatJual}</td>
                            </tr>
                        `;
                    });
                    const now = new Date();
                    const options = { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                    document.getElementById('lastUpdatedText').innerText = now.toLocaleDateString('id-ID', options).replace('.', ':');
                })
                .catch(err => console.error('Error fetching live rates:', err));
        }
        setInterval(fetchLiveRates, 15000);
    </script>
@include('layout.footer')