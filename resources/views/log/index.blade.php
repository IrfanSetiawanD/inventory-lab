@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Log Aktivitas</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Aktivitas</th>
                <th>Model</th>
                <th>ID</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->causer?->name ?? 'Sistem' }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->subject_type }}</td>
                <td>{{ $log->subject_id }}</td>
                <td>{{ $log->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
</div>
@endsection
