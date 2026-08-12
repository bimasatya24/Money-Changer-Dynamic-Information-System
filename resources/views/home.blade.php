@include('layout.header')
    <ul class="list-none p-0 bg-blue-400 flex justify-center items-center font-verdana">
        <li class="float-left"><a href="#tabel-kurs-real-time" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">{{ __('Tabel Kurs Real-Time') }}</a></li>
        <li class="float-left"><a href="#company-profile" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">{{ __('Company Profile') }}</a></li>
        <li class="float-left"><a class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">{{ __('Kasir') }}</a></li>
        <li class="float-left flex items-center px-4 gap-1 text-xs my-auto">
            <a href="{{ route('lang.switch', 'id') }}" class="px-2.5 py-1 rounded transition-colors {{ app()->getLocale() == 'id' ? 'bg-white text-blue-700 font-bold shadow' : 'text-white hover:bg-white hover:text-black font-semibold' }}">🇮🇩 ID</a>
            <span class="text-white mx-0.5">|</span>
            <a href="{{ route('lang.switch', 'en') }}" class="px-2.5 py-1 rounded transition-colors {{ app()->getLocale() == 'en' ? 'bg-white text-blue-700 font-bold shadow' : 'text-white hover:bg-white hover:text-black font-semibold' }}">🇺🇸 EN</a>
        </li>
    </ul>

    <h1 id="tabel-kurs-real-time" class="flex justify-center mt-4 font-verdana font-bold">{{ __('Tabel Kurs Real-Time') }}</h1>

    <div class="flex font-verdana mt-4">
        <search>
            <form>
                <div class="relative w-80 ml-14">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input type="search" name="" id="searchInput" placeholder="{{ __('Pencarian') }}" class="w-full py-2 pl-10 pr-4 rounded-2xl border-2">
                </div>
            </form>
        </search>
        <button id="syncBtn" class="ml-5 pl-5 bg-blue-400 text-white py-2 px-16 cursor-pointer rounded-2xl border-black border-2">
            <i class="fa-solid fa-arrow-rotate-left"></i>
            {{ __('Sinkronisasi') }}
        </button>
    </div>
    
    <div class="flex justify-center font-verdana">
        <table class="w-[91%] border-collapse text-center mt-4">
            <thead class="bg-blue-400 text-white">
                <tr>
                    <th class="border-2 border-black">{{ __('MATA UANG') }}</th>
                    <th class="border-2 border-black">{{ __('PECAHAN') }}</th>
                    <th class="border-2 border-black">{{ __('BELI') }}</th>
                    <th class="border-2 border-black">{{ __('JUAL') }}</th>
                </tr>
            </thead>
            <tbody id="rateTableBody">
                @foreach ($allUpload as $r)
                <tr>
                    <td class="border-2 border-black">
                        {{ $r->MATA_UANG }}
                    </td>
                    <td class="border-2 border-black">
                        {{ $r->PECAHAN }}
                    </td>
                    <td class="border-2 border-black">
                        {{ $r->BELI < 1000 && fmod($r->BELI, 1) != 0 
                        ? number_format($r->BELI, 2, ',', '.') 
                        : number_format($r->BELI, 0, ',', '.') }}
                    </td>
                    <td class="border-2 border-black">
                        {{ $r->JUAL < 1000 && fmod($r->JUAL, 1) != 0 
                        ? number_format($r->JUAL, 2, ',', '.') 
                        : number_format($r->JUAL, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h1 id="company-profile" class="flex justify-center mt-16 font-verdana font-bold">{{ __('Company Profile') }}</h1>
    
    <div class="bg-blue-400 ml-14 mr-14 mt-4 border-2 p-4 text-justify font-verdana">
        <p class="text-white">
            {{ __('PT Bina Sukses Valasindo adalah perusahaan resmi yang mengelola kegiatan usaha penukaran valuta asing bukan bank atau money changer, dan melayani kebutuhan pasar di Lampung serta sekitarnya. Didirikan dan diawasi sesuai aturan dari Bank Indonesia, PT Bina Sukses Valasindo berkomitmen untuk menyediakan layanan transaksi mata uang asing yang aman, dapat dipercaya, transparan, serta kompetitif.') }}
            <br>
            <br>
            {{ __('Untuk memenuhi kebutuhan nasabah di wilayah Lampung Tengah secara lebih luas, PT Bina Sukses Valasindo membuka cabang operasional di Bandar Jaya yang siap melayani kebutuhan perorangan, bisnis, serta instansi lokal.') }}
        </p>
    </div>

    <h1 class="flex justify-center font-verdana font-bold mt-4">{{ __('Kantor Cabang') }}</h1>
    
    <p class="flex justify-center font-verdana">{{ __('3 Kantor Money Changer di seluruh Provinsi Lampung') }}</p>

    <div class="flex justify-center font-verdana">
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-3.5">
            <h1 class="text-white font-bold">{{ __('Kantor Tanjung Karang') }}</h1>
            <p class="text-white mt-3">
                {{ __('No. Telepon') }} : +62 821-6311-0597
                <br>
                {{ __('Jam Operasional') }} :
                <br>
                {{ __('Senin - Jum\'at') }} : 08.45 - 17.00
                <br>
                {{ __('Sabtu') }} : 08.45 - 14.30
                <br>
                {{ __('Minggu & Hari Libur Nasional : Tutup') }}
            </p>
            <div class="mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.9952311825614!2d105.25108147354263!3d-5.417692654095081!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da5083c07229%3A0xaeb929b36ce55188!2sMoney%20Changer%20PT.%20Bina%20Sukses%20Valasindo!5e0!3m2!1sid!2sid!4v1785677896959!5m2!1sid!2sid" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="rounded border border-black"></iframe>
            </div>
            <a href="http://wa.me/6282163110597" target="_blank" rel="noopener noreferrer" class="text-white underline hover:text-orange-300 font-semibold">
                +62 821-6311-0597 ({{ __('Chat Via WhatsApp') }})
            </a>
        </div>
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-4">
            <h1 class="text-white font-bold">{{ __('Kantor Teluk Betung') }}</h1>
            <p class="text-white mt-3">
                {{ __('No. Telepon') }} : (0721) 482884 / 488288
                <br>
                {{ __('Jam Operasional') }} :
                <br>
                {{ __('Senin - Jum\'at') }} : 08.30 - 16.30
                <br>
                {{ __('Sabtu') }} : 08.30 - 14.00
                <br>
                {{ __('Minggu & Hari Libur Nasional : Tutup') }}
            </p>
            <div class="mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.7952780726473!2d105.26612162354303!3d-5.448020604333841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d97fdcc0d423%3A0xcbbab15ee8fb4841!2sJl.%20Laksamana%20Malahayati%20No.71%2F32%2C%20Tlk.%20Betung%2C%20Kec.%20Telukbetung%20Selatan%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1785678318613!5m2!1sid!2sid" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="rounded border border-black"></iframe>
            </div>
        </div>
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-4">
            <h1 class="text-white font-bold">{{ __('Kantor Bandar Jaya') }}</h1>
            <p class="text-white mt-3">
                {{ __('No. Telepon') }} : +62 857-8951-0332
                <br>
                {{ __('Jam Operasional') }} :
                <br>
                {{ __('Senin - Jum\'at') }} : 08.10 - 16.00
                <br>
                {{ __('Sabtu') }} : 08.00 - 13.00
                <br>
                {{ __('Minggu & Hari Libur Nasional : Tutup') }}
            </p>
            <div class="mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.03878828129!2d105.20950127353615!3d-4.933164150484241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40a884cc66ef45%3A0xa8bb5d73699ecf49!2sPT.%20Bina%20Sukses%20Valasindo!5e0!3m2!1sid!2sid!4v1785677732181!5m2!1sid!2sid" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="rounded border border-black"></iframe>
            </div>
            <a href="http://wa.me/+6285369667788" target="_blank" rel="noopener noreferrer" class="text-white underline hover:text-orange-300 font-semibold">
                +62 853-6966-7788 ({{ __('Chat Via WhatsApp') }})
            </a>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const filterValue = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#rateTableBody tr');

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();

                if (rowText.includes(filterValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.getElementById('syncBtn').addEventListener('click', function() {
            const btnIcon = this.querySelector('i');
            btnIcon.classList.add('fa-spin');

            fetch('{{ route("api.rates") }}')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('rateTableBody');
                    tbody.innerHTML = '';

                    if (!data || data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="4" class="border-2 border-black py-4">{{ __('Belum ada data kurs.') }}</td></tr>`;
                    } else {
                        data.forEach(r => {
                            const beli = parseFloat(r.BELI);
                            const jual = parseFloat(r.JUAL);

                            const formatBeli = (beli < 1000 && (beli % 1 !== 0))
                                ? beli.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                                : Math.round(beli).toLocaleString('id-ID');

                            const formatJual = (jual < 1000 && (jual % 1 !== 0))
                                ? jual.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                                : Math.round(jual).toLocaleString('id-ID');

                            tbody.innerHTML += `
                                <tr>
                                    <td class="border-2 border-black">${r.MATA_UANG}</td>
                                    <td class="border-2 border-black">${r.PECAHAN}</td>
                                    <td class="border-2 border-black">${formatBeli}</td>
                                    <td class="border-2 border-black">${formatJual}</td>
                                </tr>
                            `;
                        });
                    }

                    // Terapkan filter pencarian kembali jika sedang mencari
                    document.getElementById('searchInput').dispatchEvent(new Event('input'));
                })
                .catch(err => {
                    console.error('Gagal sinkronisasi data:', err);
                })
                .finally(() => {
                    setTimeout(() => {
                        btnIcon.classList.remove('fa-spin');
                    }, 500);
                });
        });
    </script>
@include('layout.footer')