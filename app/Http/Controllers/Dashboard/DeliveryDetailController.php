<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Models\DeliveryDetail;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeliveryDetailController extends Controller
{
    public function index($id)
    {
        $detailDeliveries = DeliveryDetail::where('delivery_id', $id)->paginate(10);
        $delivery = Delivery::findOrFail($id);
        $products = Products::all();
        $user = Auth::user();

        $isFromOutletId = $delivery->from_outlet_id == $user->outlet_id;
        $isAdmin = $user->role_id == 1;
        $isPIC = $user->role_id == 2;
        $isStaff = $user->role_id == 3;

        return view ('dashboard.delivery_detail.index', compact('detailDeliveries', 'delivery', 'products', 'isFromOutletId', 'isAdmin', 'isPIC', 'isStaff'));
    }

    public function store()
    {
        $validated = request()->validate([
            'delivery_id' => 'required|exists:deliveries,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Products::find($validated['product_id']);
        $nameProduct = $product->product_name ?? 'Produk Tidak Diketahui';

        $existing = DeliveryDetail::where('delivery_id', $validated['delivery_id'])
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('toast_error', 'Produk "' . $nameProduct . '" sudah pernah ditambahkan ke pengiriman ini.');
        }

        if ($validated['quantity'] > $product->stock) {
            return redirect()->back()->with('toast_error', 'Produk "' . $nameProduct . '" gagal ditambahkan karena quantity melebihi stok produk.');
        }

        $product->stock -= $validated['quantity'];
        $product->save();

        DeliveryDetail::create($validated);

        return redirect()->back()->with('toast_success', 'Barang "' . $nameProduct . '" berhasil ditambahkan ke pengiriman.');
    }

    public function update($id)
    {
        $validated = request()->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $detail = DeliveryDetail::findOrFail($id);
        $product = Products::find($detail->product_id);

        if ($validated['quantity'] > $product->stock + $detail->quantity) {
            return redirect()->back()->with('toast_error', 'Gagal memperbarui quantity karena melebihi stok produk.');
        }

        $product->stock += $detail->quantity;
        $product->stock -= $validated['quantity'];
        $product->save();

        $detail->update($validated);

        return redirect()->back()->with('toast_success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detail = DeliveryDetail::findOrFail($id);
        $product = Products::find($detail->product_id);

        if ($product) {
            $product->stock += $detail->quantity;
            $product->save();
        }

        $detail->delete();

        return redirect()->back()->with('toast_success', 'Barang berhasil dihapus dari pengiriman.');
    }
}
