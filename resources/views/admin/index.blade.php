@include('layout.header')
   <div class="font-verdana mt-4 px-14.5">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file">Silahkan input file dibawah ini : </label> <br>
            <input type="file" name="file" id="file" accept=".xlsx,.xls" class="border border-solid border-black mt-4 bg-gray-200 px-88.25" required>
            <input type="submit" value="Upload" class="border border-solid border-black bg-gray-200 mt-4 pl-2 pr-2 ml-4">
        </form>
    </div>

    @if ($allUpload->count() > 0)
    <div class="flex justify-center font-verdana">
        <table class="w-[91%] border-collapse text-center mt-4">
            <thead class="bg-gray-200 text-black">
                <tr>
                    <th class="border-2 border-black">MATA UANG</th>
                    <th class="border-2 border-black">PECAHAN</th>
                    <th class="border-2 border-black">BELI</th>
                    <th class="border-2 border-black">JUAL</th>
                </tr>
            </thead>
            <tbody>
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
    @endif
@include('layout.footer')