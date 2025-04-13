<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Divisions;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Divisions::paginate(10);
        return view('dashboard.divisions.index', compact('divisions'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'division_name' => 'max:255',
        ]);


        Divisions::create([
            'division_name' => $request->division_name,
        ]);

        return redirect()->back()->with('toast_success', 'Divisi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'division_name' => 'required|string|max:255',
        ]);

        $division = Divisions::findOrFail($id);
        $division->update([
            'division_name' => $request->division_name,
        ]);

        return redirect()->back()->with('toast_success', 'Divisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $division = Divisions::findOrFail($id);
        $division->delete();

        return redirect()->back()->with('toast_success', 'Divisi berhasil dihapus.');
    }
}
