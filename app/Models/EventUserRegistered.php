<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventUserRegistered
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int $reg_price_payed
 * @property int $reg_state
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereRegPricePayed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereRegState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EventUserRegistered extends Model
{
    protected $table = 'event_user_registered';

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'user_id',
        'reg_price_payed',
        'reg_state'
    ];

    protected $guarded = [];

        
}