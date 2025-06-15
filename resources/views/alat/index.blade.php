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
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        
            <div id="table-container" style="position: relative;">
                <table class="table table-bordered table-striped align-middle">
                    <tbody id="alatLabTableBody">
                        @include('alat.partials.table_rows', ['alats' => $alats])
                    </tbody>
                </table>
        
                <!-- Loading di dalam container -->
                <div id="loading" style="display: none;">
                    <div class="text-center">
                        <img src="{{ asset('images/loading.gif') }}" alt="Loading..." width="50">
                        <p style="color: black;">Memuat data...</p>
                    </div>
                </div>
            </div>
        
            <div id="pagination" class="mt-3">
                @include('alat.partials.pagination')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let timer;

        $(document).ready(function () {
            function fetchData(url = "{{ route('alatlab.search') }}") {
                const query = $('#searchInput').val();
                const categoryId = $('#categoryFilter').val();

                clearTimeout(timer);

                if (query.length >= 4 || query.length === 0) {
                    timer = setTimeout(function () {
                        // $('#alatLabTableBody').hide();
                        $('#loading').show();

                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                query: query,
                                category_id: categoryId
                            },
                            success: function (response) {
                                $('#alatLabTableBody').html(response.html);
                                $('#pagination').html(response.pagination);
                                $('#loading').hide();
                                // $('#alatLabTableBody').show();
                            },
                            error: function () {
                                $('#loading').hide();
                                alert('Gagal memuat data.');
                            }
                        });
                    }, 300);
                } else {
                    $('#alatLabTableBody').html('<tr><td colspan="8">Ketik minimal 4 huruf...</td></tr>');
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
        #table-container {
            position: relative;
        }

        #loading {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            pointer-events: none;
        }

        /* Blur effect saat loading */
        #table-container.loading tbody {
            filter: blur(3px);
            pointer-events: none;
        }
    </style>
@endsection
