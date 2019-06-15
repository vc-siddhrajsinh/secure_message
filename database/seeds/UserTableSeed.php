<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'user_type' => Str:: rand(1,0),
                'user_name' => $faker->name,
                'password' => bcrypt('secret'),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime,
            ]);
        }
    }
}
