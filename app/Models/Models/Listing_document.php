<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_document extends Model
{
    use HasFactory;

    protected $table = 'listing_documents';

    public function Listing()
    {
      return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}
