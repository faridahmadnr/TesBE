<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RawPageSlide
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RawPageSlide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawPageSlide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawPageSlide query()
 * @mixin \Eloquent
 */
class RawPageSlide extends Model
{
    protected $table = 'raw_kur_page_slide';
    public $timestamps = false;
}
