<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasUuids;
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'status',
        'subscriber_id',
        'start_date',
        'expire_date',
        'phone_number',
        'packageId',
        'user_id',
    ];
    protected $primaryKey = 'subscriber_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
