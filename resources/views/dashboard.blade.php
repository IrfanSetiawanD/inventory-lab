@extends('layouts.app')

@section('content')
    <h3>Dashboard</h3>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>Total Alat Lab</h5>
                    <h2>{{ $alatLabCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5>Total Bahan Kimia</h5>
                    <h2>{{ $bahanKimiaCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Total Kategori</h5>
                    <h2>{{ $categories }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5>Total Stock Keluar</h5>
                    <h2>{{ $stockOutCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5>Stock Keluar ({{ now()->format('F') }})</h5>
                    <h2>{{ $stockOutMonth }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
