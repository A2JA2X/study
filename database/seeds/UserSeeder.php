<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        $professions = DB::select('SELECT id FROM professions WHERE title = ? LIMIT 0,1', [
//            'Back-end developer'
//        ]);

        $professionId = Profession::where('title', 'Back-end developer')->value('id');



        User::create([
            'name'          => 'Josh',
            'email'         => 'Joshynelli@test.com',
            'password'      => bcrypt('laravel'),
            'profession_id' => $professionId,
        ]);
    }
}
