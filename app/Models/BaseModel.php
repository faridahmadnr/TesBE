<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withoutTrashed()
 *
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Modules\User\Entities\User|null $updater
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use BlameableTrait, HasFactory, SoftDeletes;
}
