<?php

namespace App\Http\Controllers\Donation;

use App\Models\Donation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// class DonationTableController extends Controller
// {
//     /**
//      * Handle the incoming request.
//      */
//     public function __invoke(Request $request)
//     {
        
//         sleep(5);
//         $query = Donation::query();

//         if ($request->has('search')) {
//             $search = $request->input('search');
//             $query->where('donator_name', 'LIKE', "%{$search}%");
//         }

//         $sortColumn = $request->input('sortBy', 'donator_name');
//         if (! in_array($sortColumn, ['id', 'donator_name', 'email', 'amount', 'message', 'date'])) {
//                 $sortColumn = 'donator_name';
//         }

//         $sortOrder = $request->input('sortOrder', 'asc');
//         if (! in_array($sortOrder, ['asc', 'desc'])) {
//                 $sortOrder = 'desc';
//         }

//         $query->orderBy($sortColumn, $sortOrder);

//         $donations = $query->paginate(5);
//         return response()->json($donations);
//     }
// }
