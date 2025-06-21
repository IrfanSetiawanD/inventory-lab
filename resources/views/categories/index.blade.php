@extends('layouts.app')

@section('page_header')
    <div class="page-header-container">
        <h3 class="page-title">Daftar Kategori</h3>
    </div>
@endsection

@section('content')
    <div class="container mt-4">

        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
        </a>

        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Section: Kategori Alat Lab --}}
        <div class="card dashboard-card mb-5">
            <div class="card-header">
                <h4 class="card-title mb-0">Kategori Alat Lab</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($alatCategories->isEmpty())
                        <div class="alert alert-info text-center" role="alert">
                            Belum ada kategori Alat Lab yang ditambahkan.
                        </div>
                    @else
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Tingkat Bahaya</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alatCategories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->type }}</td>
                                        <td>{{ $category->hazard_level ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                class="d-inline ms-2"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}? Data alat/bahan yang terkait dengan kategori ini mungkin juga terpengaruh jika ada batasan foreign key.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $alatCategories->links() }} {{-- Pagination untuk Alat Lab --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Section: Kategori Bahan Kimia --}}
        <div class="card dashboard-card mb-5">
            <div class="card-header">
                <h4 class="card-title mb-0">Kategori Bahan Kimia</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($bahanKimiaCategories->isEmpty())
                        <div class="alert alert-info text-center" role="alert">
                            Belum ada kategori Bahan Kimia yang ditambahkan.
                        </div>
                    @else
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Tingkat Bahaya</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bahanKimiaCategories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->type }}</td>
                                        <td>{{ $category->hazard_level ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                class="d-inline ms-2"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}? Data alat/bahan yang terkait dengan kategori ini mungkin juga terpengaruh jika ada batasan foreign key.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $bahanKimiaCategories->links() }} {{-- Pagination untuk Bahan Kimia --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
