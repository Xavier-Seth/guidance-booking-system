<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl fw-bold text-dark">
            Request Appointment
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Appointment Date</label>
                                <input type="date" name="appointment_date" class="form-control" value="{{ old('appointment_date') }}">
                                @error('appointment_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Appointment Time</label>
                                <input type="time" name="appointment_time" class="form-control" value="{{ old('appointment_time') }}">
                                @error('appointment_time')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Reason</label>
                                <textarea name="reason" rows="3" class="form-control">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Submit Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
