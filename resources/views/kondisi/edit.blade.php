@extends('layouts.app')

@section('judul', 'Ubah Kondisi')

@section('konten')
<h1 class="text-2xl font-bold mb-4">Ubah Kondisi: {{ $kondisi->nama }}</h1>

<form method="POST" action="{{ route('kondisi.update', $kondisi) }}"
      class="bg-white p-6 rounded shadow max-w-xl">
    @csrf @method('PUT')

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nama Kondisi</label>
        <input type="text" name="nama" value="{{ old('nama', $kondisi->nama) }}"
               class="border rounded p-2 w-full" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Keterangan</label>
        <input type="text" name="keterangan" value="{{ old('keterangan', $kondisi->keterangan) }}"
               class="border rounded p-2 w-full">
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
            Perbarui
        </button>
        <a href="{{ route('kondisi.index') }}" class="px-4 py-2 rounded border">Batal</a>
    </div>
</form>
@endsection