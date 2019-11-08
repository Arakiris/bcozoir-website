<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['title' => 'Senior'],
            ['title' => 'Vétéran 1'],
            ['title' => 'Vétéran 2'],
            ['title' => 'Vétéran 3']
        ]);
    }
}
