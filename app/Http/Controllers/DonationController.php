<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use Illuminate\View\View;
use App\Models\Donation;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index(): View
    {
        $donations = Donation::paginate(10);

        $resultsDate = Donation::all()
        ->sortBy('date');

        $chartData = $resultsDate
        ->groupBy(function ($result, $key) {
            return \Carbon\Carbon::parse($result->date)->format('y-M-d');
        })
        ->map(function ($result) {
            return ($result->sum('amount'));
        });

        foreach ($chartData as $date => $totalAmount) {
            $newArray[] = [$date, $totalAmount];
        }

        $chartDataAmount = [
            ['Year', 'Amount'],
            ...$newArray,
        ];

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

        $values = [
            [
                'title' => 'Top Donator',
                'amount' => $topDonation['amount'],
                'email' => $topDonation['email'],
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

        return view('dashboard')->with([
            "donations" => $donations,
            "topDonation" => $topDonation,
            "totalAmountDonation" => $totalAmountDonation,
            "totalSum" => $lastMonthAmount,
            "values" => $values,
            "chartData" => $chartDataAmount,
        ]);
    }

    public function show(): View
    {
        return view('donation-form');
    }

    public function store(DonationRequest $request)
    {
        $donation = new Donation();
        $donation->donator_name = $request->input('donator_name');
        $donation->email = $request->input('email');
        $donation->amount = $request->input('amount');
        $donation->message = $request->input('message');
        $donation->date = Carbon::now()->format('Y-m-d');
        $donation->save();
        return redirect('/donation');
    }
}
