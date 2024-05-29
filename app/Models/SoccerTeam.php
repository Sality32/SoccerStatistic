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

    public function matches()
    {
        return $this->hasMany(MatchResult::class);
    }
    public function classment()
    {
        return $this->hasOne(Classment::class);
    }
}
