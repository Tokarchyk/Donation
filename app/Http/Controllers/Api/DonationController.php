<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequest;
use App\Services\DonationService;

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
        if (! in_array($sortColumn, ['id', 'donator_name', 'email', 'amount', 'message', 'date'])) {
                $sortColumn = 'donator_name';
        }

        $sortOrder = $request->input('sortOrder', 'asc');
        if (! in_array($sortOrder, ['asc', 'desc'])) {
                $sortOrder = 'desc';
        }

        $query->orderBy($sortColumn, $sortOrder);

        $donations = $query->paginate(5);

        $results = $this->donationService->getWidget();

        return response()->json($donations);
    }

    public function getWidgetData()
    {
        sleep(3);
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
}
