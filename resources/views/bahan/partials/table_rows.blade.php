@forelse ($bahans as $itemBahan)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $itemBahan->name }}</td>
        <td>{{ $itemBahan->category->name ?? '-' }}</td>
        <td>{{ $itemBahan->quantity ?? '0' }}</td>
        <td>{{ $itemBahan->unit ?? '-' }}</td>
        <td>{{ $itemBahan->danger_level ?? '-' }}</td> {{-- Kolom Tingkat Bahaya JANGAN HILANG --}}
        <td>{{ $itemBahan->description ?? '-' }}</td>
        <td>
            @if ($itemBahan->image)
                <img src="{{ asset('storage/' . $itemBahan->image) }}" alt="Gambar" width="80">
            @else
                <span class="text-muted">Tidak ada</span>
            @endif
        </td>
        <td>
            <a href="{{ route('bahan.edit', $itemBahan->id) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('bahan.destroy', $itemBahan->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Yakin ingin menghapus bahan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9" class="text-center text-muted">Belum ada data bahan kimia.</td>
    </tr>
@endforelse
