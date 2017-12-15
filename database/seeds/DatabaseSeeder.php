<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

use App\Advert;
use App\Category;
use App\Club;
use App\Contact;
use App\Event;
use App\League;
use App\Link;
use App\Member;
use App\News;
use App\Partner;
use App\Picture;
use App\Podium;
use App\Score;
use App\Tournament;
use App\TournamentType;
use App\Video;
use App\Warning;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        /* 1 */
        factory(App\Member::class, 100)->create()->each(function ($member) {
            $member->picture()->save(factory(App\Picture::class)->states('member')->make());
        });
        $members = Member::where('is_licensee', 1)->get();
        foreach($members as $member){
            $member->score()->save(factory(App\Score::class)->make());
        }

        /* 2 */
        factory(App\League::class, 25)->create();
        factory(App\Tournament::class, 25)->states('passed')->create()->each(function($t){
            $t->pictures()->saveMany(factory(App\Picture::class, 32)->states('normal')->make());
        });
        factory(App\Tournament::class, 10)->states('now')->create()->each(function($t){
            $t->pictures()->saveMany(factory(App\Picture::class, 32)->states('normal')->make());
        });
        factory(App\Tournament::class, 10)->states('future')->create();
        
        $members = Member::where('is_licensee', 1)->pluck('id')->toArray();
        $leagues = League::all();
        foreach($leagues as $league){
            $used_members = array();
            for($i = 0 ; $i < 4; $i++){
                $member_id = $faker->randomElement($members);
                while (in_array($member_id, $used_members)) {
                    $member_id = $faker->randomElement($members);
                }
                $league->members()->attach($member_id);
                array_push($used_members, $member_id);
            }
        }
        
        $tournaments = Tournament::all();
        foreach($tournaments as $tournament){
            $used_members = array();
            for($i = 0 ; $i < 4; $i++){
                $member_id = $faker->randomElement($members);
                while (in_array($member_id, $used_members)) {
                    $member_id = $faker->randomElement($members);
                }
                $tournament->members()->attach($member_id);
                array_push($used_members, $member_id);
            }
        }
        
        $tournaments = Tournament::where('is_finished', 1)->get();
        
        foreach($tournaments as $tournament){
            $tournament->podium()->save(factory(App\Podium::class)->make());
        }
        
        /* 3 */
        $podia = Podium::all()->each(function($t){
            $t->pictures()->saveMany(factory(App\Picture::class, 32)->states('normal')->make());
        });

        /* 4 */
        factory(App\Warning::class, 5)->create();
        factory(App\News::class, 5)->states('photos')->create()->each(function($n){
            $n->pictures()->saveMany(factory(App\Picture::class, 5)->states('normal')->make());
        });
        factory(App\Advert::class, 5)->create()->each(function($ad){
            $ad->picture()->save(factory(App\Picture::class)->states('normal')->make());
        });

        factory(App\News::class, 5)->states('without')->create();
        factory(App\Event::class, 25)->create()->each(function($n){
            $n->pictures()->saveMany(factory(App\Picture::class, 25)->states('normal')->make());
        });
    }
}
