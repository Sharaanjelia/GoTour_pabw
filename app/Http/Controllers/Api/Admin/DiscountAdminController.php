<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountAdminController extends Controller
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

    public function index() { return Discount::all(); }
    public function show($id) { return Discount::findOrFail($id); }
    public function store(Request $request) { return Discount::create($request->all()); }
    public function update(Request $request, $id) {
        $discount = Discount::findOrFail($id);
        $discount->update($request->all());
        return $discount;
    }
    public function destroy($id) {
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
