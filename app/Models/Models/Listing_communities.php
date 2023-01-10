<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\Listing;

class Listing_communities extends Model
{
    use HasFactory;

    protected $table = 'listing_communities';

    // public function Listing()
    // {
    //   return $this->belongsTo(Listing::class, 'community', 'id');
    // }

}
