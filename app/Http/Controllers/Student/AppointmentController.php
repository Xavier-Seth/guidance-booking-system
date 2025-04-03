<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // ✅ Student: View their appointments
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $appointments = Appointment::where('user_id', $user->id)->latest()->get();
        } else {
            // ✅ Counselor: See all appointments
            $appointments = Appointment::latest()->get();
        }

        return view('appointments.index', compact('appointments'));
    }

    // ✅ Student: Show form to create an appointment
    public function create()
    {
        return view('appointments.create');
    }

    // ✅ Student: Store a new appointment
    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'reason' => 'required|string|max:255',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.status')
            ->with('success', 'Appointment requested successfully.');
    }

    // ✅ Counselor: Update appointment status (approve/decline)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,declined',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment status updated.');
    }
}

