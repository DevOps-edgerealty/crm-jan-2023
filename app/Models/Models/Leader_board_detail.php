<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader_board_detail extends Model
{
    use HasFactory;

    protected $table = 'leader_board_detail';

    public function leader_details()
    {
      return $this->belongsTo(Leaderboard::class, 'leader_id', 'id');
    }


}
