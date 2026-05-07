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
}
