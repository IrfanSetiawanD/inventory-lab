@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Log Aktivitas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Nama User</th>
                    <th>Aksi</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $log->causer ? $log->causer->name : 'Sistem' }}</td>
                        <td>{{ $log->description }}</td>
                        <td>
                            @if ($log->subject)
                                {{ class_basename($log->subject_type) }} ID: {{ $log->subject_id }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada aktivitas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div>
            {{ $logs->links() }}
        </div>
    </div>
@endsection
