<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RawConfirmResult
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RawConfirmResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawConfirmResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawConfirmResult query()
 * @mixin \Eloquent
 */
class RawConfirmResult extends Model
{
    protected $table = 'raw_kur_confirm_result';
    public $timestamps = false;
}
