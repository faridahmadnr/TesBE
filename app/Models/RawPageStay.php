<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RawPageStay
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RawPageStay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawPageStay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawPageStay query()
 * @mixin \Eloquent
 */
class RawPageStay extends Model
{
    protected $table = 'raw_kur_page_stay';
    public $timestamps = false;
}