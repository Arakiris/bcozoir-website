<?php

use Illuminate\Database\Seeder;

use App\ContentInformation;

class ContentInformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContentInformation::insert([
            ['name' => 'presentation', 'description' => ''],
            ['name' => 'adresses', 'description' => ''],
            ['name' => 'version', 'description' => ''],
            ['name' => 'mentions légales', 'description' => ''],
            ['name' => 'appel partenaires', 'description' => ''],
            ['name' => 'logo image', 'description' => ''],
            ['name' => 'banniere image', 'description' => ''],
            ['name' => 'bureau image', 'description' => ''],
            ['name' => 'musique de fond', 'description' => ''],
            ['name' => 'volume musique', 'description' => ''],
            ['name' => 'facebook image', 'description' => ''],
            ['name' => 'facebook url', 'description' => ''],
            ['name' => 'image tournament 1', 'description' => ''],
            ['name' => 'image tournament 2', 'description' => ''],
        ]);
    }
}
