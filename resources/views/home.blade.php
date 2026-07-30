@include('layout.header')
    <ul class="list-none mb-4 p-0 bg-blue-400 flex justify-center">
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Tabel Kurs Real-Time</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Company Profile</a></li>
        <li class="float-left"><a href="" class="block text-white px-4 py-3.5 no-underline hover:bg-white hover:text-black">Informasi Perusahaan</a></li>
    </ul>

    <div class="flex">
        <search>
            <form>
                <input type="search" name="" id="" placeholder="Pencarian" class="ml-5 pl-5 py-2 px-8 rounded-2xl border-2">
            </form>
        </search>
        <button class="ml-5 pl-5 bg-[#04AA6D] text-white py-2 px-8 cursor-pointer rounded-2xl border-black border-2">
            Sinkronisasi Otomatis
        </button>
    </div>
@include('layout.footer')