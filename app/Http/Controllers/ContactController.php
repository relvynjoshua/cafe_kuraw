<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    /**
     * Display the contact form page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * Handle the contact form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Prepare the data for the email
        $data = $request->only('name', 'email', 'phone', 'subject', 'message');

        try {
            // Send the email to the intended recipient
            Mail::to('kurawcoffee@gmail.com')->send(new ContactMessage($data));

            // Redirect back with a success message
            return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());
            return redirect()->route('contact')->with('error', 'Failed to send your message. Please try again later.');
        }
    }
}
