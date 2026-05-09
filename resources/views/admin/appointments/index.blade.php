@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-weight: 700;">Appointment Management</h1>
        <p style="opacity: 0.7;">Approve, reschedule, or cancel client bookings.</p>
    </div>

    <div class="glass-card">
        @if($appointments->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $appointment->user->name }}</div>
                                <div style="font-size: 0.8rem; opacity: 0.6;">{{ $appointment->user->email }}</div>
                            </td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</div>
                                <div style="font-size: 0.8rem; opacity: 0.7;">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</div>
                            </td>
                            <td>
                                <span class="badge badge-{{ $appointment->status }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    @if($appointment->status === 'pending')
                                        <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-primary" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;">Approve</button>
                                        </form>
                                    @endif

                                    @if($appointment->status === 'approved')
                                        <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn" style="background: #dcfce7; color: #166534; font-size: 0.8rem; padding: 0.4rem 0.8rem; border: 1px solid #86efac;">Mark Completed</button>
                                        </form>
                                    @endif

                                    @if($appointment->status !== 'cancelled' && $appointment->status !== 'completed')
                                        <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn" style="background: #fee2e2; color: #991b1b; font-size: 0.8rem; padding: 0.4rem 0.8rem; border: 1px solid #fca5a5;">Cancel</button>
                                        </form>
                                    @else
                                        <span style="opacity: 0.4; font-size: 0.8rem;">No actions</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; opacity: 0.5; padding: 2rem;">No appointments found.</p>
        @endif
    </div>
</div>
@endsection
