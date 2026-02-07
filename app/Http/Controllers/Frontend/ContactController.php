<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
