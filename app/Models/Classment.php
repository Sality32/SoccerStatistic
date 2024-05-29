<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'classments';
    protected $fillable = [
        'id',
        'team_id',
        'points',
        'win',
        'lose',
        'draw',
        'number_of_match',
        'home_goal',
        'away_goal'
    ];

    public function team()
    {
        return $this->belongsTo(SoccerTeam::class, 'team_id');
    }
}
