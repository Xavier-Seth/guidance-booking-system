<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl fw-bold text-dark">
            My Appointments
        </h2>
    </x-slot>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Reason</th>
                                <th>Status</th>
                                @if (auth()->user()->role === 'counselor')
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment_date }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
                                    <td>{{ $appointment->reason }}</td>
                                    <td>
                                        <span class="badge 
                                            @if ($appointment->status === 'pending') bg-warning text-dark
                                            @elseif ($appointment->status === 'approved') bg-success
                                            @elseif ($appointment->status === 'declined') bg-danger
                                            @else bg-secondary @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>

                                    @if (auth()->user()->role === 'counselor')
                                        <td>
                                            @if ($appointment->status === 'pending')
                                                <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>

                                                <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="declined">
                                                    <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                                </form>
                                            @else
                                                <em class="text-muted">No actions available</em>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->role === 'counselor' ? 5 : 4 }}" class="text-muted">No appointments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
