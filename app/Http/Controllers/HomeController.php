<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isDonor()) {
            return redirect()->route('donor.dashboard');
        } elseif ($user->isHospital()) {
            return redirect()->route('hospital.dashboard');
        }

        abort(403);
    }
}
