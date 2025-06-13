@extends('layouts.app')

@section('content')
    <div class="container mt-4"> {{-- Mengganti max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 --}}
        <h4 class="mb-4">Daftar Kategori</h4> {{-- Menggunakan h4 untuk konsistensi dengan AlatLab --}}

        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3"> {{-- Menggunakan btn btn-primary --}}
            <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
        </a>

        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert"> {{-- Menggunakan alert Bootstrap --}}
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive mt-4"> {{-- Menggunakan table-responsive --}}
            @if ($categories->isEmpty())
                <div class="alert alert-info text-center" role="alert"> {{-- Menggunakan alert Bootstrap --}}
                    Belum ada kategori yang ditambahkan. Silakan <a href="{{ route('categories.create') }}"
                        class="alert-link">buat kategori baru</a>.
                </div>
            @else
                <table class="table table-bordered table-hover align-middle"> {{-- Menggunakan kelas Bootstrap --}}
                    <thead class="table-dark"> {{-- Warna latar belakang untuk header --}}
                        <tr>
                            <th scope="col">No</th> {{-- Tambahkan kolom No --}}
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Tingkat Bahaya</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td> {{-- Menampilkan nomor urut --}}
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->type }}</td>
                                <td>{{ $category->hazard_level ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline ms-2" {{-- Tambah margin-start untuk tombol Hapus --}}
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
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
