<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_can_be_submitted_without_email(): void
    {
        $response = $this->postJson(route('api.contact.store'), [
            'first_name' => 'Budi',
            'last_name' => 'Santoso',
            'phone' => '+628123456789',
            'service_type' => 'Kitchen Set Custom',
            'message' => 'Saya ingin konsultasi kitchen set.',
        ]);

        $response
            ->assertCreated()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('contact_submissions', [
            'first_name' => 'Budi',
            'last_name' => 'Santoso',
            'email' => null,
            'phone' => '+628123456789',
            'service_type' => 'Kitchen Set Custom',
            'message' => 'Saya ingin konsultasi kitchen set.',
            'is_read' => false,
        ]);
    }

    public function test_contact_form_requires_name_phone_and_message(): void
    {
        $this->postJson(route('api.contact.store'), [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'first_name',
                'phone',
                'message',
            ]);
    }
}
