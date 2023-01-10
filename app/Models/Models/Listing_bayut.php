<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\Users;
use App\Models\Models\Listing_communities;
use App\Models\Models\Listing_developers;
use App\Models\Models\Listing_emirates;
use App\Models\Models\Listing_image;

class Listing_bayut extends Model
{
    use HasFactory;

    Protected $guarded = [ 'created_at' , 'updated_at' ];

    protected $table = 'listings_bayut';

    public function users()
    {
      return $this->belongsTo(Users::class, 'assign_to', 'id');
    }

    public function Listing_communities()
    {
      return $this->belongsTo(Listing_communities::class, 'community', 'id');
    }

    public function Listing_developers()
    {
      return $this->belongsTo(Listing_developers::class, 'developer', 'id');
    }

    public function Listing_emirates()
    {
      return $this->belongsTo(Listing_emirates::class, 'emirates', 'id');
    }

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
