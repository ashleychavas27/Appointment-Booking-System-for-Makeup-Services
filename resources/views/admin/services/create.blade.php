@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;" class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-weight: 700;">Add New Service</h1>
        <a href="{{ route('admin.services.index') }}" style="color: var(--primary); text-decoration: none; font-size: 0.9rem;">&larr; Back to List</a>
    </div>

    <div class="glass-card">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="name" placeholder="e.g. Bridal Makeup" required>
            </div>

            <div class="form-group">
                <label>Description (Optional)</label>
                <textarea name="description" rows="3" placeholder="Describe the service details..."></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>Price (₱)</label>
                    <input type="number" name="price" step="0.01" placeholder="0.00" required>
                </div>
                <div class="form-group">
                    <label>Duration (Minutes)</label>
                    <input type="number" name="duration" placeholder="60" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem; padding: 1rem;">Save Service</button>
        </form>
    </div>
</div>
@endsection
