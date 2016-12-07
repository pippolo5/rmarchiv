<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $cat
 * @property string $desc_md
 * @property string $desc_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereCat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Faq extends Model
{
    protected $table = 'faq';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'cat',
        'desc_md',
        'desc_html'
    ];

    protected $guarded = [];

        
}