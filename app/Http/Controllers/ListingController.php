<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//Models
use App\Models\Listing;

class ListingController extends Controller
{

    public function index()
    {
        return view('listings.index', ['listings' => Listing::latest()->filter()->get()]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }
}
