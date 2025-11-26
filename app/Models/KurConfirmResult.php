<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KurConfirmResult
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KurConfirmResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurConfirmResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurConfirmResult query()
 * @mixin \Eloquent
 */
class KurConfirmResult extends Model
{
    protected $table = 'enriched_kur_confirm_result';
    public $timestamps = false;
}
