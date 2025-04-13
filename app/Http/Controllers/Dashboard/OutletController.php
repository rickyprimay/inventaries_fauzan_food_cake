<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Outlets;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlets::paginate(10);
        return view('dashboard.outlet.index', compact('outlets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'outlet_name' => 'required|string|max:255',
            'outlet_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'is_central_kitchen' => 'required|boolean',
        ]);

        Outlets::create([
            'outlet_name' => $request->outlet_name,
            'outlet_address' => $request->outlet_address,
            'city' => $request->city,
            'is_central_kitchen' => $request->is_central_kitchen,
        ]);

        return redirect()->back()->with('toast_success', 'Outlet berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'outlet_name' => 'required|string|max:255',
            'outlet_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'is_central_kitchen' => 'required|boolean',
        ]);

        $outlet = Outlets::findOrFail($id);
        $outlet->update([
            'outlet_name' => $request->outlet_name,
            'outlet_address' => $request->outlet_address,
            'city' => $request->city,
            'is_central_kitchen' => $request->is_central_kitchen,
        ]);

        return redirect()->back()->with('toast_success', 'Outlet berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $outlet = Outlets::findOrFail($id);
        $outlet->delete();

        return redirect()->back()->with('toast_success', 'Outlet berhasil dihapus.');
    }
}
