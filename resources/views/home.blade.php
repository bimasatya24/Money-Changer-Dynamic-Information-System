@include('layout.header')
    <ul class="list-none p-0 bg-blue-400 flex justify-center font-verdana">
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Tabel Kurs Real-Time</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Company Profile</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Informasi Perusahaan</a></li>
    </ul>

    <div class="flex font-verdana mt-4">
        <search>
            <form>
                <input type="search" name="" id="" placeholder="Pencarian" class="ml-14 pl-5 py-2 px-8 rounded-2xl border-2">
            </form>
        </search>
        <button class="ml-5 pl-5 bg-blue-400 text-white py-2 px-16 cursor-pointer rounded-2xl border-black border-2">
            Sinkronisasi Otomatis
        </button>
    </div>

    <div class="flex justify-center font-verdana">
        <table class="w-[91%] border-collapse text-center mt-4">
            <thead class="bg-blue-400">
                <tr>
                    <th class="border-2">MATA UANG</th>
                    <th class="border-2">PECAHAN</th>
                    <th class="border-2">BELI</th>
                    <th class="border-2">JUAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
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

    <h1 class="flex justify-center mt-4 font-verdana font-bold">Informasi Perusahaan</h1>
    
    <div class="bg-blue-400 ml-14 mr-14 mt-4 border-2 p-4 text-justify font-verdana">
        <p class="text-white">
            PT Bina Sukses Valasindo terletak di area Bandar Jaya Timur, Kecamatan Terbanggi Besar, Kabupaten Lampung Tengah. Tempat ini melayani kebutuhan masyarakat di sekitar Bandar Jaya dalam melakukan transaksi penukaran uang asing secara resmi. 
            <br>
            <br>
            <ol class="text-white">
                <li>Alamat: Bandar Jaya Timur, Kec. Terbanggi Besar, Kabupaten Lampung Tengah, Lampung 34163 </li>
                <li>Jam Buka: Senin sampai Jumat pukul 08.10 sampai 16.00 WIB, Sabtu pukul 08.00 sampai 13.00 WIB (Minggu tidak buka).</li>
            </ol>
        </p>
    </div>
@include('layout.footer')