<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RawConfirmValue
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RawConfirmValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawConfirmValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawConfirmValue query()
 * @mixin \Eloquent
 */
class RawConfirmValue extends Model
{
    protected $table = 'raw_kur_confirm_value';
    public $timestamps = false;
}
