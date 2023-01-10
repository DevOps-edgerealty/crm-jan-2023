<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    Protected $guarded = [ 'created_at' , 'updated_at' ];

    protected $table = 'leads';

    public function users()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }



    public function lead_typess()
    {
      return $this->belongsTo(Leads_type::class, 'lead_type', 'id');
    }



    public function campaigns()
    {
      return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }



    public function lead_detailss()
    {
      return $this->belongsTo(Lead_details::class, 'id', 'lead_id');
    }



    public function userss()
    {
      return $this->belongsTo(Users::class, 'modifier', 'id');
    }
}
