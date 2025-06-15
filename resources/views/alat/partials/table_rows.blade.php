@forelse ($alats as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->category->name ?? '-' }}</td>
        <td>{{ $item->quantity ?? '0' }}</td>
        <td>{{ $item->unit ?? '-' }}</td>
        <td>{{ $item->description ?? '-' }}</td>
        <td>
            @if ($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="gambar" width="80">
            @else
                <span class="text-muted">Tidak Ada</span>
            @endif
        </td>
        <td>
            <a href="{{ route('alat.edit', $item->id) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i>
            </a>

            <form action="{{ route('alat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
        <td colspan="8" class="text-center text-muted">Belum ada data alat laboratorium.</td>
    </tr>
@endforelse