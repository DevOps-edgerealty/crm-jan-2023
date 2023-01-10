<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portal_lead_detail extends Model
{
    use HasFactory;

    protected $table = 'portal_lead_detail';

    public function users()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }


    public function leader_details()
    {
      return $this->belongsTo(Property_lead::class, 'lead_id', 'id');
    }


}
