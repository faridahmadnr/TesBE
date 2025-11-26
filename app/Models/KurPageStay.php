<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KurPageStay
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KurPageStay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurPageStay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurPageStay query()
 * @mixin \Eloquent
 */
class KurPageStay extends Model
{
    protected $table = 'enriched_kur_page_stay';
    public $timestamps = false;
}
