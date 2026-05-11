<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodInventory;

class BloodInventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $inventory = BloodInventory::all();
        return view('admin.inventory.index', compact('inventory'));
    }

    public function edit(BloodInventory $bloodInventory)
    {
        return view('admin.inventory.edit', compact('bloodInventory'));
    }

    public function update(Request $request, BloodInventory $bloodInventory)
    {
        $request->validate([
            'units_available' => 'required|integer|min:0',
            'units_reserved'  => 'required|integer|min:0',
        ]);

        $bloodInventory->update([
            'units_available' => $request->units_available,
            'units_reserved'  => $request->units_reserved,
            'last_updated'    => now(),
        ]);

        return redirect()->route('admin.inventory')->with('success', 'Inventory updated successfully.');
    }
}
