<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class CalendarController extends Controller
{
    public function fetchAppointments()
    {
        $appointments = Appointment::with('user')
            ->where('status', 'approved') // lowercase 'approved' based on your DB
            ->get();

        $events = $appointments->map(function ($appt) {
            return [
                'id' => $appt->id,
                'title' => $appt->user->name . ' - ' . $appt->reason, // fixed from student → user
                'start' => $appt->appointment_date . 'T' . $appt->appointment_time, // ISO format
                'backgroundColor' => '#0d6efd',
                'borderColor' => '#0d6efd',
            ];
        });

        return response()->json($events);
    }
}
