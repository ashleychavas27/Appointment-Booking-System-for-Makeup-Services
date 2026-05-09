@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
        <div>
            <h1 style="font-weight: 700;">My Appointments</h1>
            <p style="opacity: 0.7;">View and manage your makeup sessions.</p>
        </div>
        <a href="{{ route('client.book') }}" class="btn btn-primary" style="padding: 0.8rem 1.5rem;">+ Book New Service</a>
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
                        <th>Actions</th>
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
                            <td>
                                @if($appointment->status === 'pending')
                                    <form action="{{ route('client.appointment.cancel', $appointment) }}" method="POST" onsubmit="return confirm('Cancel this appointment?')">
                                        @csrf
                                        <button type="submit" class="btn" style="background: rgba(255, 118, 117, 0.1); color: #ff7675; font-size: 0.8rem; padding: 0.4rem 0.8rem; border: 1px solid rgba(255, 118, 117, 0.2);">Cancel</button>
                                    </form>
                                @else
                                    <span style="opacity: 0.4; font-size: 0.8rem;">No actions</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 3rem;">
                <p style="opacity: 0.5; margin-bottom: 1.5rem;">You haven't booked any services yet.</p>
                <a href="{{ route('client.book') }}" class="btn btn-primary">Book Your First Session</a>
            </div>
        @endif
    </div>
</div>
@endsection
