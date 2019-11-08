<?php

use Illuminate\Database\Seeder;

use App\Statistic;

use Carbon\Carbon;

class StatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statistic::insert([
            'daily_visits' => 0,
            'month_visits' => 0,
            'since_creation_visits' => 0,
            'last_update' => Carbon::now()
        ]);
    }
}
