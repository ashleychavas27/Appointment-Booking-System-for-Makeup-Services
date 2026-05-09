@extends('layouts.app')

@section('content')
<div class="animate-fade">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="font-weight: 700;">Service Management</h1>
            <p style="opacity: 0.7;">Define your makeup service menu.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Add New Service</a>
    </div>

    <div class="glass-card">
        @if($services->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td style="font-weight: 600;">{{ $service->name }}</td>
                            <td>{{ $service->duration }} mins</td>
                            <td>₱{{ number_format($service->price, 2) }}</td>
                            <td>{{ $service->active ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn" style="background: rgba(255,255,255,0.1); font-size: 0.8rem; padding: 0.4rem 0.8rem;">Edit</a>
                                    <form action="{{ route('admin.services.toggle', $service) }}" method="POST" onsubmit="return confirm('{{ $service->active ? 'Deactivate' : 'Activate' }} this service?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn" style="background: rgba(31, 142, 236, 0.14); color: #1f8dec; font-size: 0.8rem; padding: 0.4rem 0.8rem;">{{ $service->active ? 'Deactivate' : 'Activate' }}</button>
                                    </form>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service? This will remove it from the system.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="background: rgba(255, 118, 117, 0.2); color: #ff7675; font-size: 0.8rem; padding: 0.4rem 0.8rem;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; opacity: 0.5; padding: 2rem;">No services created yet.</p>
        @endif
    </div>
</div>
@endsection
