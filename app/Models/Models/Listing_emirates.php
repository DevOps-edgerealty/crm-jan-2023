<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_emirates extends Model
{
    use HasFactory;
    protected $table = 'listing_emirates';

    public function Listing()
    {
      return $this->belongsTo(Listing::class, 'emirates', 'id');
    }

}
