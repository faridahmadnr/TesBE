<?php

namespace Modules\Testimoni\Database\seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\Testimoni\Entities\Testimoni;

class TestimoniDatabaseSeeder extends Seeder
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

        $this->truncate('testimonis');

        Testimoni::insert([
            [
                'name' => 'Adhi Purnama',
                'email' => null,
                'message' => 'KUR adalah soulmate UMKM',
                'is_anonymous' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agita isfiani kharisma',
                'email' => null,
                'message' => 'Awalnya hanya usaha rumahan dengan omset hanya 10jt/bln. Sejak ada bantuan KUR, usaha kami berkembang di tempat baru dengan omset 5x lipat/bln. Percaya ga percaya, tapi ini yg terjadi pada usaha kami. Terima kasih KUR, terutama BRI yg sdh percaya pada kami.',
                'is_anonymous' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Devri Harmanda Putra',
                'email' => null,
                'message' => 'Alhamdulillah dengan adanya website sy mendapat kemudahan mengenai informasi KUR dan syaratÂ² pengajuannya.. selain itu saya juga mendapat pelayanan yang baik dan sigap dari pihak bank BRI, saya sangat berterima kasih karna dengan adanya layanan ini, usaha sy bisa berjalan dengan baik..',
                'is_anonymous' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->enableForeignKeys();
    }
}
