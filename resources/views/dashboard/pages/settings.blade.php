@extends('layouts.dashboard')

@section('title', 'Settings')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Settings</h1>

    <div class="accordion" id="settingsAccordion">
        <!-- Account Details -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAccountDetails">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAccountDetails" aria-expanded="true" aria-controls="collapseAccountDetails">
                    Account Details
                </button>
            </h2>
            <div id="collapseAccountDetails" class="accordion-collapse collapse show" aria-labelledby="headingAccountDetails" data-bs-parent="#settingsAccordion">
                <div class="accordion-body">
                    <p><strong>Name:</strong> {{ Auth::user()->firstname }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Phone:</strong> {{ Auth::user()->phone_number ?? 'Not provided' }}</p>
                    <p><strong>Account Created:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Privacy Policy -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingPrivacyPolicy">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrivacyPolicy" aria-expanded="false" aria-controls="collapsePrivacyPolicy">
                    Privacy Policy
                </button>
            </h2>
            <div id="collapsePrivacyPolicy" class="accordion-collapse collapse" aria-labelledby="headingPrivacyPolicy" data-bs-parent="#settingsAccordion">
                <div class="accordion-body">
                    <p>
                        Your privacy is important to us. All your data is stored securely and will not be shared
                        with third parties without your consent. For more details, read our full privacy policy on our website.
                    </p>
                </div>
            </div>
        </div>

        <!-- About -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAbout">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="false" aria-controls="collapseAbout">
                    About
                </button>
            </h2>
            <div id="collapseAbout" class="accordion-collapse collapse" aria-labelledby="headingAbout" data-bs-parent="#settingsAccordion">
                <div class="accordion-body">
                    <p>
                        <strong>Kuraw Cafe Dashboard</strong> is a management system built to handle your inventory, reservations,
                        and customer details. We strive to provide you with a seamless experience for managing your cafe!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
