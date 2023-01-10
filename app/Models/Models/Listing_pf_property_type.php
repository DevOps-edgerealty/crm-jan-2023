<?php

namespace App\Models\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_pf_property_type extends Model
{
    use HasFactory;

    protected $table = 'listing_pf_property_types';

    public function listing_pf_categories()
    {
      return $this->belongsTo(Listing_pf_category::class, 'category_id', 'id');
    }

}
