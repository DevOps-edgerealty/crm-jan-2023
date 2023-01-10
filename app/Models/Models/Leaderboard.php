<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $table = 'leader_board';

    public function leader_details()
    {
      return $this->hasMany(Leader_board_detail::class, 'id', 'leader_id');
    }


    public function leader_detail()
    {
      return $this->belongsTo(Leader_board_detail::class, 'id', 'leader_id');
    }

    public function leaderboard()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }
}
