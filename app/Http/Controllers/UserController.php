<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::all();

        return view('users')->with([
            "users" => $users,
        ]);
    }

    public function show(int $id)
    {
        $user = User::with('donations')->findOrFail($id);

        $userAmountDonations = User::withSum('donations', 'amount')->findOrFail($id);

        return view('info', compact('user', 'userAmountDonations'));
    }

    public function impersonate(int $id)
    {
        $user = User::findOrFail($id);

        session(['impersonate_admin' => Auth::id()]);

        Auth::login($user);

        return redirect('/donations')->with('message', "You are now impersonating {$user->name}");
    }
}
