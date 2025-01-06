<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View{
        // create new comment for create new branch and commit
        return view('dashboard');
    }
}
