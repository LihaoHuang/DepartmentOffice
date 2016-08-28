<?php
use App\Models\Turnout;
use Illuminate\Database\Seeder;
use \Faker\Factory as Faker;

class TurnoutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {     
        $faker = Faker::create('zh_TW');
        Turnout::truncate();    
        
        foreach(range(0,20) as $number){
            Turnout::create([
                'item' => $faker->sentence,
                'votes' => rand(0,1000000)
            ]);
        }
    }
}
