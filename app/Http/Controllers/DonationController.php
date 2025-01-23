<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use Illuminate\View\View;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(DonationRequest $request)
    {
        Donation::create([
            'donator_name' => $request->input('donator_name'),
            'email' => $request->input('email'),
            'amount' => $request->input('amount'),
            'message' => $request->input('message'),
            'date' => Carbon::now()->format('Y-m-d'),
        ]);
        return redirect('/donation'); 
    }

    public function destroy(int $id)
    {
        Donation::findOrFail($id)->delete();

        return redirect()->route('donation.index')->with('message', 'Record deleted successfully');
    }

    public function index(Request $request): View
    {
        $sortedDirection = $request->input('sort', 'asc');
        if (! in_array($sortedDirection, ['asc', 'desc'])) {
            $sortedDirection = 'desc';
        }

        $sortedColumn = $request->input('column', 'date');
        if (! in_array($sortedColumn, ['id', 'donator_name', 'email', 'amount', 'message', 'date'])) {
            $sortedColumn = 'donator_name';
        }

        $donations = Donation::where(
            'donator_name',
            'LIKE',
            '%' . $request->input('search') . '%',
        )
        ->orderBy($sortedColumn, $sortedDirection)
        ->paginate(10);

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
            "sortDirection" => $sortedDirection,
            "sortColumn" => $sortedColumn,
        ]);
    }
}
