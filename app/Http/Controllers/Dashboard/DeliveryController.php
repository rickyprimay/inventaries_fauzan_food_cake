<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Outlets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Delivery::query()
            ->where('from_outlet_id', $user->outlet_id);

        if ($request->has('send_status') && $request->send_status != '') {
            $query->where('send_status', $request->send_status);
        }

        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('send_date', $request->sort);
        } else {
            $query->latest('send_date');
        }

        $deliveries = $query->paginate(10);
        $outlets = Outlets::where('id', '!=', Auth::user()->outlet_id)->get();
        $isAdmin = $user->role_id == 1;
        $isPIC = $user->role_id == 2;
        $isStaff = $user->role_id == 3;

        return view('dashboard.delivery.index', compact('deliveries', 'outlets', 'isAdmin', 'isPIC', 'isStaff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'to_outlet_id' => 'required|exists:outlets,id|different:from_outlet_id',
            'send_date' => 'required|date',
            'send_status' => 'required|in:pending,dikirim,diterima',
        ]);

        if (Auth::user()->outlet_id == $request->to_outlet_id) {
            return redirect()->back()->with('toast_error', 'Outlet pengirim dan penerima tidak boleh sama.');
        }

        Delivery::create([
            'from_outlet_id' => Auth::user()->outlet_id,
            'to_outlet_id' => $request->to_outlet_id,
            'send_date' => $request->send_date,
            'send_status' => $request->send_status,
        ]);

        return redirect()->back()->with('toast_success', 'Pengiriman berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'to_outlet_id' => 'required|exists:outlets,id|different:from_outlet_id',
            'send_date' => 'required|date',
            'send_status' => 'required|in:pending,dikirim,diterima',
        ]);

        $delivery = Delivery::where('id', $id)
            ->where('from_outlet_id', Auth::user()->outlet_id)
            ->firstOrFail();

        if (Auth::user()->outlet_id == $request->to_outlet_id) {
            return redirect()->back()->with('toast_error', 'Outlet pengirim dan penerima tidak boleh sama.');
        }

        $delivery->update([
            'to_outlet_id' => $request->to_outlet_id,
            'send_date' => $request->send_date,
            'send_status' => $request->send_status,
        ]);

        return redirect()->back()->with('toast_success', 'Pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $delivery = Delivery::where('id', $id)
            ->where('from_outlet_id', Auth::user()->outlet_id)
            ->firstOrFail();

        $delivery->delete();

        return redirect()->back()->with('toast_success', 'Pengiriman berhasil dihapus.');
    }
}
