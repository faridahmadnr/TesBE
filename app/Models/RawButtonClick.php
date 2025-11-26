<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RawButtonClick
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RawButtonClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawButtonClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawButtonClick query()
 * @mixin \Eloquent
 */
class RawButtonClick extends Model
{
    protected $table = 'raw_kur_button_click';
    public $timestamps = false;
}
