<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'tracking_no',
        'full_name',
        'email',
        'phone',
        'province',
        'county',
        'address',
        'status_message',
    ];

    public static function rules()
    {
        return [
            'full_name' => 'required|string',
            'phone'     => 'required|integer',
            'email'     => 'required|email',
            'province'  => 'required|string',
            'county'    => 'required|string',
            'address'   => 'required',
        ];
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
}
