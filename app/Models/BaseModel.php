<?php

namespace App\Models;

use Deligoez\LaravelModelHashId\Traits\HasHashId;
use Deligoez\LaravelModelHashId\Traits\HasHashIdRouting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Spatie\Activitylog\Traits\CausesActivity;

// use Spatie\Activitylog\LogOptions;
// use Spatie\Activitylog\Traits\LogsActivity;

abstract class BaseModel extends Model
{
    use BlameableTrait, CausesActivity, HasFactory, HasHashId, HasHashIdRouting, QueryCacheable, Searchable, SoftDeletes;

    public $cacheFor = 600;

    protected static $flushCacheOnUpdate = true;

    // TODO:
    /**
     * TODO:
     * I need to figure out how to change description for this, we unable to use the auto way because of this
     */
    // protected static $logOnlyDirty = true;

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logFillable()
    //         ->dontSubmitEmptyLogs();
    // }
}
