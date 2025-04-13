<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Products::with('category')
            ->where('outlet_id', $user->outlet_id)
            ->paginate(10);

        $categories = Categories::all();

        $isAdmin = $user->role_id == 1;
        $isPIC = $user->role_id == 2;
        $isStaff = $user->role_id == 3;

        return view('dashboard.product.index', compact('products', 'categories', 'isAdmin', 'isPIC', 'isStaff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'date_input' => 'required|date',
            'id_category' => 'required|exists:categories,id',
            'unit' => 'nullable|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'price' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Products::create([
            'product_name' => $request->product_name,
            'date_input' => $request->date_input,
            'id_category' => $request->id_category,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
            'outlet_id' => Auth::user()->outlet_id,
        ]);

        return redirect()->back()->with('toast_success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'date_input' => 'required|date',
            'id_category' => 'required|exists:categories,id',
            'unit' => 'nullable|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'price' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ]);


        $product = Products::where('id', $id)
            ->where('outlet_id', Auth::user()->outlet_id)
            ->firstOrFail();

        $product->update([
            'product_name' => $request->product_name,
            'date_input' => $request->date_input,
            'id_category' => $request->id_category,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('toast_success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Products::where('id', $id)
            ->where('outlet_id', Auth::user()->outlet_id)
            ->firstOrFail();

        $product->delete();

        return redirect()->back()->with('toast_success', 'Produk berhasil dihapus.');
    }

}
