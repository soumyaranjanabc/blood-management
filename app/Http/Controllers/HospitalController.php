<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\BloodInventory;
use App\Models\BloodRequest;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:hospital']);
    }

    public function dashboard()
    {
        $user      = auth()->user();
        $hospital  = Hospital::where('user_id', $user->id)->first();
        $inventory = BloodInventory::all();
        $myRequests = BloodRequest::where('user_id', $user->id)->latest()->take(5)->get();

        return view('hospital.dashboard', compact('user', 'hospital', 'inventory', 'myRequests'));
    }

    public function profile()
    {
        $user     = auth()->user();
        $hospital = Hospital::where('user_id', $user->id)->first();
        return view('hospital.profile', compact('user', 'hospital'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'license_number' => 'required|string|max:100',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string|max:100',
        ]);

        $user = auth()->user();

        Hospital::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name'           => $request->name,
                'license_number' => $request->license_number,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'city'           => $request->city,
                'status'         => 'active',
            ]
        );

        $user->update(['phone' => $request->phone]);

        return redirect()->route('hospital.profile')->with('success', 'Profile updated successfully.');
    }

    public function inventory()
    {
        $inventory = BloodInventory::all();
        return view('hospital.inventory', compact('inventory'));
    }

    public function myRequests()
    {
        $requests = BloodRequest::where('user_id', auth()->id())->latest()->paginate(10);
        return view('hospital.requests', compact('requests'));
    }

    public function createRequest()
    {
        return view('hospital.create-request');
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'patient_name'   => 'required|string|max:255',
            'blood_group'    => 'required|string|max:5',
            'units_required' => 'required|integer|min:1|max:50',
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

        return redirect()->route('hospital.requests')->with('success', 'Blood request submitted successfully.');
    }
}
