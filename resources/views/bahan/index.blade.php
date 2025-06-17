@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Bahan Kimia</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('bahan.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Bahan
        </a>

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Bahan...">
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

        <div class="table-responsive"> {{-- Menambahkan div untuk responsivitas tabel --}}
            <table class="table table-bordered table-striped align-middle"> {{-- Menambahkan align-middle untuk konten sel --}}
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Jumlah</th> {{-- MENAMBAHKAN KOLOM JUMLAH --}}
                        <th>Satuan</th> {{-- MENAMBAHKAN KOLOM SATUAN --}}
                        <th>Tingkat Bahaya</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="bahanKimiaTableBody">
                    @include('bahan.partials.table_rows', ['bahans' => $bahans])
                </tbody>

                <div id="pagination" class="mt-3">
                    @include('bahan.partials.pagination', ['bahans' => $bahans])
                </div>
        </div> {{-- Penutup div table-responsive --}}
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let timer;

        $(document).ready(function () {
            function fetchData(url = "{{ route('bahankimia.search') }}") {
                const query = $('#searchInput').val();
                const categoryId = $('#categoryFilter').val();

                clearTimeout(timer);

                if (query.length >= 4 || query.length === 0) {
                    timer = setTimeout(function () {
                        // $('#bahanKimiaTableBody').hide();
                        $('#loading').show();

                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                query: query,
                                category_id: categoryId
                            },
                            success: function (response) {
                                $('#bahanKimiaTableBody').html(response.html);
                                $('#pagination').html(response.pagination);
                                $('#loading').hide();
                                // $('#bahanKimiaTableBody').show();
                            },
                            error: function () {
                                $('#loading').hide();
                                alert('Gagal memuat data.');
                            }
                        });
                    }, 300);
                } else {
                    $('#bahanKimiaTableBody').html('<tr><td colspan="9">Ketik minimal 4 huruf...</td></tr>');
                    $('#pagination').empty();
                }
            }

            $('#searchInput').on('keyup', function () {
                fetchData();
            });

            $('#categoryFilter').on('change', function () {
                fetchData();
            });

            // Delegasi klik pagination agar tetap bisa bekerja setelah replace HTML
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url) {
                    fetchData(url);
                }
            });
        });
    </script>
    <style>
        #loading {
            position: absolute;
            top: 42px; /* Tinggi thead */
            left: 0;
            right: 0;
            bottom: 60px; /* ruang untuk pagination */
            background: rgba(255, 255, 255, 0.6);
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
        }

        #bahanKimiaTableBody.blur {
            filter: blur(3px);
        }
    </style>
@endsection
