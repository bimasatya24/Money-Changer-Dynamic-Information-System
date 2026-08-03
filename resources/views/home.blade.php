@include('layout.header')
    <ul class="list-none p-0 bg-blue-400 flex justify-center font-verdana">
        <li class="float-left"><a href="#tabel-kurs-real-time" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Tabel Kurs Real-Time</a></li>
        <li class="float-left"><a href="#company-profile" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Company Profile</a></li>
        <li class="float-left"><a href="#informasi-perusahaan" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Informasi Perusahaan</a></li>
    </ul>

    <h1 id="tabel-kurs-real-time" class="flex justify-center mt-4 font-verdana font-bold">Tabel Kurs Real-Time</h1>

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

    <h1 id="company-profile" class="flex justify-center mt-16 font-verdana font-bold">Company Profile</h1>
    
    <div class="bg-blue-400 ml-14 mr-14 mt-4 border-2 p-4 text-justify font-verdana">
        <p class="text-white">
            PT Bina Sukses Valasindo adalah perusahaan resmi yang mengelola kegiatan usaha penukaran valuta asing bukan bank atau money changer, dan melayani kebutuhan pasar di Lampung serta sekitarnya.  Didirikan dan diawasi sesuai aturan dari Bank Indonesia, PT Bina Sukses Valasindo berkomitmen untuk menyediakan layanan transaksi mata uang asing yang aman, dapat dipercaya, transparan, serta kompetitif.
            <br>
            <br>
            Untuk memenuhi kebutuhan nasabah di wilayah Lampung Tengah secara lebih luas, PT Bina Sukses Valasindo membuka cabang operasional di Bandar Jaya yang siap melayani kebutuhan perorangan, bisnis, serta instansi lokal. 
        </p>
    </div>

    <h1 class="flex justify-center font-verdana font-bold mt-4">Kantor Cabang</h1>
    
    <p class="flex justify-center font-verdana">3 Kantor Money Changer di seluruh Provinsi Lampung</p>

    <div class="flex justify-center font-verdana">
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-3.5">
            <h1 class="text-white font-bold">Kantor Tanjung Karang</h1>
            <p class="text-white mt-3">
                No. Telepon : +62 821-6311-0597
                <br>
                Jam Operasional :
                <br>
                Senin - Jum'at : 08.45 - 17.00
                <br>
                Sabtu : 08.45 - 14.30
                <br>
                Minggu & Hari Libur Nasional : Tutup
            </p>
            <div class="mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.9952311825614!2d105.25108147354263!3d-5.417692654095081!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da5083c07229%3A0xaeb929b36ce55188!2sMoney%20Changer%20PT.%20Bina%20Sukses%20Valasindo!5e0!3m2!1sid!2sid!4v1785677896959!5m2!1sid!2sid" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="rounded border border-black"></iframe>
            </div>
            <a href="http://wa.me/6282163110597" target="_blank" rel="noopener noreferrer" class="text-white underline hover:text-orange-300 font-semibold">
                +62 821-6311-0597 (Chat Via WhatsApp)
            </a>
        </div>
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-4">
            <h1 class="text-white font-bold">Kantor Teluk Betung</h1>
            <p class="text-white mt-3">
                No. Telepon : (0721) 482884 / 488288
                <br>
                Jam Operasional :
                <br>
                Senin - Jum'at : 08.30 - 16.30
                <br>
                Sabtu : 08.30 - 14.00
                <br>
                Minggu & Hari Libur Nasional : Tutup
            </p>
            <div class="mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.7952780726473!2d105.26612162354303!3d-5.448020604333841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d97fdcc0d423%3A0xcbbab15ee8fb4841!2sJl.%20Laksamana%20Malahayati%20No.71%2F32%2C%20Tlk.%20Betung%2C%20Kec.%20Telukbetung%20Selatan%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1785678318613!5m2!1sid!2sid" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="rounded border border-black"></iframe>
            </div>
        </div>
        <div class="bg-blue-400 border-2 mx-11 mt-4 p-4">
            <h1 class="text-white font-bold">Kantor Bandar Jaya</h1>
            <p class="text-white mt-3">
                No. Telepon : +62 857-8951-0332
                <br>
                Jam Operasional :
                <br>
                Senin - Jum'at : 08.30 - 16.30
                <br>
                Sabtu : 08.30 - 14.00
                <br>
                Minggu & Hari Libur Nasional : Tutup
            </p>
            <div class="mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.03878828129!2d105.20950127353615!3d-4.933164150484241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40a884cc66ef45%3A0xa8bb5d73699ecf49!2sPT.%20Bina%20Sukses%20Valasindo!5e0!3m2!1sid!2sid!4v1785677732181!5m2!1sid!2sid" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="rounded border border-black"></iframe>
            </div>
            <a href="http://wa.me/+6285369667788" target="_blank" rel="noopener noreferrer" class="text-white underline hover:text-orange-300 font-semibold">
                +62 853-6966-7788 (Chat Via WhatsApp)
            </a>
        </div>
    </div>

    <h1 id="informasi-perusahaan" class="flex justify-center mt-16 font-verdana font-bold">Informasi Perusahaan</h1>
    
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