<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Gate;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Listing $listing)
    {
        //Gate::authorize("view", $listing);
        Gate::authorize("viewAny", $listing);

        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo',
        ]);

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->paginate(10)
                    ->withQueryString(),
            ]
        );
    }



    /**
     * Display the specified resource.
     */
    public function show(Listing $listing) //route model binding
    {
        // if(Auth::user()->cannot("view", $listing)){
        //     abort(403);
        // }

        //OR
        //Gate::authorize("view", $listing);

        return inertia("Listing/Show", [
            'listing' => $listing,
        ]);
    }

  
}
