<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Notifications\ContactRequestNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_send_not_found_on_non_existing_property(): void
    {
        $response = $this->get('/biens/mauvais-slug-999999');

        $response->assertNotFound();
    }

    public function test_redirect_on_bad_slug_property(): void
    {
        /** @var Property $property */
        $property = Property::factory()->create();

        $response = $this->get('/biens/mauvais-slug-'.$property->id);

        $response->assertRedirectToRoute('property.show', ['property' => $property->id, 'slug' => $property->getSlug()]);
    }

    public function test_ok_on_property(): void
    {
        /** @var Property $property */
        $property = Property::factory()->create();

        $response = $this->get("/biens/{$property->getSlug()}-{$property->id}");

        $response->assertOk();
        $response->assertSee($property->title);
    }

    public function test_error_on_contact(): void
    {
        /** @var Property $property */
        $property = Property::factory()->create();
        $response = $this->post("/biens/{$property->id}/contact", [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'phone' => '0606060606',
            'email' => 'doe',
            'message' => 'Pouvez vous me recontacter ?',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);
        $response->assertSessionHasInput('email', 'doe');
    }

    public function test_ok_on_contact(): void
    {
        Notification::fake();
        /** @var Property $property */
        $property = Property::factory()->create();
        $response = $this->post("/biens/{$property->id}/contact", [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'phone' => '0606060606',
            'email' => 'doe@demo.com',
            'message' => 'Pouvez vous me recontacter ?',
        ]);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
        Notification::assertSentOnDemand(ContactRequestNotification::class);
    }
}
