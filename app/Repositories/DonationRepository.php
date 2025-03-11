<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Services\DonationService;

class DonationRepository
{
    public function getTopDonation()
    {
        $topDonation = Donation::orderByDesc('amount')->first();

        return $topDonation;
    }
}
