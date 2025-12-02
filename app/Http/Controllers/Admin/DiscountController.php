<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $q = Discount::query()->orderByDesc('created_at');
        if ($s = $request->input('q')) $q->where('code','like',"%$s%");
        $items = $q->paginate(15)->withQueryString();
        return view('admin.discounts.index', compact('items'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:discounts,code',
            'percent' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
            'is_active' => 'sometimes',
        ]);

        $data['is_active'] = $request->has('is_active');
        Discount::create($data);

        return redirect()->route('admin.discounts.index')->with('success','Discount created');
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:discounts,code,'.$discount->id,
            'percent' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
            'is_active' => 'sometimes',
        ]);

        $data['is_active'] = $request->has('is_active');
        $discount->update($data);
        return redirect()->route('admin.discounts.index')->with('success','Discount updated');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return back()->with('success','Deleted');
    }
}
