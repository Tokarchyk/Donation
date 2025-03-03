<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Services\DonationService;
use Carbon\Carbon;
use App\Jobs\DeleteOldDonation;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function index(Request $request)
    {
        $query = Donation::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('donator_name', 'LIKE', "%{$search}%");
        }

        $sortColumn = $request->input('sortBy', 'donator_name');
        if (!in_array($sortColumn, ['id', 'donator_name', 'email', 'amount', 'message', 'date'])) {
            $sortColumn = 'donator_name';
        }

        $sortOrder = $request->input('sortOrder', 'asc');
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }
        $query->orderBy($sortColumn, $sortOrder);
        $donations = $query->paginate(10);
        $results = $this->donationService->getWidget();

        return response()->json($donations);
    }

    public function getWidgetData()
    {
        $results = $this->donationService->getWidget();

        return response()->json($results);
    }

    public function destroy(int $id)
    {
        $donation = Donation::find($id);
        $donation->delete();
        return response()->json([
            "status" => true
        ], 204);
    }

    public function store(DonationRequest $request)
    {
        $donation = Donation::create([
            'donator_name' => $request->input('donator_name'),
            'email' => $request->input('email'),
            'amount' => $request->input('amount'),
            'message' => $request->input('message') ?? '',
            'date' => Carbon::now()->format('Y-m-d'),
        ]);
        return response()->json([
            'message' => 'Donation saved successfully',
            'data' => $donation
        ]);
    }

    public function deleteOldDonations(Request $request)
    {
        $targetDate = $request->input('date');

        DeleteOldDonation::dispatch($targetDate);

        return response()->json(['message' => 'Deletion job successfuly delete']);
    }
}
