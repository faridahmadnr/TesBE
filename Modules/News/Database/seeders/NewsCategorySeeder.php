<?php

namespace Modules\News\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\News\Entities\NewsCategory;

class NewsCategorySeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('news_categories');

        NewsCategory::create([
            'id' => 1,
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
        ]);

        $this->enableForeignKeys();
    }
}
