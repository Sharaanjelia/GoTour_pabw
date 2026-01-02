<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->is_admin) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return $next($request);
        });
    }

    public function index() { return Service::all(); }
    public function show($id) { return Service::findOrFail($id); }
    public function store(Request $request) { return Service::create($request->all()); }
    public function update(Request $request, $id) {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return $service;
    }
    public function destroy($id) {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
