<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    Protected $guarded = [ 'created_at' , 'updated_at' ];

    protected $table = 'website';

    public function users()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }

    public function lead_detailss()
    {
        return $this->belongsTo(Website_lead_detail::class, 'id', 'lead_id');
    }

}
