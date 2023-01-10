<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $table = 'targets';


    public function targets()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }

}
