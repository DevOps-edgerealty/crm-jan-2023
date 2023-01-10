<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website_lead_detail extends Model
{
    use HasFactory;

    protected $table = 'website_lead_detail';

    public function users()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }
}
