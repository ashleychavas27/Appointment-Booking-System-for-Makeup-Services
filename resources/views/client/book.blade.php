@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-weight: 700;">Book an Appointment</h1>
        <p style="opacity: 0.7;">Select your service and preferred time slot.</p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;">
        <!-- Service Gallery -->
        <div class="glass-card">
            <h3 style="margin-bottom: 1.5rem;">Our Services</h3>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($services as $service)
                    <div style="padding: 1rem; border: 1px solid var(--border); border-radius: 12px; background: rgba(0,0,0,0.02);">
                        <h4 style="color: var(--primary);">{{ $service->name }}</h4>
                        <p style="font-size: 0.8rem; opacity: 0.6; margin: 0.3rem 0;">{{ $service->description }}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem;">
                            <span style="font-weight: 700;">₱{{ number_format($service->price, 2) }}</span>
                            <span style="font-size: 0.8rem; opacity: 0.7;">{{ $service->duration }} mins</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Booking Form -->
        <div class="glass-card">
            <form action="{{ route('client.book.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Select Service</label>
                    <select name="service_id" required>
                        <option value="">-- Choose a Service --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} (₱{{ number_format($service->price, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Preferred Date</label>
                        <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Preferred Time</label>
                        <input type="time" name="appointment_time" value="{{ old('appointment_time') }}" required>
                        @error('appointment_time')
                            <span style="color: #ff7675; font-size: 0.8rem;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Special Notes (Optional)</label>
                    <textarea name="notes" rows="3" placeholder="Any specific requirements or details?">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; margin-top: 1rem;">Confirm Booking</button>
            </form>
        </div>
    </div>
</div>
@endsection
