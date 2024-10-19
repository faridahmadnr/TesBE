<?php

namespace App\Models;

use Deligoez\LaravelModelHashId\Traits\HasHashId;
use Deligoez\LaravelModelHashId\Traits\HasHashIdRouting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Filesystem\FilesystemManager;
use Laravel\Scout\Searchable;
use Rennokki\QueryCache\Traits\QueryCacheable;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Spatie\Activitylog\Traits\CausesActivity;
use Str;

// use Spatie\Activitylog\LogOptions;
// use Spatie\Activitylog\Traits\LogsActivity;

#[\AllowDynamicProperties]
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

    protected function getUploadPath(string $path, ?string $value): ?string
    {
        $defaultFilesystem = config('filesystems.default');
        $isFilesystemS3 = $defaultFilesystem === 's3';
        if (isDevelopment() && $value && $isFilesystemS3) {
            $manager = app()->make(FilesystemManager::class);

            /** @var \Illuminate\Filesystem\AwsS3V3Adapter $adapter */
            $adapter = $manager->createS3Driver([
                ...config('filesystems.disks.s3'),
                'endpoint' => Str::replaceLast(
                    parse_url(config('filesystems.disks.s3.url'), PHP_URL_PATH),
                    '',
                    config('filesystems.disks.s3.url')
                ),
            ]);

            $isUsingR2 = Str::contains(config('filesystems.disks.s3.endpoint'), 'cloudflare');
            if ($isUsingR2) {
                /**
                 * As R2 does not support presigned url with custom domain
                 * we need to use url instead
                 *
                 * https://developers.cloudflare.com/r2/api/s3/presigned-urls/#limitations
                 */
                return $adapter->url("$path/{$value}");
            }

            return $adapter->temporaryUrl("$path{$value}", now()->addMinutes(10)); //
        }

        if (! $value) {
            return '';
        }
        $appUrl = config('filesystems.disks.'.$defaultFilesystem.'.url');

        return "$appUrl/$path$value";
    }
}
