<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','package_id','amount','status','payment_method','provider','transaction_id','full_name','email','phone','participants','travel_date','requests'];

    protected $casts = [
        'travel_date' => 'date',
        'participants' => 'integer',
        'amount' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function testimonial()
    {
        return $this->hasOne(\App\Models\Testimonial::class, 'payment_id');
    }
}
