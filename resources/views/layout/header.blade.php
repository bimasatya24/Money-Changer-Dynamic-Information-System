<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>PT Bina Sukses Valasindo</title>
</head>

<body class="bg-gray-50 text-gray-900">
    <header class="bg-blue-600 text-white py-3 relative">
        <div class="container mx-auto px-4 text-center">
            <div class="flex items-center justify-between min-h-20">
                {{-- Logo BSV --}}
                <div class="flex items-center">
                    <img src="{{ asset('images\Logo-BSV.png') }}" alt="Logo BSV" class="h-14 w-auto object-contain">
                </div>

                {{-- Informasi Perusahaan --}}
                <div class="text-center flex-1 px-6">
                    <h1 class="font-verdana text-[32px] font-bold">
                        PT Bina Sukses Valasindo
                    </h1>

                    <p class="font-verdana text-[14px]">
                        {{ __('Layanan Penukaran Valuta Asing Terpercaya') }}
                    </p>

                    <p>
                        Jl. Kartini No.51, Kartini, Kec. Tj. Karang Pusat, Kota Bandar Lampung, Lampung 35116
                    </p>

                    <p>
                        {{ __('Telepon / WhatsApp:') }}
                        +62 852-6965-6868
                    </p>
                </div>

                {{-- Logo KUPVA Berizin --}}
                <div class="flex items-center">
                    <img src="{{ asset('images\Logo-KUPVA.png') }}" alt="Logo KUPVA Berizin"
                        class="h-14 w-auto object-contain">
                </div>
            </div>

        </div>
    </header>
