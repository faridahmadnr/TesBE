<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KurConfirmValue
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KurConfirmValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurConfirmValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurConfirmValue query()
 * @mixin \Eloquent
 */
class KurConfirmValue extends Model
{
    protected $table = 'enriched_kur_confirm_value';
    public $timestamps = false;
}
