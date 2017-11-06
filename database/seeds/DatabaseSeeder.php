<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Member;
use App\Picture;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(App\Member::class, 2)->create()->each(function ($member) {
        //     $path = storage_path('app/public/upload/images/members' . $member->id . 'picture.jpg');
        //     Storage::copy(storage_path('app/public/imagesPrefab/Photo_1.jpg'), $path);
        //     $picture = new Picture();
        //     $picture->path = substr($path, 6);

        //     $member->picture()->save($picture);
        // });
    }
}
