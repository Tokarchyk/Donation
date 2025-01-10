<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index(): View
    {
        $donations = Donation::paginate(10);

        return view('dashboard', compact("donations"));
    }
}
