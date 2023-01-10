<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_video extends Model
{
    use HasFactory;

    protected $table = 'listing_videos';

    public function Listing()
    {
      return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
