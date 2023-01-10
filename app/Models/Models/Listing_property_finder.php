<?php

namespace App\Models\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_property_finder extends Model
{
    use HasFactory;

    protected $table = 'listing_property_finder';



    public function Listing_pf_amenities()
    {
        return $this->hasMany(Listing_pf_amenity::class);
    }

    public function users()
    {
      return $this->belongsTo(Users::class, 'assign_to', 'id');
    }

    public function Listing_pf_category()
    {
      return $this->belongsTo(Listing_pf_category::class, 'developer', 'id');
    }

    public function Listing_pf_property_type()
    {
      return $this->belongsTo(Listing_pf_property_type::class, 'emirates', 'id');
    }

    public function Listing_pf_city()
   {
     return $this->hasMany(Listing_pf_city::class);
   }

   public function Listing_pf_community()
   {
     return $this->hasMany(Listing_pf_community::class);
   }

   public function Listing_pf_sub_community()
   {
     return $this->hasMany(Listing_pf_sub_community::class);
   }
}
