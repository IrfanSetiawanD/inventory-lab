@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Stok Masuk</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('stock-in.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Stock
        </a>

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchInputStockIn" class="form-control" placeholder="Cari nama alat/bahan...">
            </div>
            <div class="col-md-4">
                <select id="typeFilterStockIn" class="form-control">
                    <option value="">-- Semua Tipe --</option>
                    <option value="alat">Alat Lab</option>
                    <option value="bahan">Bahan Kimia</option>
                </select>
            </div>
        </div>

        <div class="table-responsive" style="position: relative;">
            <table class="table table-bordered table-striped align-middle" style="margin-bottom: 0;">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="stockInTableBody" style="position: relative;">
                    @include('stock_in.partials.table_rows', ['stocks' => $stocks])
                </tbody>
            </table>

            <div id="loadingStockIn" style="display: none;">
                <div class="text-center">
                    <img src="{{ asset('images/loading.gif') }}" alt="Loading..." width="50">
                    <p style="color: black;">Memuat data...</p>
                </div>
            </div>

            <div id="paginationStockIn" class="mt-3">
                @include('stock_in.partials.pagination')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let timer;

        $(document).ready(function () {
            function fetchData(url = "{{ route('stock_in.search') }}") {
                const query = $('#searchInputStockIn').val();
                let type = $('#typeFilterStockIn').val();

                clearTimeout(timer);

                if (query.length >= 2 || query.length === 0) {
                    timer = setTimeout(function () {
                        $('#loadingStockIn').show();

                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                query: query,
                                type: type
                            },
                            success: function (response) {
                                $('#stockInTableBody').html(response.html);
                                $('#paginationStockIn').html(response.pagination);
                                $('#loadingStockIn').hide();
                            },
                            error: function () {
                                $('#loadingStockIn').hide();
                                alert('Gagal memuat data.');
                            }
                        });
                    }, 300);
                } else {
                    $('#stockInTableBody').html('<tr><td colspan="8">Ketik minimal 2 huruf...</td></tr>');
                    $('#paginationStockIn').empty();
                }
            }

            $('#searchInputStockIn').on('keyup', function () {
                fetchData();
            });

            $('#typeFilterStockIn').on('change', function () {
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
        #loadingStockIn {
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

        #stockInTableBody.blur {
            filter: blur(3px);
        }
    </style>
@endsection
