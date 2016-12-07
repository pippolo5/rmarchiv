<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obyx
 *
 * @property integer $id
 * @property integer $value
 * @property string $reason
 * @property string $reason_visible
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereReasonVisible($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Obyx extends Model
{
    protected $table = 'obyx';

    public $timestamps = true;

    protected $fillable = [
        'value',
        'reason',
        'reason_visible'
    ];

    protected $guarded = [];

        
}