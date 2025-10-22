<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string|null $user_id
 * @property string $event_name
 * @property array|null $event_properties
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed|null $v_enrichment
 * @property string|null $ip_address
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVEnrichment($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;
    
    // Nama tabel yang terhubung dengan model iniio
    protected $table = 'events';

    // mass assignable
    protected $fillable = [
        'user_id',
        'event_name',
        'event_properties',
    ];

    // Kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'event_properties' => 'json',
    ];
}