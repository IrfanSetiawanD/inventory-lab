@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Bahan Kimia</h3>
    </div>
@endsection

@section('content')
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

    <!-- Tabel & Loader -->
    <div class="table-responsive" style="position: relative;">
        <table class="table table-bordered table-striped align-middle mb-0">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Tingkat Bahaya</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="bahanKimiaTableBody">
                @include('bahan.partials.table_rows', ['bahans' => $bahans])
            </tbody>
        </table>

        <!-- Loading overlay di atas tbody -->
            <div id="loading" style="display: none;">
                <div class="text-center">
                    <img src="{{ asset('images/loading.gif') }}" alt="Loading..." width="50">
                    <p style="color: black;">Memuat Data...</p>
                </div>
            </div>

        <!-- Pagination -->
        <div id="pagination" class="mt-3">
            @include('bahan.partials.pagination', ['bahans' => $bahans])
        </div>
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
                        $('#loading').show();

                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                query: query,
                                category_id: categoryId
                            },
                            success: function (response) {
                                $('#bahanKimiaTableBody')
                                    .hide()
                                    .html(response.html)
                                    .fadeIn(300);
                                $('#pagination').html(response.pagination);
                                $('#loading').hide();
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

            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                if (url) fetchData(url);
            });
        });
    </script>

    <style>
        .table-bordered td,
        .table-bordered th {
            border: 1px solid #547792 !important;
        }

        thead.table-dark th {
            background-color: #1e3a8a !important;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9fafb;
        }

        .table tbody tr:hover {
            background-color: #e0f7ff;
            transition: background-color 0.2s ease-in-out;
        }

        td {
            vertical-align: middle !important;
            text-align: center;
            font-size: 14px;
        }

        .btn-sm {
            padding: 6px 10px;
            border-radius: 6px;
        }

        td img {
            max-width: 70px;
            border-radius: 6px;
        }

        .table {
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        #bahanKimiaTableBody tr {
            transition: all 0.3s ease-in-out;
        }

        #bahanKimiaTableBody.blur {
            filter: blur(3px);
        }
    </style>
@endsection
