<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Property;
use App\Notifications\ContactRequestNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_contact_request_sends_mail_and_redirects_back(): void
    {
        Notification::fake();

        $property = Property::factory()->create();
        $show = route('property.show', ['slug' => $property->getSlug(), 'property' => $property]);

        $this->from($show)
            ->post(route('property.contact', $property), [
                'firstname' => 'Ada',
                'lastname' => 'Lovelace',
                'phone' => '0600000000',
                'email' => 'ada@example.com',
                'message' => 'Je suis intéressée',
            ])
            ->assertRedirect($show)
            ->assertSessionHas('success', 'Votre message a été envoyé avec succès');

        Notification::assertSentOnDemand(
            ContactRequestNotification::class,
            function (ContactRequestNotification $notification, array $channels, AnonymousNotifiable $notifiable) use ($property): bool {
                return $notifiable->routes['mail'] === 'john@admin.com'
                    && $channels === ['database', 'mail']
                    && $notification->toArray($notifiable) === [
                        'property_id' => $property->id,
                        'title' => $property->title,
                        'firstname' => 'Ada',
                        'lastname' => 'Lovelace',
                        'phone' => '0600000000',
                        'email' => 'ada@example.com',
                        'message' => 'Je suis intéressée',
                    ];
            },
        );
    }

    public function test_empty_contact_request_rejects_required_fields_and_sends_no_mail(): void
    {
        Notification::fake();

        $property = Property::factory()->create();
        $show = route('property.show', ['slug' => $property->getSlug(), 'property' => $property]);

        $this->from($show)
            ->post(route('property.contact', $property), [])
            ->assertRedirect($show)
            ->assertSessionHasErrors([
                'firstname' => 'Le champ Prénom est obligatoire.',
                'lastname' => 'Le champ Nom est obligatoire.',
                'phone' => 'Le champ Téléphone est obligatoire.',
                'email' => 'Le champ Email est obligatoire.',
                'message' => 'Le champ Message est obligatoire.',
            ]);

        Notification::assertNothingSent();
    }
}
