<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KurPageEnter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KurPageEnter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurPageEnter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KurPageEnter query()
 * @mixin \Eloquent
 */
class KurPageEnter extends Model
{
    protected $table = 'enriched_kur_page_enter';
    public $timestamps = false;
}