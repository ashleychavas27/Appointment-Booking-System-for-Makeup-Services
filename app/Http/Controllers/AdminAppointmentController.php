<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['user', 'service'])->latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:approved,cancelled,completed',
        ]);

        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Status updated to ' . $request->status);
    }

    public function reschedule(Request $request, Appointment $appointment)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'approved', // Auto approve on reschedule by admin
        ]);

        return back()->with('success', 'Appointment rescheduled.');
    }

    public function calendar()
    {
        $appointments = Appointment::whereIn('status', ['approved', 'pending'])
            ->with(['user', 'service'])
            ->get();
        
        return view('admin.appointments.calendar', compact('appointments'));
    }

    public function reports()
    {
        $totalRevenue = Appointment::where('status', 'completed')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->sum('services.price');

        $report = [
            'total_completed' => Appointment::where('status', 'completed')->count(),
            'total_revenue' => $totalRevenue,
            'this_week' => Appointment::whereBetween('appointment_date', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'by_service' => \App\Models\Service::withCount('appointments')->get(),
        ];

        return view('admin.reports', compact('report'));
    }
}
