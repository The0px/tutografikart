<?php

namespace Tests\Feature\Admin;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PropertyAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_any_property(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $authenticated = Auth::user();

        $this->assertInstanceOf(User::class, $authenticated);
        $this->assertTrue($authenticated->can('viewAny', Property::class));
    }

    public function test_edit_authorizes_the_property(): void
    {
        $property = Property::factory()->create();

        $user = User::factory()->create();
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();

        $this->actingAs($user)
            ->get(route('admin.property.edit', $property))
            ->assertForbidden();

        $this->actingAs($admin)
            ->get(route('admin.property.edit', $property))
            ->assertOk();
    }
}
