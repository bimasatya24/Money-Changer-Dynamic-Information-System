@include('layout.header')
    <div class="font-verdana flex justify-center mt-4">
        <form action="{{ route('admin.login.post') }}" method="POST" class="bg-blue-400 rounded-2xl p-8 w-80">
            @csrf

            @error('login_error')
                <div class="bg-red-500 text-white text-xs font-bold p-2.5 rounded-xl mb-4 text-center border border-red-700">
                    {{ $message }}
                </div>
            @enderror

            <label for="username" class="text-white">Username:</label> <br>
            <input type="text" name="username" id="username" value="{{ old('username') }}" class="rounded-2xl bg-white pl-2 py-1 w-full" required> <br><br>

            <label for="password" class="text-white">Password:</label> <br>
            <input type="password" name="password" id="password" class="rounded-2xl bg-white pl-2 py-1 w-full" required> <br><br>

            <div class="flex justify-center font-verdana mt-2">
                <button type="submit" class="bg-white text-black font-semibold rounded-2xl px-8 py-2 hover:bg-black hover:text-white cursor-pointer">Login</button>
            </div>
        </form>
    </div>
@include('layout.footer')