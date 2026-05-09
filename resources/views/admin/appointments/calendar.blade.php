@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-weight: 700;">Weekly Schedule</h1>
        <p style="opacity: 0.7;">Visual timeline of all upcoming makeup sessions.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        @php
            $dates = $appointments->groupBy('appointment_date')->sortKeys();
        @endphp

        @if($dates->count() > 0)
            @foreach($dates as $date => $dayAppointments)
                <div class="glass-card">
                    <h3 style="color: var(--primary); border-bottom: 1px solid var(--border); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                        {{ \Carbon\Carbon::parse($date)->format('l, M d') }}
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($dayAppointments->sortBy('appointment_time') as $appointment)
                            <div style="display: flex; gap: 1rem; align-items: flex-start; padding: 0.8rem; border-radius: 12px; background: var(--bg); border-left: 4px solid {{ $appointment->status === 'approved' ? '#166534' : '#92400e' }};">
                                <div style="font-weight: 700; min-width: 80px;">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </div>
                                <div>
                                    <div style="font-weight: 600;">{{ $appointment->user->name }}</div>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">{{ $appointment->service->name }}</div>
                                    <div style="margin-top: 0.3rem;">
                                        <span class="badge badge-{{ $appointment->status }}" style="font-size: 0.65rem;">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="glass-card" style="grid-column: 1 / -1; text-align: center; padding: 4rem;">
                <h3>The calendar is empty</h3>
                <p style="opacity: 0.5;">No upcoming appointments scheduled.</p>
            </div>
        @endif
    </div>
</div>
@endsection
