@include('layout.header')

<main class="container mx-auto px-4 py-8 max-w-6xl font-verdana">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 md:p-6 mb-6">

        <div class="flex items-center gap-3 mb-5">

            <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                <i class="fa-solid fa-file-excel text-lg"></i>
            </div>

            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    Upload Data Kurs
                </h2>
            </div>

        </div>

        <form
            action="{{ route('admin.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="flex flex-col md:flex-row gap-3">

                <div class="relative flex-1">

                    <i class="fa-solid fa-file-arrow-up absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        type="file"
                        name="file"
                        id="file"
                        accept=".xlsx,.xls"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 px-7 rounded-xl shadow-sm hover:shadow transition-all cursor-pointer"
                >
                    <i class="fa-solid fa-upload"></i>
                    <span>Upload</span>
                </button>

            </div>

            <div class="mt-3 flex items-center gap-2 text-xs text-gray-500">
                <i class="fa-solid fa-circle-info text-blue-500"></i>
                <span>Format file yang diperbolehkan: .xlsx dan .xls</span>
            </div>

        </form>

    </section>


    @if (session('success'))
        <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6">

            <i class="fa-solid fa-circle-check mt-0.5"></i>

            <div>
                <p class="font-bold text-sm">
                    Berhasil
                </p>

                <p class="text-xs mt-0.5">
                    {{ session('success') }}
                </p>
            </div>

        </div>
    @endif


    @if (session('error'))
        <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">

            <i class="fa-solid fa-circle-exclamation mt-0.5"></i>

            <div>
                <p class="font-bold text-sm">
                    Terjadi Kesalahan
                </p>

                <p class="text-xs mt-0.5">
                    {{ session('error') }}
                </p>
            </div>

        </div>
    @endif

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="p-5 md:p-6 border-b border-gray-100">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fa-solid fa-table-list"></i>
                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800">
                            Data Nilai Tukar
                        </h2>
                    </div>

                </div>


                <div class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg text-xs font-bold">
                    {{ $allUpload->count() }} Data
                </div>

            </div>

        </div>


        @if ($allUpload->count() > 0)

            <div class="overflow-x-auto">

                <table class="w-full text-center border-collapse">

                    <thead>

                        <tr class="bg-blue-600 text-white text-sm font-semibold tracking-wide">

                            <th class="py-3.5 px-4 text-left pl-6">
                                MATA UANG
                            </th>

                            <th class="py-3.5 px-4">
                                PECAHAN
                            </th>

                            <th class="py-3.5 px-4 bg-blue-700">
                                BSV BELI (IDR)
                            </th>

                            <th class="py-3.5 px-4 bg-blue-800">
                                BSV JUAL (IDR)
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100 text-sm md:text-base font-medium text-gray-700">

                        @foreach ($allUpload as $r)

                            <tr class="hover:bg-blue-50/60 transition-colors">

                                <td class="py-3.5 px-4 text-left pl-6">

                                    <div class="flex items-center gap-2">

                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500"></span>

                                        <span class="bg-gray-100 px-2.5 py-1 rounded-lg border border-gray-200 text-xs font-bold text-gray-800 tracking-wider">
                                            {{ $r->MATA_UANG }}
                                        </span>

                                    </div>

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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 px-6 text-center">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-database text-2xl"></i>
                </div>

                <h3 class="font-bold text-gray-700">
                    Belum Ada Data
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Silakan upload file Excel untuk menambahkan data kurs.
                </p>
            </div>
        @endif
    </section>
</main>

@include('layout.footer')