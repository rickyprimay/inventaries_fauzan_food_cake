<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ], [
            'category_name.required' => 'Nama kategori wajib diisi.',
            'category_name.unique' => 'Nama kategori sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('category')
                ->withErrors($validator)
                ->withInput()
                ->with('toast_error', 'Gagal menambahkan kategori.');
        }

        Categories::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('category')->with('toast_success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id,
        ], [
            'category_name.required' => 'Nama kategori wajib diisi.',
            'category_name.unique' => 'Nama kategori sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('category')
                ->withErrors($validator)
                ->withInput()
                ->with('toast_error', 'Gagal memperbarui kategori.');
        }

        $category = Categories::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('category')->with('toast_success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('category')->with('toast_success', 'Kategori berhasil dihapus.');
    }
}
