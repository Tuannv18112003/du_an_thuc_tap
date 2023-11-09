<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_order',
        'total_price',
        'payment',
        'note',
        'return_reason',
        'status'
    ];

    public function ordersDetail() {
        return $this->belongsTo(OrdersDetail::class);
    }
    
    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
