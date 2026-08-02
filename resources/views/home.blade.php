@include('layout.header')
    <ul class="list-none p-0 bg-blue-400 flex justify-center font-verdana">
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Tabel Kurs Real-Time</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Company Profile</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Informasi Perusahaan</a></li>
    </ul>

    <div class="flex font-verdana mt-4">
        <search>
            <form>
                <div class="relative w-80 ml-14">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                    <input type="search" name="" id="searchInput" placeholder="Pencarian" class="w-full py-2 pl-10 pr-4 rounded-2xl border-2">
                </div>
            </form>
        </search>
        <button class="ml-5 pl-5 bg-blue-400 text-white py-2 px-16 cursor-pointer rounded-2xl border-black border-2">
            <i class="fa-solid fa-arrow-rotate-left"></i>
            Sinkronisasi
        </button>
    </div>
    
    <div class="flex justify-center font-verdana">
        <table class="w-[91%] border-collapse text-center mt-4">
            <thead class="bg-blue-400 text-white">
                <tr>
                    <th class="border-2 border-black">MATA UANG</th>
                    <th class="border-2 border-black">PECAHAN</th>
                    <th class="border-2 border-black">BELI</th>
                    <th class="border-2 border-black">JUAL</th>
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

    <h1 class="flex justify-center mt-4 font-verdana font-bold">Company Profile</h1>
    
    <div class="bg-blue-400 ml-14 mr-14 mt-4 border-2 p-4 text-justify font-verdana">
        <p class="text-white">
            PT Bina Sukses Valasindo adalah perusahaan resmi yang mengelola kegiatan usaha penukaran valuta asing bukan bank atau money changer, dan melayani kebutuhan pasar di Lampung serta sekitarnya.  Didirikan dan diawasi sesuai aturan dari Bank Indonesia, PT Bina Sukses Valasindo berkomitmen untuk menyediakan layanan transaksi mata uang asing yang aman, dapat dipercaya, transparan, serta kompetitif.
            <br>
            <br>
            Untuk memenuhi kebutuhan nasabah di wilayah Lampung Tengah secara lebih luas, PT Bina Sukses Valasindo membuka cabang operasional di Bandar Jaya yang siap melayani kebutuhan perorangan, bisnis, serta instansi lokal. 
        </p>
    </div>

    <h1 class="flex justify-center mt-4 font-verdana font-bold">Kantor Cabang</h1>
    
    <p class="flex justify-center font-verdana">3 Kantor Money Changer di seluruh Provinsi Lampung</p>

    <div class="flex justify-center font-verdana">
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-4">
            <h1 class="text-white font-bold">Kantor Tanjung Karang</h1>
            <p class="text-white">
                No. Telepon : +62 821-6311-0597
                <br>
                Jam Operasional :
                <br>
                Senin - Jum'at : 08.45 - 17.00
                <br>
                Sabtu : 08.45 - 14.30
            </p>
        </div>
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-4">
            <h1 class="text-white font-bold">Kantor Teluk Betung</h1>
            <p class="text-white">
                No. Telepon : (0721) 482884 / 488288
                <br>
                Jam Operasional :
                <br>
                Senin - Jum'at : 08.30 - 16.30
                <br>
                Sabtu : 08.30 - 14.00
            </p>
        </div>
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-4">
            <h1 class="text-white font-bold">Kantor Bandar Jaya</h1>
            <p class="text-white">
                No. Telepon : +62 857-8951-0332
                <br>
                Jam Operasional :
                <br>
                Senin - Jum'at : 08.30 - 16.30
                <br>
                Sabtu : 08.30 - 14.00
            </p>
        </div>
    </div>

    <h1 class="flex justify-center mt-4 font-verdana font-bold">Informasi Perusahaan</h1>
    
    <div class="bg-blue-400 ml-14 mr-14 mt-4 border-2 border-black p-4 text-justify font-verdana text-white">
        <p>
            PT Bina Sukses Valasindo terletak di area Bandar Jaya Timur, Kecamatan Terbanggi Besar, Kabupaten Lampung Tengah. Tempat ini melayani kebutuhan masyarakat di sekitar Bandar Jaya dalam melakukan transaksi penukaran uang asing secara resmi. 
        </p>
        <br>
        <ol class="list-decimal list-inside space-y-1">
            <li>Alamat: Bandar Jaya Timur, Kec. Terbanggi Besar, Kabupaten Lampung Tengah, Lampung 34163 </li>
            <li>Jam Buka: Senin sampai Jumat pukul 08.10 sampai 16.00 WIB, Sabtu pukul 08.00 sampai 13.00 WIB (Minggu tidak buka).</li>
        </ol>
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
    </script>
@include('layout.footer')