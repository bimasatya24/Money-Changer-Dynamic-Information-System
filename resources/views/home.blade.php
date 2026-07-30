@include('layout.header')
    <ul class="list-none mb-4 p-0 bg-blue-400 flex justify-center font-verdana">
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Tabel Kurs Real-Time</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Company Profile</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Informasi Perusahaan</a></li>
    </ul>

    <div class="flex font-verdana">
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
                    <th class="border border-2">MATA UANG</th>
                    <th class="border border-2">PECAHAN</th>
                    <th class="border border-2">BELI</th>
                    <th class="border border-2">JUAL</th>
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
@include('layout.footer')