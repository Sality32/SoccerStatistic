<?php

namespace App\Http\Controllers;

use App\Models\Classment;
use Illuminate\Support\Facades\Log;

class ClassmentController extends Controller
{
    // api/classments
    public function index() 
    {
        try {
            $classments = Classment::with('team')
                ->select('*', \DB::raw('home_goal - away_goal as selisih_goal'))
                ->orderBy('points', 'desc')
                ->orderBy('selisih_goal', 'desc')
                ->orderBy('away_goal', 'desc')
                ->orderBy('number_of_match', 'asc')
                ->get();
            $rank = 0;

            // Mapping data
            $classments = $classments->map(function ($item) use (&$rank){
                return [
                    'id'=> $item->id,
                    'name' => $item->team['name'],
                    'city' => $item->team['city'],
                    'team_id'=> $item->team['id'],
                    'rank' => $rank +=1,
                    'win' => $item->win,
                    'lose' => $item->lose,
                    'draw' => $item->draw,
                    'number_of_match' => $item->number_of_match,
                    'home_goal' => $item->home_goal,
                    'away_goal' => $item->away_goal
                ];
            });
            return response()->json(['data' => $classments]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json((object) ['success'=> false, 'message' => $th->getMessage()]);
        } catch( \ValidationException $ve){
            Log::error($ve);
            return response()->json((object) ['success'=> false, 'message' => $ve->getMessage()]);
        }
    }
}
