<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KurButtonShow
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KurButtonShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurButtonShow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurButtonShow query()
 * @mixin \Eloquent
 */
class KurButtonShow extends Model
{
    protected $table = 'enriched_kur_button_show';
    public $timestamps = false;
}