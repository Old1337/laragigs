<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;


//Models
use App\Models\Listing;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

    public function index(): View
    {
        return view('listings.index', ['listings' => Listing::latest()->filter()->get()]);
    }

    public function show(Listing $listing): View
    {

        return view('listings.show', ['listing' => $listing]);
    }

    public function create(): View
    {
        return view('listings.create');
    }

    public function store(Request $request, Listing $listing): RedirectResponse
    {
        $formFields = $request->validate([

            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => ['required', 'url'],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'

        ]);

        $listing->create($formFields);

        return redirect('/')->with('message', 'Listing Created Successfully!');
    }
}
