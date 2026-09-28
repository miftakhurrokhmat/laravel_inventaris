@props(['nama'])

<span {{ $attributes->class([
    'px-2 py-1 rounded text-xs font-semibold',
    'bg-green-100 text-green-700'   => $nama === 'Baik',
    'bg-yellow-100 text-yellow-700' => $nama === 'Rusak Ringan',
    'bg-red-100 text-red-700'       => $nama === 'Rusak Berat',
]) }}>{{ $nama }}</span>