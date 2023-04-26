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
        return view('listings.index', ['listings' => Listing::latest()->filter()->paginate(5)]);
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
        $formFields = $this->validateFormFields($request, 'store');

        $formFields = $this->uploadFile($request, $formFields);

        $listing->create($formFields);

        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    public function  edit(Listing $listing): View
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing): RedirectResponse
    {
        $formFields = $this->validateFormFields($request, 'edit', $listing);

        $formFields = $this->uploadFile($request, $formFields);

        $listing->update($formFields);

        return redirect('/')->with('message', 'Listing updated Successfully!');
    }

    private function validateFormFields(Request $request, string $action, Listing $listing = null): array
    {
        return  $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', $action === 'store' ? Rule::unique('listings', 'company') :  Rule::unique('listings', 'company')->ignore($listing->id)],
            'location' => 'required',
            'website' => ['required', 'url'],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'

        ]);
    }

    private function uploadFile(Request $request, array $form): array
    {
        if ($request->hasFile('logo')) {
            $logo =  $request->file('logo')->store('logos', 'public');
            $form['logo'] = $logo;
            return $form;
        }
        return $form;
    }
}
