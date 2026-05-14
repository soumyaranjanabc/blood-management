<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\BloodInventory;
use App\Models\BloodRequest;

class DonorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:donor']);
    }

    // public function dashboard()
    // {
    //     $user      = auth()->user();
    //     $donor     = Donor::where('user_id', $user->id)->first();
    //     $inventory = BloodInventory::all();
    //     $myRequests = BloodRequest::where('user_id', $user->id)->latest()->take(5)->get();

    //     return view('donor.dashboard', compact('user', 'donor', 'inventory', 'myRequests'));
    // }
    public function dashboard()
    {
    $user       = auth()->user();
    $donor      = Donor::where('user_id', $user->id)->first();
    $inventory  = BloodInventory::all();
    $myDonations = \App\Models\Donation::where('user_id', $user->id)
                    ->latest()->take(5)->get();

    return view('donor.dashboard', compact('user', 'donor', 'inventory', 'myDonations'));
    }
    public function profile()
    {
        $user  = auth()->user();
        $donor = Donor::where('user_id', $user->id)->first();
        return view('donor.profile', compact('user', 'donor'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'blood_group'        => 'required|string|max:5',
            'age'                => 'required|integer|min:18|max:65',
            'gender'             => 'required|in:male,female,other',
            'phone'              => 'required|string|max:20',
            'address'            => 'required|string',
            'city'               => 'required|string|max:100',
            'last_donation_date' => 'nullable|date',
        ]);

        $user = auth()->user();

        Donor::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name'               => $request->name,
                'blood_group'        => $request->blood_group,
                'age'                => $request->age,
                'gender'             => $request->gender,
                'phone'              => $request->phone,
                'address'            => $request->address,
                'city'               => $request->city,
                'last_donation_date' => $request->last_donation_date,
                'status'             => 'active',
            ]
        );

        $user->update([
            'phone'       => $request->phone,
            'blood_group' => $request->blood_group,
        ]);

        return redirect()->route('donor.profile')->with('success', 'Profile updated successfully.');
    }

    public function inventory()
    {
        $inventory = BloodInventory::all();
        return view('donor.inventory', compact('inventory'));
    }

    public function myRequests()
    {
        $requests = BloodRequest::where('user_id', auth()->id())->latest()->paginate(10);
        return view('donor.requests', compact('requests'));
    }

    public function createRequest()
    {
        return view('donor.create-request');
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'patient_name'   => 'required|string|max:255',
            'blood_group'    => 'required|string|max:5',
            'units_required' => 'required|integer|min:1|max:20',
            'priority'       => 'required|in:normal,urgent,critical',
            'hospital_name'  => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'required_date'  => 'required|date|after_or_equal:today',
            'notes'          => 'nullable|string',
        ]);

        BloodRequest::create([
            'user_id'        => auth()->id(),
            'patient_name'   => $request->patient_name,
            'blood_group'    => $request->blood_group,
            'units_required' => $request->units_required,
            'priority'       => $request->priority,
            'hospital_name'  => $request->hospital_name,
            'contact_number' => $request->contact_number,
            'required_date'  => $request->required_date,
            'notes'          => $request->notes,
            'status'         => 'pending',
        ]);

        return redirect()->route('donor.requests')->with('success', 'Blood request submitted successfully.');
    }
}
