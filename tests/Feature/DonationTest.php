<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DonationTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/donations');
        $response->assertStatus(200);
    }

    public function test_store(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('api/donations/store', [
            'donator_name' => 'Mortem',
            'email' => $user->email,
            'amount' => 2626,
            'message' => 'Testing test',
            'date' => Carbon::now()->format('Y-m-d'),
            'user_id' => $user->id,
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('donations', [
            'donator_name' => 'Mortem',
            'email' => $user->email,
            'amount' => 2626,
            'user_id' => $user->id,
        ]);
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();
        $donation = Donation::factory()->create();
        $this->actingAs($user);

        $response = $this->deleteJson('api/donations/' . $donation->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('donations', ['id' => $donation->id]);
    }
}
