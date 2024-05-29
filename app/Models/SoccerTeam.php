<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoccerTeam extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'soccer_teams';
    protected $fillable = [
        'name',
        'city'
    ];

    public function homeMatches()
    {
        return $this->hasMany(MatchResult::class, 'home_team_id');
    }
    public function awayMatches()
    {
        return $this->hasMany(MatchResult::class, 'away_team_id');
    }
    public function classment()
    {
        return $this->hasOne(Classment::class, 'team_id');
    }
}
