<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasUuids;
    use HasFactory;
    protected $fillable = [
        'status',
        'subscriber_id',
        'start_date',
        'expire_date',
        'phone_number',
        'subscriber_id',
        'user_id',
    ];
    protected $primaryKey = 'subscriber_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
