<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Outlets;
use App\Models\Products;
use App\Models\TransactionsProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = TransactionsProducts::where('outlet_id', $user->outlet_id)->paginate(10);

        $products = Products::all()->where('outlet_id', $user->outlet_id);
        $isAdmin = $user->role_id == 1;
        $isPIC = $user->role_id == 2;
        $isStaff = $user->role_id == 3;

        return view('dashboard.transaction.index', compact('transactions', 'products', 'isAdmin', 'isPIC', 'isStaff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'transactions_type' => 'required|in:masuk,keluar,retur,waste',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $products = Products::find($validated['product_id']);
        $nameProduct = $products->product_name ?? 'Produk Tidak Diketahui';

        if ($validated['transactions_type'] == 'masuk') {
            $products->stock += $validated['quantity'];
        } elseif ($validated['transactions_type'] == 'keluar') {
            if ($products->stock < $validated['quantity']) {
                return redirect()->back()->with('toast_error', 'Produk "' . $nameProduct . '" gagal ditambahkan karena quantity melebihi stok produk.');
            }
            $products->stock -= $validated['quantity'];
        } elseif ($validated['transactions_type'] == 'retur') {
            $products->stock += $validated['quantity'];
        } elseif ($validated['transactions_type'] == 'waste') {
            $products->stock -= $validated['quantity'];
        }

        $products->save();

        TransactionsProducts::create([
            'product_id' => $validated['product_id'],
            'outlet_id' => Auth::user()->outlet_id,
            'transactions_type' => $validated['transactions_type'],
            'quantity' => $validated['quantity'],
            'date' => $validated['date'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('toast_success', 'Transaksi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'transactions_type' => 'required|in:masuk,keluar,retur,waste',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $transaction = TransactionsProducts::findOrFail($id);
        $product = Products::findOrFail($validated['product_id']);

        $log = [
            'quantity' => $validated['quantity'],
            'quantity product' => $product->stock,
        ];

        // dd($log);

        // if ($transaction->transactions_type === 'masuk' || $transaction->transactions_type === 'retur') {
        //     $product->stock -= $transaction->quantity;
        // } elseif ($transaction->transactions_type === 'keluar' || $transaction->transactions_type === 'waste') {
        //     $product->stock += $transaction->quantity;
        // }
        
        if ($validated['transactions_type'] === 'masuk' || $validated['transactions_type'] === 'retur') {
            if ($transaction->transactions_type !== 'masuk' && $transaction->transactions_type !== 'retur') {
                $product->stock += $validated['quantity'];
            }
        } elseif ($validated['transactions_type'] === 'keluar') {
            if ($transaction->transactions_type !== 'keluar' && $transaction->transactions_type !== 'waste') {
                if ($product->stock < $validated['quantity']) {
                    return redirect()->back()->with('toast_error', 'Stok tidak cukup untuk transaksi keluar.');
                }
                $product->stock -= $validated['quantity'];
            }
        } elseif ($validated['transactions_type'] === 'waste') {
            if ($transaction->transactions_type !== 'waste') {
                $product->stock -= $validated['quantity'];
            }
        }

        $product->save();

        $transaction->update([
            'product_id' => $validated['product_id'],
            'transactions_type' => $validated['transactions_type'],
            'quantity' => $validated['quantity'],
            'date' => $validated['date'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('toast_success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaction = TransactionsProducts::findOrFail($id);
        $product = Products::findOrFail($transaction->product_id);

        if ($transaction->transactions_type === 'masuk' || $transaction->transactions_type === 'retur') {
            $product->stock -= $transaction->quantity;
        } elseif ($transaction->transactions_type === 'keluar' || $transaction->transactions_type === 'waste') {
            $product->stock += $transaction->quantity;
        }

        $product->save();
        $transaction->delete();

        return redirect()->back()->with('toast_success', 'Transaksi berhasil dihapus.');
    }
}
