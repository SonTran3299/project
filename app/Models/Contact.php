<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    const STATUS_PROCESS = 1;
    const STATUS_SUCCESS = 2;

    use HasFactory;

    protected $table = 'contact';

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusToTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PROCESS: return 'Đang xử lý';
            case self::STATUS_SUCCESS: return 'Đã phản hồi';
            default: return 'Mới';
        }
    }
}
