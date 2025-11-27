@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@push('styles')
    @vite(['resources/css/dashboard.css'])
@endpush

<div class="dashboard-container">

    {{-- HEADER --}}
    <div class="welcome-section">
        <h2>👋 Halo, {{ Auth::user()->name }}</h2>
        <p>Sistem Informasi Manajemen Aset — Dashboard Overview</p>
    </div>

    {{-- STAT CARDS --}}
    <div class="stats-grid">

        <div class="stat-card purple">
            <div class="stat-icon">
                <i class="fas fa-map"></i>
            </div>
            <div class="stat-info">
                <p>Total Tanah</p>
                <h2>{{ $totalTanah ?? 0 }}</h2>
            </div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-info">
                <p>Total Bangunan</p>
                <h2>{{ $totalBangunan ?? 0 }}</h2>
            </div>
        </div>

        <div class="stat-card yellow">
            <div class="stat-icon">
                <i class="fas fa-door-open"></i>
            </div>
            <div class="stat-info">
                <p>Total Ruangan</p>
                <h2>{{ $totalRuangan ?? 0 }}</h2>
            </div>
        </div>

        <div class="stat-card red">
            <div class="stat-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-info">
                <p>Total Barang</p>
                <h2>{{ $totalBarang ?? 0 }}</h2>
            </div>
        </div>

    </div>

    {{-- RECENT ACTIVITIES --}}
    <div class="activity-card">
        <div class="activity-header">
            <h3>📝 Aktivitas Terbaru</h3>
        </div>

        @if(isset($recentActivities) && count($recentActivities))
            <div class="activity-table-wrapper">
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Aktivitas</th>
                            <th>User</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($recentActivities as $activity)
                            <tr>
                                <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>
                                    {{ $activity->user->name }}
                                    <span class="role-badge">
                                        {{ $activity->user->role ?? 'Tidak ada role' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($activity->status) }}">
                                        {{ $activity->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="no-activity">Tidak ada aktivitas terbaru</p>
        @endif
    </div>

</div>

@endsection
