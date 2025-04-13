<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\DeliveryDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiveDeliveryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $sort = request('sort', 'desc'); 

        $query = Delivery::query()
            ->where('to_outlet_id', $user->outlet_id)
            ->orderBy('send_date', $sort); 

        $deliveries = $query->paginate(10)->appends(['sort' => $sort]);

        return view('dashboard.receive.index', compact('deliveries'));
    }


    public function updateStatusToReceived($id)
    {
        $delivery = Delivery::findOrFail($id);

        if ($delivery->to_outlet_id != Auth::user()->outlet_id) {
            return redirect()->back()->with('toast_error', 'Anda tidak memiliki akses untuk mengubah status pengiriman ini.');
        }

        $delivery->update([
            'send_status' => 'diterima',
        ]);

        $deliveryDetails = DeliveryDetail::where('delivery_id', $delivery->id)->get();

        foreach ($deliveryDetails as $detail) {
            $originalProduct = Products::find($detail->product_id);

            if (!$originalProduct) continue;

            $existingProduct = Products::where('product_name', $originalProduct->product_name)
                ->where('outlet_id', $delivery->to_outlet_id)
                ->first();

            if ($existingProduct) {
                $existingProduct->stock += $detail->quantity;
                $existingProduct->save();
            } else {
                Products::create([
                    'product_name' => $originalProduct->product_name,
                    'date_input' => now(),
                    'id_category' => $originalProduct->id_category,
                    'unit' => $originalProduct->unit,
                    'stock' => $detail->quantity,
                    'price' => $originalProduct->price,
                    'description' => $originalProduct->description,
                    'outlet_id' => $delivery->to_outlet_id,
                ]);
            }
        }

        return redirect()->back()->with('toast_success', 'Pengiriman berhasil diterima dan produk ditambahkan ke outlet.');
    }
}
