<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'total_services' => Service::count(),
            'recent_appointments' => Appointment::with(['user', 'service'])->latest()->take(5)->get(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function client()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->with('service')
            ->latest()
            ->get();
        return view('client.dashboard', compact('appointments'));
    }

    public function bookingPage()
    {
        $services = Service::all();
        return view('client.book', compact('services'));
    }

    public function bookService(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        // Check if slot already taken
        $exists = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked. Please choose another.'])->withInput();
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Booking successful! Wait for admin to approve.');
    }

    public function cancelBooking(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        if ($appointment->status === 'pending') {
            $appointment->update(['status' => 'cancelled']);
            return back()->with('success', 'Booking cancelled.');
        }

        return back()->withErrors(['status' => 'You can only cancel pending bookings.']);
    }
}
