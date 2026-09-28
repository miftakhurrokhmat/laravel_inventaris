<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventaris - @yield('judul', 'Aplikasi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center flex-wrap gap-2">
            <div class="flex gap-4 items-center flex-wrap">
                <a href="{{ route('dashboard') }}" class="font-bold text-lg">📦 Inventaris</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm hover:underline">Dashboard</a>
                    <a href="{{ route('inventaris.index') }}" class="text-sm hover:underline">Inventaris</a>
                    <a href="{{ route('peminjaman.index') }}" class="text-sm hover:underline">Peminjaman</a>
                    <a href="{{ route('kategori.index') }}" class="text-sm hover:underline">Kategori</a>
                    <a href="{{ route('kondisi.index') }}" class="text-sm hover:underline">Kondisi</a>
                    <a href="{{ route('laporan.index') }}" class="text-sm hover:underline">Laporan</a>
                @endauth
            </div>
            @auth
                <div class="flex gap-3 items-center text-sm">
                    <span>👤 {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-700">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="container mx-auto p-6">
        @if (session('sukses'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded border border-green-300">
                ✓ {{ session('sukses') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded border border-red-300">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('konten')
    </main>

    <footer class="text-center text-xs text-gray-500 py-6">
        Modul Senior Programmer — Laravel & MySQL
    </footer>
</body>
</html>