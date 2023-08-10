<?php


use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);


it('can store contact', function () {
    login()->post('/contacts', [
        'first_name' => faker()->firstName,
        'last_name' => faker()->lastName,
        'email' => faker()->email,
        'phone' => faker()->e164PhoneNumber,
        'address' => 'Sienkiewicza',
        'city' => 'Kielce',
        'region' => 'Swietokrzykie',
        'country' => faker()->randomElement(['us', 'pl']),
        'postal_code' => faker()->postcode
        ])->assertRedirect('/contacts')->assertSessionHas('success', 'Contact created.');

    $contact = Contact::latest()->first();

    
});
