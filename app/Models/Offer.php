<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function listing(){
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function bidder(){
        return $this->belongsTo(User::class, 'bidder_id');
    }

    public function scopeByMe($query){
        return $query->where('bidder_id', Auth::user()?->id);
    }

    public function scopeExcepte($query, Offer $offer){
        return $query->where('id', '!=', $offer->id);
    }
}
