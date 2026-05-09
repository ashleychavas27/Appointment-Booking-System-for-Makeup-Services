@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;" class="animate-fade">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-weight: 700;">Edit Service</h1>
        <a href="{{ route('admin.services.index') }}" style="color: var(--primary); text-decoration: none; font-size: 0.9rem;">&larr; Back to List</a>
    </div>

    <div class="glass-card">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="name" value="{{ $service->name }}" required>
            </div>

            <div class="form-group">
                <label>Description (Optional)</label>
                <textarea name="description" rows="3">{{ $service->description }}</textarea>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.75rem;">
                <input type="checkbox" name="active" id="active" {{ $service->active ? 'checked' : '' }}>
                <label for="active">Active for clients</label>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>Price (₱)</label>
                    <input type="number" name="price" step="0.01" value="{{ $service->price }}" required>
                </div>
                <div class="form-group">
                    <label>Duration (Minutes)</label>
                    <input type="number" name="duration" value="{{ $service->duration }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem; padding: 1rem;">Update Service</button>
        </form>
    </div>
</div>
@endsection
