<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}
