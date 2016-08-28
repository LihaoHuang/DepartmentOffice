<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\EventRegist;
use \Faker\Factory as Faker;
class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('zh_TW');
        EventRegist::truncate();
        foreach(range(0,20) as $number){
            EventRegist::create([
                'name' => $faker->name,
                'start_at' => Carbon::now()->addDays($number),
                'end_at' => Carbon::now()->addDays($number+1)
            ]);
        }
    }
}
