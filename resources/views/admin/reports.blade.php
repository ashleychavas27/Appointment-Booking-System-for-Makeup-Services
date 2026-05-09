@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-weight: 700;">Business Reports</h1>
        <p style="opacity: 0.7;">Summary of your makeup service performance.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="glass-card">
            <p style="opacity: 0.7; font-size: 0.9rem;">Total Revenue (Completed)</p>
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #00b894;">₱{{ number_format($report['total_revenue'], 2) }}</h2>
        </div>
        <div class="glass-card">
            <p style="opacity: 0.7; font-size: 0.9rem;">Completed Bookings</p>
            <h2 style="font-size: 2.5rem; font-weight: 700; color: var(--primary);">{{ $report['total_completed'] }}</h2>
        </div>
        <div class="glass-card">
            <p style="opacity: 0.7; font-size: 0.9rem;">Bookings This Week</p>
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #fab1a0;">{{ $report['this_week'] }}</h2>
        </div>
    </div>

    <div class="glass-card">
        <h3 style="margin-bottom: 1.5rem; font-weight: 600;">Popularity by Service</h3>
        <table>
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Times Booked</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['by_service'] as $service)
                    <tr>
                        <td style="font-weight: 600;">{{ $service->name }}</td>
                        <td>₱{{ number_format($service->price, 2) }}</td>
                        <td>{{ $service->appointments_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 2rem; text-align: center;">
        <button onclick="window.print()" class="btn btn-primary">Print Report</button>
    </div>
</div>
@endsection
