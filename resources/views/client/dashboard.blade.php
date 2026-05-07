@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-weight: 700;">My Appointments</h1>
            <p style="opacity: 0.7;">View and manage your makeup sessions.</p>
        </div>
        <a href="#" class="btn btn-primary" style="opacity: 0.5; cursor: not-allowed;">Book New Service (Phase 2)</a>
    </div>

    <div class="glass-card">
        @if($appointments->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td style="font-weight: 600;">{{ $appointment->service->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                            <td>
                                <span class="badge badge-{{ $appointment->status }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>₱{{ number_format($appointment->service->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 4rem 2rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">✨</div>
                <h3>No appointments yet</h3>
                <p style="opacity: 0.6; margin-top: 0.5rem;">Your glow-up journey starts here. Booking feature coming in Phase 2!</p>
            </div>
        @endif
    </div>
</div>
@endsection
