@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <!-- Formal Header for Print -->
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-weight: 800; color: var(--primary); margin-bottom: 0.5rem;">GLOWBOOK MAKEUP SERVICES</h1>
        <h3 style="text-transform: uppercase; letter-spacing: 2px; opacity: 0.7;">Business Revenue Report</h3>
        <p style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.6;">Generated on {{ now()->format('F d, Y - h:i A') }}</p>
        <hr style="margin-top: 1.5rem; border: none; border-top: 2px solid var(--primary); width: 100px; margin-inline: auto;">
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="glass-card">
            <p style="color: var(--text-light); font-size: 0.9rem; font-weight: 600;">Total Revenue</p>
            <h2 style="font-size: 2.5rem; font-weight: 800; color: #166534;">₱{{ number_format($report['total_revenue'], 2) }}</h2>
        </div>
        <div class="glass-card">
            <p style="color: var(--text-light); font-size: 0.9rem; font-weight: 600;">Completed Bookings</p>
            <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary);">{{ $report['total_completed'] }}</h2>
        </div>
        <div class="glass-card">
            <p style="color: var(--text-light); font-size: 0.9rem; font-weight: 600;">This Week</p>
            <h2 style="font-size: 2.5rem; font-weight: 800; color: #92400e;">{{ $report['this_week'] }}</h2>
        </div>
    </div>

    <div class="glass-card">
        <h3 style="margin-bottom: 1.5rem; font-weight: 700;">Service Performance Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Rate/Price</th>
                    <th>Total Bookings</th>
                    <th>Generated Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['by_service'] as $service)
                    <tr>
                        <td style="font-weight: 600;">{{ $service->name }}</td>
                        <td>₱{{ number_format($service->price, 2) }}</td>
                        <td>{{ $service->appointments_count }}</td>
                        <td style="font-weight: 700;">₱{{ number_format($service->price * $service->appointments_count, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Formal Signature Block for Print -->
    <div style="margin-top: 5rem; display: none;" class="print-only">
        <div style="display: flex; justify-content: space-between;">
            <div style="text-align: center; width: 200px;">
                <hr style="border: none; border-top: 1px solid #000;">
                <p style="font-size: 0.8rem;">Prepared By</p>
            </div>
            <div style="text-align: center; width: 200px;">
                <hr style="border: none; border-top: 1px solid #000;">
                <p style="font-size: 0.8rem;">Approved By</p>
            </div>
        </div>
    </div>

    <div style="margin-top: 3rem; text-align: center;">
        <button onclick="window.print()" class="btn btn-primary" style="padding: 1rem 2.5rem;">
            🖨️ Print Professional Report
        </button>
    </div>
</div>

<style>
    @media print {
        .print-only {
            display: block !important;
        }
    }
</style>
@endsection
