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
                                            <button type="submit" class="btn" style="background: rgba(0, 184, 148, 0.2); color: #00b894; font-size: 0.8rem; padding: 0.4rem 0.8rem;">Approve</button>
                                        </form>
                                    @endif

                                    @if($appointment->status !== 'cancelled' && $appointment->status !== 'completed')
                                        <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn" style="background: rgba(255, 118, 117, 0.2); color: #ff7675; font-size: 0.8rem; padding: 0.4rem 0.8rem;">Cancel</button>
                                        </form>

                                        <!-- Simple Reschedule trigger (could be a modal in a real app, here we just show a small form) -->
                                        <button onclick="document.getElementById('reschedule-{{ $appointment->id }}').style.display='block'" class="btn" style="background: rgba(255,255,255,0.1); font-size: 0.8rem; padding: 0.4rem 0.8rem;">Reschedule</button>
                                    @endif
                                </div>

                                <!-- Hidden Reschedule Form -->
                                <div id="reschedule-{{ $appointment->id }}" style="display:none; margin-top: 1rem; padding: 1rem; border: 1px solid var(--glass-border); border-radius: 12px; background: rgba(255,255,255,0.05);">
                                    <form action="{{ route('admin.appointments.reschedule', $appointment) }}" method="POST">
                                        @csrf
                                        <div style="display: flex; gap: 0.5rem; align-items: flex-end;">
                                            <div>
                                                <label style="font-size: 0.7rem;">New Date</label>
                                                <input type="date" name="appointment_date" style="padding: 0.4rem;" required>
                                            </div>
                                            <div>
                                                <label style="font-size: 0.7rem;">New Time</label>
                                                <input type="time" name="appointment_time" style="padding: 0.4rem;" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Save</button>
                                            <button type="button" onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="btn" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">X</button>
                                        </div>
                                    </form>
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
