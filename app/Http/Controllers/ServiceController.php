<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
        ]);

        Service::create($request->all());
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'active' => 'nullable|boolean',
        ]);

        $service->update(array_merge(
            $request->only(['name', 'description', 'price', 'duration']),
            ['active' => $request->has('active')]
        ));

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function toggleActive(Service $service)
    {
        $service->update(['active' => !$service->active]);

        $message = $service->active
            ? 'Service is now active and visible to clients.'
            : 'Service has been deactivated and will no longer appear to clients.';

        return redirect()->route('admin.services.index')->with('success', $message);
    }
}
