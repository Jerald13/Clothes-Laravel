<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'order_total',
        'order_status',
        'shipping_address',
        'state',
        'city',
        'postcode',
        'shipping_fee',
        'tax_amount',
        'tax_rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
    return $this->belongsTo(Product::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment()
    {
    return $this->hasOne(Payment::class);
    }

}