<?php


use App\Models\Contact;
use function Pest\Faker\faker;


it('It can store contact', function (array $data) {
    login()->post('/contacts', [...[
        'first_name' => faker()->firstName,
        'last_name' => faker()->lastName,
        'email' => faker()->email,
        'phone' => faker()->e164PhoneNumber,
        'address' => 'Sienkiewicza',
        'city' => 'Kielce',
        'region' => 'Swietokrzyskie',
        'country' => faker()->randomElement(['us', 'pl']),
        'postal_code' => faker()->postcode
        ], ...$data])->assertRedirect('/contacts')->assertSessionHas('success', 'Contact created.');

//    $contact = Contact::latest()->first();
//
//    // $this->assertSame('Kielce', $contact->city);
//
//    expect($contact->first_name)->toBeString()->not->toBeEmpty();
//    expect($contact->last_name)->toBeString()->not->toBeEmpty();
//    expect($contact->email)->toBeString()->toContain('@', '.');
//    expect($contact->phone)->toBePhoneNumber();
//    expect($contact->city)->toBe('Kielce');
//    expect($contact->region)->toBe('Swietokrzyskie');
//    expect($contact->country)->toBeIn(['us', 'pl']);

    expect(Contact::latest()->first())
        ->first_name->toBeString()->not->toBeEmpty()
        ->last_name->toBeString()->not->toBeEmpty()
        ->email->toBeString()->toContain('@', '.')
        ->phone->toBePhoneNumber()
        ->city->toBe('Kielce')
        ->region->toBe('Swietokrzyskie')
        ->country->toBeIn(['us', 'pl']);
})->with([
    'generic' => [[]],
    'with provided email with spaces' => [['email' => '"luuke dow"@gmail.com']],
    'with email and last name' => [['email' => 'luke@gmail.com', 'last_name' => 'Joe']],
    [['email' => '"luke luuke"@gmail.com', 'last_name' => 'Liza']],
    [['last_name' => 'Olivier']],
    'with postal code with 24 characters' => [['postal_code' => str_repeat('12', 12)]]
]);
