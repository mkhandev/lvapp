<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['src'];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    // example getRealSrcAttribute -> real_src
    public function getSrcAttribute()
    {
        return asset("storage/{$this->filename}");
    }
}
