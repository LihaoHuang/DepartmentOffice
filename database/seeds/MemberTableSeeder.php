<?php

use Illuminate\Database\Seeder;
use \Faker\Factory as Faker;
use App\Models\Member;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Member::truncate();

        foreach (range(0,20) as $numbers ) {
            Member::create([
                'account' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'studentID' => $faker->biasedNumberBetween(10000000,99999999)
            ]);
        }
    }
}
