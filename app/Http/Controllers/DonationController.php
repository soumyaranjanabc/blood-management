<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\BloodInventory;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ── Donor: show their donation history ─────────────────
    public function myDonations()
    {
        $this->middleware('role:donor');
        $donations = Donation::where('user_id', auth()->id())
                             ->latest()->paginate(10);
        return view('donor.donations', compact('donations'));
    }

    // ── Donor: show record donation form ───────────────────
    public function create()
    {
        $user  = auth()->user();
        $donor = Donor::where('user_id', $user->id)->first();

        if (!$donor) {
            return redirect()->route('donor.profile')
                ->with('error', 'Please complete your profile before recording a donation.');
        }

        return view('donor.record-donation', compact('user', 'donor'));
    }

    // ── Donor: store donation record ───────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'units_donated'  => 'required|integer|min:1|max:5',
            'donation_date'  => 'required|date|before_or_equal:today',
            'notes'          => 'nullable|string|max:500',
        ]);

        $user  = auth()->user();
        $donor = Donor::where('user_id', $user->id)->first();

        if (!$donor) {
            return redirect()->route('donor.profile')
                ->with('error', 'Please complete your profile first.');
        }

        Donation::create([
            'user_id'       => $user->id,
            'donor_id'      => $donor->id,
            'blood_group'   => $donor->blood_group,
            'units_donated' => $request->units_donated,
            'donation_date' => $request->donation_date,
            'status'        => 'pending',
            'notes'         => $request->notes,
        ]);

        return redirect()->route('donor.donations')
            ->with('success', 'Donation recorded! Waiting for admin verification.');
    }

    // ── Admin: list all donations ───────────────────────────
    public function adminIndex()
    {
        $donations = Donation::with(['user', 'donor'])->latest()->paginate(10);
        return view('admin.donations.index', compact('donations'));
    }

    // ── Admin: verify donation → add to inventory ──────────
    public function verify(Donation $donation)
    {
        if ($donation->status !== 'pending') {
            return redirect()->route('admin.donations')
                ->with('error', 'This donation has already been processed.');
        }

        // Add units to inventory
        $inventory = BloodInventory::where('blood_group', $donation->blood_group)->first();

        if ($inventory) {
            $inventory->increment('units_available', $donation->units_donated);
            $inventory->update(['last_updated' => now()]);
        } else {
            BloodInventory::create([
                'blood_group'     => $donation->blood_group,
                'units_available' => $donation->units_donated,
                'units_reserved'  => 0,
                'last_updated'    => now(),
            ]);
        }

        // Update donation status
        $donation->update(['status' => 'verified']);

        // Update donor's last donation date
        $donation->donor->update([
            'last_donation_date' => $donation->donation_date
        ]);

        return redirect()->route('admin.donations')
            ->with('success', "Donation verified! {$donation->units_donated} unit(s) of {$donation->blood_group} added to inventory.");
    }

    // ── Admin: reject donation ─────────────────────────────
    public function reject(Donation $donation)
    {
        $donation->update(['status' => 'rejected']);
        return redirect()->route('admin.donations')
            ->with('success', 'Donation record rejected.');
    }
}
