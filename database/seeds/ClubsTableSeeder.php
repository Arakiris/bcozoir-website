<?php

use Illuminate\Database\Seeder;

use App\Club;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Club::insert([
            ['name' => 'Ozoir', 'address' => '4 Rue de la Tuilerie, 91160 Ballainvilliers'],
            ['name' => 'Champs-sur-Marne', 'address' => 'Champs-sur-Marne'],
            ['name' => 'Paris', 'address' => 'Paris'],
            ['name' => 'YOYO', 'address' => 'TUTU'],
            ['name' => 'SOSO', 'address' => 'RIRI']
        ]);
    }
}
