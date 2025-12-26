<?php

namespace App\Http\Controllers;

use App\Models\Discount;

class DiscountController extends Controller
{
    public function index()
    {
        $items = Discount::where('is_active', true)->where(function($q){
            $now = now();
            $q->whereNull('starts_at')->orWhere('starts_at','<=',$now);
        })->where(function($q){
            $now = now();
            $q->whereNull('ends_at')->orWhere('ends_at','>=',$now);
        })->orderByDesc('created_at')->get();

        return view('discounts', compact('items'));
    }
}
