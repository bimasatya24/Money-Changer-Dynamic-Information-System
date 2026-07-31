@include('layout.header')
   <div class="flex justify-center text-center min-h-screen flex-col w-full">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file">Silahkan input file dibawah ini : </label> <br>
            <input type="file" name="file" id="file" accept=".xlsx,.xls" class="border border-solid border-black mt-4 bg-gray-200" required> <br>
            <input type="submit" value="Upload" class="border border-solid border-black bg-gray-200 mt-4 pl-2 pr-2">
        </form>
    </div>
@include('layout.footer')