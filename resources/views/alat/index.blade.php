@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Alat Laboratorium</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('alat.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Alat
        </a>

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama alat...">
            </div>
            <div class="col-md-4">
                <select id="categoryFilter" class="form-control">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive" style="position: relative;">
            <div id="loading" style="display: none; text-align: center;">
                <img src="{{ asset('images/loading.gif') }}" alt="Loading..." width="50">
                <p>Memuat data...</p>
            </div>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Jumlah</th> {{-- Tambahkan kolom jumlah --}}
                        <th>Satuan</th> {{-- Tambahkan kolom satuan --}}
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="alatLabTableBody">
                    @forelse ($alats as $item)
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
                </tbody>
            </table>
            <div class="mt-3">
                {{ $alats->links() }}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let timer;
        $(document).ready(function () {
            let delayTimer;
        
            function fetchData() {
                const query = $('#searchInput').val();
                const categoryId = $('#categoryFilter').val();
                
                clearTimeout(timer);
                if (query.length >= 4 || query.length === 0) {
                    timer = setTimeout(function () {
                    $('#alatLabTableBody').hide();
                    $('#loading').show();
                    $.ajax({
                        url: "{{ route('alatlab.search') }}",
                        method: 'GET',
                        data: {
                            query: query,
                            category_id: categoryId
                        },
                        success: function (response) {
                            $('#alatLabTableBody').html(response.html);
                            $('#loading').hide();
                            $('#alatLabTableBody').show();
                        },
                        error: function () {
                            $('#loading').hide(); // Sembunyikan loading meskipun gagal
                            alert('Gagal memuat data.');
                        }
                    });
                }, 300);
                } else {
                    $('#alatLabTableBody').show();
                    $('#alatLabTableBody').html('<tr><td colspan="8">Ketik minimal 4 huruf...</td></tr>');
                }
            }
        
            $('#searchInput').on('keyup', function () {
                clearTimeout(delayTimer);
                delayTimer = setTimeout(fetchData, 300);
            });
        
            $('#categoryFilter').on('change', fetchData);
        });
    </script>
    <style>
        #loading {
            position: absolute;
            top: 42px; /* Tinggi thead agar overlay muncul pas di atas tbody */
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            display: none;
        }
    </style>
@endsection
