<?php

namespace Modules\Bank\Entities;

use App\Models\BaseModel;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Str;

/**
 * Modules\Bank\Entities\Bank
 *
 * @property int $id
 * @property string $name
 * @property string|null $link
 * @property string|null $code
 * @property bool|null $status
 * @property string|null $reason_status
 * @property string|null $logo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereReasonStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank withoutTrashed()
 * @mixin \Eloquent
 */
class Bank extends BaseModel
{
    protected $fillable = [
        'name',
        'link',
        'code',
        'status',
        'reason_status',
        'logo',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function getLogoAttribute(?string $value)
    {
        if (isDevelopment() && $value) {
            $manager = app()->make(FilesystemManager::class);
            $adapter = $manager->createS3Driver([
                ...config('filesystems.disks.s3'),
                'endpoint' => Str::replaceLast(
                    parse_url(config('filesystems.disks.s3.url'), PHP_URL_PATH),
                    '',
                    config('filesystems.disks.s3.url')
                ),
            ]);

            return $adapter->temporaryUrl("banks/{$value}", now()->addMinutes(10)); //
        }
    }
}
