@forelse ($results as $item)
    {{-- $alat adalah koleksi, $item adalah setiap elemen di dalam koleksi --}}
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td> {{-- DIGANTI DARI $alat->name MENJADI $item->name --}}
        <td>{{ $item->category->name ?? '-' }}</td> {{-- DIGANTI DARI $alat->category->name MENJADI $item->category->name --}}
        <td>{{ $item->quantity }}</td> {{-- Menampilkan jumlah --}}
        <td>{{ $item->unit }}</td> {{-- Menampilkan satuan --}}
        <td>{{ Str::limit($item->description ?? '-', 50, '...') }}</td> {{-- DIGANTI DARI $alat->description MENJADI $item->description --}}
        <td>
            @if ($item->image)
                {{-- DIGANTI DARI $alat->image MENJADI $item->image --}}
                <img src="{{ asset('storage/' . $item->image) }}" alt="gambar" width="80">
            @else
                <span class="text-muted">-</span>
            @endif
        </td>
        <td>
            <a href="{{ route('alat.edit', $item->id) }}" class="btn btn-warning btn-sm">
                {{-- DIGANTI DARI $alat->id MENJADI $item->id --}}
                <i class="bi bi-pencil-square"></i>
            </a>

            <form action="{{ route('alat.destroy', $item->id) }}" method="POST" class="d-inline"
                {{-- DIGANTI DARI $alat->id MENJADI $item->id --}} onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center text-muted">Belum ada data alat laboratorium.</td>
        {{-- Perbarui colspan --}}
    </tr>
@endforelse