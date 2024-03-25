<?php

namespace App\Models;

use App\Enums\DestinationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'marketing_name',
        'phone_number',
        'weekday_rate',
        'weekend_rate',
        'high_season_rate',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => DestinationType::class,
        'weekday_rate' => 'float',
        'weekend_rate' => 'float',
        'high_season_rate' => 'float',
    ];
}
