<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\DonationService;
use App\Repositories\DonationRepository;
use Carbon\Carbon;
use App\Models\Donation;

class WidgetTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_widget_returs_correct_values(): void
    {
        Donation::factory()->create([
            'amount' => 100,
            'email' => 'test1@test.com',
            'date' => Carbon::now()->subDays(10),
        ]);

        Donation::factory()->create([
            'amount' => 200,
            'email' => 'test2@test.com',
            'date' => Carbon::now()->subMonth(),
        ]);

        Donation::factory()->create([
            'amount' => 300,
            'email' => 'test3@test.com',
            'date' => Carbon::now()->subDays(5),
        ]);

        $donationRepo = new DonationRepository();
        $donationService = new DonationService($donationRepo);
        $results = $donationService->getWidget();

        $this->assertEquals([
            [
                'title' => 'Top Donator',
                'amount' => 300,
                'email' => 'test3@test.com',
            ],
            [
                'title' => 'Last Month Amount',
                'amount' => 200,
                'email' => '',
            ],
            [
                'title' => 'All Time Amount',
                'amount' => 600,
                'email' => '',
            ],
        ], $results);
    }
}
