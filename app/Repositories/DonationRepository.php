<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Services\DonationService;

class DonationRepository
{
    public function getTopDonations()
    {
        $topDonation = Donation::orderByDesc('amount')->first();

        return $topDonation;
    }
}
