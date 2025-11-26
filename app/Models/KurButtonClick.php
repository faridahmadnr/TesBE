<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KurButtonClick
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KurButtonClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurButtonClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurButtonClick query()
 * @mixin \Eloquent
 */
class KurButtonClick extends Model
{
    protected $table = 'enriched_kur_button_click';
    public $timestamps = false;
}
