<?php

namespace Database\Seeders;

use App\Models\SoccerTeam;
use Illuminate\Database\Seeder;

class SoccerTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Eagle United', 'city' => 'New York'],
            ['name' => 'Thunderbolts FC', 'city' => 'Los Angeles'],
            ['name' => 'Wildcats FC', 'city' => 'Chicago'],
            ['name' => 'Dynamo Rovers', 'city' => 'Houston'],
            ['name' => 'Falcon Warriors', 'city' => 'Phoenix'],
            ['name' => 'Storm Kings', 'city' => 'Philadelphia'],
            ['name' => 'Lionhearts FC', 'city' => 'San Antonio'],
            ['name' => 'Panther Pioneers', 'city' => 'San Diego'],
            ['name' => 'Hawk Rangers', 'city' => 'Dallas'],
            ['name' => 'Viper Strikers', 'city' => 'San Jose'],
            ['name' => 'Dragonfly FC', 'city' => 'Austin'],
            ['name' => 'Crimson Tide', 'city' => 'Jacksonville'],
            ['name' => 'Silver Spurs', 'city' => 'Fort Worth'],
            ['name' => 'Golden Eagles', 'city' => 'Columbus'],
            ['name' => 'Blue Sharks', 'city' => 'San Francisco'],
            ['name' => 'Titan Torpedoes', 'city' => 'Charlotte'],
            ['name' => 'Phoenix Flames', 'city' => 'Indianapolis'],
            ['name' => 'Tiger Tornadoes', 'city' => 'Seattle'],
            ['name' => 'Wolverine Wanderers', 'city' => 'Denver'],
            ['name' => 'Raging Bulls', 'city' => 'Washington']
        ];
        foreach ($data as $item) {
            $team = SoccerTeam::create($item);
            $team->classment()->create([
                'team_id' => $team->id
            ]);
        }
    }
}
