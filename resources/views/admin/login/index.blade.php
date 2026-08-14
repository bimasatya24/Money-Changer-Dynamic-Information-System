@include('layout.header')

<main class="min-h-[calc(100vh-140px)] flex items-center justify-center px-4 py-12 font-verdana bg-gray-50">

    <div class="w-full max-w-md">

        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white shadow-sm mb-4">
                <i class="fa-solid fa-user-shield text-2xl"></i>
            </div>

            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                Admin Login
            </h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

            @error('login_error')
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-3.5 mb-5">
                    <i class="fa-solid fa-circle-exclamation mt-0.5"></i>

                    <div>
                        <p class="font-bold">
                            Login gagal
                        </p>

                        <p class="text-xs mt-0.5">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            @enderror

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                        Username
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            placeholder="Masukkan Username"
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Masukkan Password"
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all"
                            required
                        >
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 px-6 rounded-xl shadow-sm hover:shadow transition-all cursor-pointer"
                >
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Login</span>
                </button>
            </form>
        </div>
    </div>

</main>

@include('layout.footer')