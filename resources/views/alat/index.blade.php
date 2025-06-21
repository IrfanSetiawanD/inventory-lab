@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Alat Laboratorium</h3>
    </div>
@endsection

@section('content')
        @if (session('success'))
            <div id="alert-success" class="alert alert-success mt-3 alert-animate" role="alert">
                {{ session('success') }}
            </div>

            <style>
                .alert-animate {
                    transition: transform 0.4s ease, opacity 0.4s ease;
                }

                .alert-hidden {
                    opacity: 0;
                    transform: translateY(-20px);
                }
            </style>

            <script>
                const alertBox = document.getElementById('alert-success');

                setTimeout(() => {
                    alertBox.classList.add('alert-hidden');
                    setTimeout(() => alertBox.remove(), 500); // setelah transisi selesai
                }, 4000);
            </script>
        @endif

        <a href="{{ route('alat.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Alat
        </a>

        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama Alat...">
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
                <thead class="table-dark text-center align-middle">
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
                <tbody id="alatLabTableBody">
                    @include('alat.partials.table_rows', ['alats' => $alats])
                </tbody>
            </table>
        
            <!-- Loading overlay di atas tbody -->
            <div id="loading" style="display: none;">
                <div class="text-center">
                    <img src="{{ asset('images/loading.gif') }}" alt="Loading..." width="50">
                    <p style="color: black;">Memuat Data...</p>
                </div>
            </div>
        
            <div id="pagination" class="mt-3">
                @include('alat.partials.pagination')
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

                if (query.length >= 2 || query.length === 0) {
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
                                $('#alatLabTableBody')
                                    .hide()
                                    .html(response.html)
                                    .fadeIn(300);

                                $('#pagination').html(response.pagination);
                                $('#loading').hide();
                            },
                            error: function () {
                                $('#loading').hide();
                                alert('Gagal Memuat Data.');
                            }
                        });
                    }, 300);
                } else {
                    $('#alatLabTableBody').html('<tr><td colspan="8">Ketik Minimal 2 Huruf...</td></tr>');
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

        #alatLabTableBody tr {
            transition: all 0.3s ease-in-out;
        }

        #alatLabTableBody.blur {
            filter: blur(3px);
        }
    </style>
@endsection
