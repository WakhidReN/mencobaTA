<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BusType;
use App\Enums\SeatBigBus;
use App\Enums\SeatLegrestBus;
use App\Enums\SeatMediumBus;

class Bus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'name',
        'type',
        'seat_total',
        'pic',
        'pic_phone',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'array',
        'type' => BusType::class,
    ];
}
