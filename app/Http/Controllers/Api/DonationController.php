<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Services\DonationService;
use Carbon\Carbon;
use App\Jobs\DeleteOldDonation;

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
        try {
            $email = $request->input('email');
            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }

            $donation = Donation::create([
                'donator_name' => $request->input('donator_name'),
                'email' => $request->input('email'),
                'amount' => $request->input('amount'),
                'message' => $request->input('message') ?? '',
                'date' => Carbon::now()->format('Y-m-d'),
                'user_id' => $user->id,
            ]);

            return response()->json([
                'message' => 'Donation saved successfully',
                'data' => $donation
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to save donation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteOldDonations(Request $request)
    {
        $targetDate = $request->input('date');

        DeleteOldDonation::dispatch($targetDate);

        return response()->json(['message' => 'Deletion job successfuly delete']);
    }
}
