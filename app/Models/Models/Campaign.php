<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaign';

    public function users()
    {
      return $this->belongsTo(Users::class, 'campaign_agent', 'id');
    }

    public function lead_typess()
    {
      return $this->belongsTo(Leads_type::class, 'platform', 'id');
    }




    public function campaign_agents()
    {
      return $this->hasMany(Campaign_agent::class,  'campaign_id', 'id');

    }

}
