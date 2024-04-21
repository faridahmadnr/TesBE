<?php

namespace Modules\Bank\Entities;

use App\Models\BaseModel;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Str;

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
