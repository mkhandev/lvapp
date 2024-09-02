<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RealtorListingController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order']),
        ];


        return inertia('Realtor/Index', [
            'filters' => $filters,
            'listings' => Auth::User()
                ->listings()
                ->filter($filters)
                ->withCount('images') // for image count
                ->withCount('offers')
                ->paginate(10)
                ->withQueryString(),
        ]);

    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with("success", 'Listing was deleted!');
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Ypu can add permission like this way
        //Gate::authorize("create", Listing::class);

        return inertia("Listing/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$request->user()->listings->create();
        // if we use this then no need to add by_user_id
        //data save by the users realtion with listings
        //or please use Listing::create. then need to add by_user_id

        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was created!');
    }

      /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        Gate::authorize("update", $listing);

        return inertia("Listing/Edit", [
            'listing' => $listing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was changed!');
    }


    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }

    public function show(Listing $listing){

        return Inertia('Realtor/Show',[
            'listing' => $listing->load('offers', 'offers.bidder')
        ]);
    }
}
