<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_lead extends Model
{
    use HasFactory;

    protected $table = 'property_lead';
    protected $guarded = ['id'];


    public function users()
    {
      return $this->belongsTo(Users::class, 'agent_id', 'id');
    }

    public function lead_detailss()
    {
        return $this->belongsTo(Portal_lead_detail::class, 'id', 'lead_id');
    }

    // public function lead_details()
    // {
    //     return $this->belongsTo(Portal_lead_detail::class, 'id', 'lead_id');
    // }


    // public function lead_details()
    // {
    //   return $this->hasMany(Portal_lead_detail::class, 'id', 'lead_id');
    // }



}
