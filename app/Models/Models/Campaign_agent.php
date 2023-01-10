<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign_agent extends Model
{
    use HasFactory;
    protected $table = 'campaign_agent';

    public function agent()
    {
      return $this->hasOne(Users::class,  'id', 'agent_id');

    }
}
