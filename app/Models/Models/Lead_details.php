<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead_details extends Model
{
    use HasFactory;

    protected $table = 'lead_detail';

    public function users()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }

}
