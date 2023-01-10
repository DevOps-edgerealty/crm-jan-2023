<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_floor_plan extends Model
{
    use HasFactory;

    protected $table = 'listing_floor_plans';

    public function Listing()
    {
      return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
