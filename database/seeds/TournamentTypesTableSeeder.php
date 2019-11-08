<?php

use Illuminate\Database\Seeder;

use App\TournamentType;

class TournamentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TournamentType::insert([
            ['title' => 'BC Ozoir'],
            ['title' => 'Privé'],
            ['title' => 'Championnat Fédéral']
        ]);
    }
}
