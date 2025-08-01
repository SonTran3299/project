<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_SHIPPING = 2;
    const STATUS_DELIVERED = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_DELIVERY_FAILED = 5;

    use HasFactory;

    protected $table = 'order';

    public $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function orderPaymentMethods()
    {
        return $this->hasMany(OrderPaymentMethod::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusToTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS_CONFIRMED:
                return 'xác nhận đơn hàng';
            case self::STATUS_SHIPPING:
                return 'đang giao';
            case self::STATUS_DELIVERED:
                return 'giao thành công';
            case self::STATUS_CANCELLED:
                return 'đã hủy';
            case self::STATUS_DELIVERY_FAILED:
                return 'giao thất bại';
            default:
                return 'chờ xử lý';
        }
    }
}
