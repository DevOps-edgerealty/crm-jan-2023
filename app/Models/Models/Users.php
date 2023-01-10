<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    public function teams()
    {
      return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function leaderboard()
    {
      return $this->belongsTo(Leaderboard::class, 'id', 'agent_id');
    }

    public function website()
    {
        return $this->hasMany(Leaderboard::class, 'id', 'agent_id');
    }

    public function targets()
    {
      return $this->belongsTo(Target::class, 'id', 'agent_id');
    }


    public function daily_reports()
    {
      return $this->belongsTo(Daily_report::class, 'id', 'agent_id');
    }


}
