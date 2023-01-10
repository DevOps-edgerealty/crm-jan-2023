<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;

    protected $table = 'listings';


    public function Listing_image()
   {
     return $this->hasMany(Listing_image::class);
   }

   public function Listing_video()
   {
     return $this->hasMany(Listing_video::class);
   }

   public function Listing_floor_plan()
   {
     return $this->hasMany(Listing_floor_plan::class);
   }

   public function Listing_document()
   {
     return $this->hasMany(Listing_document::class);
   }
}
