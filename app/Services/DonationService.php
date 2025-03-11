<?php

namespace App\Services;

use App\Models\Donation;
use Carbon\Carbon;
use App\Repositories\DonationRepository;

class DonationService
{
    public function __construct(DonationRepository $donationRepo)
    {
        $this->donationRepo = $donationRepo;
    }

    public function getWidget()
    {
        $topDonation = $this->donationRepo->getTopDonation();

        $totalAmountDonation = Donation::sum('amount');

        $lastMonthAmount = Donation::whereBetween(
            'date',
            [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ]
        )->get()
        ->sum('amount');

            $values = [
                [
                    'title' => 'Top Donator',
                    'amount' => $topDonation['amount'] ?? 0,
                    'email' => $topDonation['email'] ?? 'N/A',
                ],
                [
                    'title' => 'Last Month Amount',
                    'amount' => $lastMonthAmount,
                    'email' => ''
                ],
                [
                    'title' => 'All Time Amount',
                    'amount' => $totalAmountDonation,
                    'email' => ''
                ],
            ];
            return $values;
    }
}
