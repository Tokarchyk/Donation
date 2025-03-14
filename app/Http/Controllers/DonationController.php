<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use Illuminate\View\View;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\DonationService;

class DonationController extends Controller
{
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function store(DonationRequest $request)
    {
        Donation::create([
            'donator_name' => $request->input('donator_name'),
            'email' => $request->input('email'),
            'amount' => $request->input('amount'),
            'message' => $request->input('message'),
            'date' => Carbon::now()->format('Y-m-d'),
        ]);
        return redirect()->route('donations.index');
    }

    public function edit(Donation $donation)
    {
        return view('edit', compact('donation'));
    }

    public function update(DonationRequest $request, int $id)
    {
        $donation = Donation::find($id);
        $input = $request->all();
        $donation->update($input);

        return redirect()->route('donations.index')->with('message', 'Record updated successfully');
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

        $results = $this->donationService->getWidget();

        return view('dashboard')->with([
            "donations" => $donations,
            "values" => $results,
            "chartData" => $chartDataAmount,
            "sortDirection" => $sortedDirection,
            "sortColumn" => $sortedColumn,
        ]);
    }
}
