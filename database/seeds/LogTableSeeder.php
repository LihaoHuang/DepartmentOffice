<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Log;
use \Faker\Factory as Faker;
class LogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('zh_TW');
        Log::truncate();
        foreach(range(0,20) as $number) {
            Log::create([
                'logInAC' => $faker->name,
                'logInTime' => Carbon::now()->addDays($number),
                'IP' => $faker->ipv4, 
                'logOutTime' => Carbon::now()->addDays($number+1)
            ]);
        }
    }
}
