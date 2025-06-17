@forelse ($stocks as $index => $stock)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $stock->item_name ?? 'N/A' }}</td>
        <td>
            @php
                $itemTypeFromDb = $stock->itemable_type ?? '';
                $itemTypeClean = trim(preg_replace('/[[:cntrl:]]/', '', $itemTypeFromDb));
            @endphp
            @if ($itemTypeClean === 'App\Models\AlatLab')
                Alat Lab
            @elseif ($itemTypeClean === 'App\Models\BahanKimia')
                Bahan Kimia
            @else
                N/A (
                @if ($itemTypeClean === '')
                    EMPTY STRING
                @else
                    {{ $itemTypeClean }} | HEX: {{ bin2hex($itemTypeClean) }}
                @endif
                )
            @endif
        </td>
        <td>{{ $stock->quantity }}</td>
        <td>{{ $stock->date }}</td>
        <td>
            <form action="{{ route('stock-in.destroy', $stock->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus stok masuk ini? Aksi ini juga akan mengurangi kuantitas item di inventaris utama.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center text-muted">Belum ada data stok masuk.</td>
    </tr>
@endforelse