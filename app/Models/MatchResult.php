<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'matches';
    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'schedule',
        'statistics'
    ];

    public function homeTeam()
    {
        return $this->belongsTo(SoccerTeam::class, 'home_team_id');
    }
    public function awayTeam()
    {
        return $this->belongsTo(SoccerTeam::class, 'away_team_id');
    }

}
