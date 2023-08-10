<?php


use App\Models\Contact;
use function Pest\Faker\faker;


it('It can store contact', function () {
    login()->post('/contacts', [
        'first_name' => faker()->firstName,
        'last_name' => faker()->lastName,
        'email' => faker()->email,
        'phone' => faker()->e164PhoneNumber,
        'address' => 'Sienkiewicza',
        'city' => 'Kielce',
        'region' => 'Swietokrzyskie',
        'country' => faker()->randomElement(['us', 'pl']),
        'postal_code' => faker()->postcode
        ])->assertRedirect('/contacts')->assertSessionHas('success', 'Contact created.');

    $contact = Contact::latest()->first();

    // $this->assertSame('Kielce', $contact->city);

    expect($contact->first_name)->toBeString()->not->toBeEmpty();
    expect($contact->last_name)->toBeString()->not->toBeEmpty();
    expect($contact->email)->toBeString()->toContain('@', '.');
    expect($contact->phone)->toBeString()->toContain('+');
    expect($contact->city)->toBe('Kielce');
    expect($contact->region)->toBe('Swietokrzyskie');
    expect($contact->region)->toBe('Swietokrzyskie');
    expect($contact->country)->toBeIn(['us', 'pl']);
});
