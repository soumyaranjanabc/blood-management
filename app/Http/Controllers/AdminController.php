<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donor;
use App\Models\Hospital;
use App\Models\BloodInventory;
use App\Models\BloodRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total_donors'      => Donor::count(),
            'total_hospitals'   => Hospital::count(),
            'total_requests'    => BloodRequest::count(),
            'pending_requests'  => BloodRequest::where('status', 'pending')->count(),
            'approved_requests' => BloodRequest::where('status', 'approved')->count(),
            'fulfilled_requests'=> BloodRequest::where('status', 'fulfilled')->count(),
            'total_users'       => User::count(),
        ];

        $inventory        = BloodInventory::all();
        $recentRequests   = BloodRequest::with('user')->latest()->take(5)->get();
        $recentDonors     = Donor::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'inventory', 'recentRequests', 'recentDonors'));
    }

    // ── Users ──────────────────────────────────────────────
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,'.$user->id,
            'role'        => 'required|in:admin,donor,hospital',
            'phone'       => 'nullable|string|max:20',
            'blood_group' => 'nullable|string|max:5',
        ]);

        $user->update($request->only('name','email','role','phone','blood_group','address'));
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // ── Donors ─────────────────────────────────────────────
    public function donors()
    {
        $donors = Donor::with('user')->latest()->paginate(10);
        return view('admin.donors.index', compact('donors'));
    }

    public function editDonor(Donor $donor)
    {
        return view('admin.donors.edit', compact('donor'));
    }

    public function updateDonor(Request $request, Donor $donor)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'blood_group' => 'required|string|max:5',
            'age'         => 'required|integer|min:18|max:65',
            'gender'      => 'required|in:male,female,other',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string',
            'city'        => 'required|string|max:100',
            'status'      => 'required|in:active,inactive',
        ]);

        $donor->update($request->all());
        return redirect()->route('admin.donors')->with('success', 'Donor updated successfully.');
    }

    public function destroyDonor(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('admin.donors')->with('success', 'Donor deleted successfully.');
    }

    // ── Blood Requests ─────────────────────────────────────
    public function requests()
    {
        $requests = BloodRequest::with('user')->latest()->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function approveRequest(BloodRequest $bloodRequest)
    {
        $inventory = BloodInventory::where('blood_group', $bloodRequest->blood_group)->first();

        if (!$inventory || $inventory->units_available < $bloodRequest->units_required) {
            return redirect()->route('admin.requests')
                ->with('error', 'Not enough inventory for this blood group.');
        }

        $bloodRequest->update(['status' => 'approved']);
        $inventory->decrement('units_available', $bloodRequest->units_required);
        $inventory->increment('units_reserved', $bloodRequest->units_required);
        $inventory->update(['last_updated' => now()]);

        return redirect()->route('admin.requests')->with('success', 'Request approved successfully.');
    }

    public function rejectRequest(BloodRequest $bloodRequest)
    {
        $bloodRequest->update(['status' => 'rejected']);
        return redirect()->route('admin.requests')->with('success', 'Request rejected.');
    }

    public function fulfillRequest(BloodRequest $bloodRequest)
    {
        $inventory = BloodInventory::where('blood_group', $bloodRequest->blood_group)->first();

        if ($inventory && $bloodRequest->status === 'approved') {
            $inventory->decrement('units_reserved', $bloodRequest->units_required);
            $inventory->update(['last_updated' => now()]);
        }

        $bloodRequest->update(['status' => 'fulfilled']);
        return redirect()->route('admin.requests')->with('success', 'Request marked as fulfilled.');
    }

    // ── Hospitals ──────────────────────────────────────────
    public function hospitals()
    {
        $hospitals = Hospital::with('user')->latest()->paginate(10);
        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function destroyHospital(Hospital $hospital)
    {
        $hospital->delete();
        return redirect()->route('admin.hospitals')->with('success', 'Hospital removed.');
    }
}
