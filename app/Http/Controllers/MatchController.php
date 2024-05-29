<?php

namespace App\Http\Controllers;

use App\Models\Classment;
use App\Models\MatchResult;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MatchController extends Controller
{
    // api/matches/store
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $data = $request->all();

            $records = [];
            foreach ($data as $key ) {
                
                // Check duplicate data with validation match
                if ($this->isDuplicateMatch($records, $key['schedule'], ['home'=> $key['home_team'], 'away'=>$key['away_team']])){
                    throw new Exception('Duplicate Schedule with teams match');
                }

                // Store Match
                $record = MatchResult::create([
                    'home_team_id' => $key['home_team'],
                    'away_team_id' => $key ['away_team'],
                    'schedule' => $key['schedule'],
                    'statistics' => json_encode($key['statistics']),
                ]);

                // Update for Classment
                $classmentHome = Classment::where('team_id', $key['home_team'])->first();
                $classmentAway = Classment::where('team_id', $key['away_team'])->first();
                if($key['statistics']['home_team_goal'] > $key['statistics']['away_team_goal']){
                    // Home Win
                    $classmentHome->win += 1;
                    $classmentHome->points += 3;
                    $classmentHome->number_of_match += 1;
                    $classmentHome->home_goal += $key['statistics']['home_team_goal'];
                    

                    // Away Win
                    $classmentAway->lose += 1;
                    $classmentAway->number_of_match += 1;
                    $classmentAway->away_goal += $key['statistics']['away_team_goal'];
                    
                } else if ($key['statistics']['home_team_goal'] < $key['statistics']['away_team_goal']){
                     // Home Lose
                     $classmentHome->lose += 1;
                     $classmentHome->number_of_match += 1;
                     $classmentHome->home_goal += $key['statistics']['home_team_goal'];
                     
 
                     // Away Lose
                     $classmentAway->win += 1;
                     $classmentAway->points += 3;
                     $classmentAway->number_of_match += 1;
                     $classmentAway->away_goal += $key['statistics']['away_team_goal'];
                }else {
                     // Draw
                     $classmentHome->draw += 1;
                     $classmentHome->points += 1;
                     $classmentHome->number_of_match += 1;
                     $classmentHome->home_goal += $key['statistics']['home_team_goal'];

                     $classmentAway->draw += 1;
                     $classmentAway->points += 1;
                     $classmentAway->number_of_match += 1;
                     $classmentAway->away_goal += $key['statistics']['away_team_goal'];
                }
                $classmentHome->save();
                $classmentAway->save();

                $records[] = $record;
            }

            DB::commit();
            return response()->json((object)['success' => true, 'data' => $records]);
        } catch(\ValidationError $ve){
            DB::rollback();
            Log::error($ve);
            return response()->json((object)['success' => false, 'message' => $ve->getMessage(), 'detail' => $ve]);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return response()->json((object)['success' => false, 'message' => $th->getMessage(), 'detail' => $th]);
        }
    }

    private function isDuplicateMatch($records, $schedule, $teams)
    {
        foreach ($records as $key ) {
            Log::info($key);
            if($key['schedule'] == $schedule && 
            ($key['home_team_id'] == $teams['home'] ||
            $key['away_team_id'] == $teams['away'] ||
            $key['away_team_id'] == $teams['home'] ||
            $key['home_team_id'] == $teams['away'])){
                return true;
            }
        }
        return false;
    }
}
