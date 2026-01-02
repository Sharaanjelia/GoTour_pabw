<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageAdminController extends Controller
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

    public function index() { return Package::all(); }
    public function show($id) { return Package::findOrFail($id); }
    public function store(Request $request) { return Package::create($request->all()); }
    public function update(Request $request, $id) {
        $package = Package::findOrFail($id);
        $package->update($request->all());
        return $package;
    }
    public function destroy($id) {
        $package = Package::findOrFail($id);
        $package->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
