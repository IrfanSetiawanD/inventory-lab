@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Stok Keluar</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('stock-out.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Stock
        </a>

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchInputStockOut" class="form-control" placeholder="Cari nama alat/bahan...">
            </div>
            <div class="col-md-4">
                <select id="typeFilterStockOut" class="form-control">
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
                        <th class="cursor-pointer text-left">
                            <div class="flex items-center justify-between w-full sortable" data-sort="item_name">
                                <span>Nama Item</span>
                                <span class="sort-icon" data-icon-for="item_name">⇅</span>
                            </div>
                        </th>
                        <th class="cursor-pointer text-left">
                            <div class="flex items-center justify-between w-full sortable" data-sort="itemable_id">
                                <span>Jenis</span>
                                <span class="sort-icon" data-icon-for="itemable_id">⇅</span>
                            </div>
                        </th>
                        <th class="cursor-pointer text-left">
                            <div class="flex items-center justify-between w-full sortable" data-sort="quantity">
                                <span>Jumlah</span>
                                <span class="sort-icon" data-icon-for="quantity">⇅</span>
                            </div>
                        </th>
                        <th class="cursor-pointer text-left">
                            <div class="flex items-center justify-between w-full sortable" data-sort="date">
                                <span>Tanggal</span>
                                <span class="sort-icon" data-icon-for="date">⇅</span>
                            </div>
                        </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="stockOutTableBody" style="position: relative;">
                    @include('stock_out.partials.table_rows', ['stocks' => $stocks])
                </tbody>
            </table>

            <div id="loadingStockOut" style="display: none;">
                <div class="text-center">
                    <img src="{{ asset('images/loading.gif') }}" alt="Loading..." width="50">
                    <p style="color: black;">Memuat data...</p>
                </div>
            </div>

            <div id="paginationStockOut" class="mt-3">
                @include('stock_out.partials.pagination')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let sort = 'date'; // default sort
        let direction = 'desc'; // default direction
        let timer;

        function updateSortIcons() {
            $('.sort-icon').html('⇅'); // reset semua

            const activeIcon = $(`.sort-icon[data-icon-for="${sort}"]`);
            activeIcon.html(direction === 'asc' ? '▲' : '▼');
        }

        $(document).ready(function() {
            function fetchData(url = "{{ route('stock_out.search') }}") {
                const query = $('#searchInputStockOut').val();
                let type = $('#typeFilterStockOut').val();

                clearTimeout(timer);

                if (query.length >= 2 || query.length === 0) {
                    timer = setTimeout(function() {
                        $('#loadingStockOut').show();

                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                query: query,
                                type: type,
                                sort: sort,
                                direction: direction
                            },
                            success: function(response) {
                                $('#stockOutTableBody').html(response.html);
                                $('#paginationStockOut').html(response.pagination);
                                $('#loadingStockOut').hide();
                                updateSortIcons();
                            },
                            error: function() {
                                $('#loadingStockOut').hide();
                                alert('Gagal memuat data.');
                            }
                        });
                    }, 300);
                } else {
                    $('#stockOutTableBody').html('<tr><td colspan="8">Ketik minimal 2 huruf...</td></tr>');
                    $('#paginationStockOut').empty();
                }
            }

            $('#searchInputStockOut').on('keyup', function() {
                fetchData();
            });

            $('#typeFilterStockOut').on('change', function() {
                fetchData();
            });

            // Delegasi klik pagination agar tetap bisa bekerja setelah replace HTML
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url) {
                    fetchData(url);
                }
            });

            $(document).on('click', '.sortable', function(e) {
                e.preventDefault();
                let clickedSort = $(this).data('sort');

                if (sort === clickedSort) {
                    // toggle direction
                    direction = (direction === 'asc') ? 'desc' : 'asc';
                } else {
                    sort = clickedSort;
                    direction = 'desc'; // default to asc on new sort
                }

                fetchData();
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

        /* Gaya khusus untuk loading overlay di stock-out-index */
        #loadingStockOut {
            position: absolute;
            top: 42px;
            /* Tinggi thead */
            left: 0;
            right: 0;
            bottom: 60px;
            /* ruang untuk pagination */
            background: rgba(255, 255, 255, 0.6);
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
        }

        #stockOutTableBody.blur {
            filter: blur(3px);
        }
    </style>
@endsection
