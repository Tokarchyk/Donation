<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Donation;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index(): View
    {
        $donations = Donation::paginate(10);

        $topDonation = Donation::orderByDesc('amount')->first();

        $totalAmountDonation = Donation::sum('amount');

        $lastMonthAmount = Donation::whereBetween(
            'date',
            [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ]
        )->get()
        ->sum('amount');

        return view('dashboard')->with([
            "donations" => $donations,
            "topDonation" => $topDonation,
            "totalAmountDonation" => $totalAmountDonation,
            "totalSum" => $lastMonthAmount
        ]);
    }
}
