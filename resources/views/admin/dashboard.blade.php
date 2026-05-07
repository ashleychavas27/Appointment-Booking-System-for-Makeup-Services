@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-weight: 700;">Admin Dashboard</h1>
        <p style="opacity: 0.7;">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="glass-card" style="padding: 1.5rem;">
            <p style="opacity: 0.7; font-size: 0.9rem;">Total Appointments</p>
            <h2 style="font-size: 2.5rem; font-weight: 700; color: var(--primary);">{{ $stats['total_appointments'] }}</h2>
        </div>
        <div class="glass-card" style="padding: 1.5rem;">
            <p style="opacity: 0.7; font-size: 0.9rem;">Pending Requests</p>
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #fdcb6e;">{{ $stats['pending_appointments'] }}</h2>
        </div>
        <div class="glass-card" style="padding: 1.5rem;">
            <p style="opacity: 0.7; font-size: 0.9rem;">Active Services</p>
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #00b894;">{{ $stats['total_services'] }}</h2>
        </div>
    </div>

    <div class="glass-card">
        <h3 style="margin-bottom: 1.5rem; font-weight: 600;">Recent Appointments</h3>
        @if($stats['recent_appointments']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_appointments'] as $appointment)
                        <tr>
                            <td>{{ $appointment->user->name }}</td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                            <td>
                                <span class="badge badge-{{ $appointment->status }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; opacity: 0.5; padding: 2rem;">No appointments found yet.</p>
        @endif
    </div>
</div>
@endsection
