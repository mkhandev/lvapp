<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Gate;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        Gate::authorize("update", $offer->listing);

        // Accept selected offer
        $offer->update([
            'accepted_at' => now()
        ]);

        $offer->listing->sold_at = now();
        $offer->listing->save();

        //Rejected all other offers
        $offer->listing->offers()->excepte($offer)->update([
            'rejected_at' => now()
        ]);

        return redirect()->back()->with('success', "Offer #{$offer->id} accepted, other offers rejected");
    }
}
