<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_report extends Model
{
    use HasFactory;

    protected $table = 'daily_report';


    public function daily_reports()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }
}
