<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // harus disesuaikan dengan name yang ada di form.
            'nama_kategori' => 'required|string|min:3|max:20',
        ]);

        // buat array untuk data yang ingin disimpan
        $data_simpan = [
            'name' => $request->input('nama_kategori'),
            'uuid' => Str::orderedUuid()
        ];

        // simpan data array data_simpan ke database
        Category::create($data_simpan);
        return redirect()->route('category.index')->with('success', 'Kategori berhasil disimpan');
    }

    public function show($param)
    {
        // find digunakan untuk mencari ID
        $category = Category::where('uuid', $param)->firstOrFail();
        return view('category.show', compact('category'));
    }

    public function update(Request $request, $param)
    {
        // cari data mana yang mau diedit
        $data = Category::findOrFail($param);

        $request->validate([
            // harus disesuaikan dengan name yang ada di form.
            'nama_kategori' => 'required|string|min:3|max:20',
        ]);

        // buat array untuk data yang ingin disimpan
        $data_simpan = [
            'name' => $request->input('nama_kategori'),
            'uuid' => Str::orderedUuid()
        ];

        // simpan data array data_simpan ke database
        $data->update($data_simpan);
        return redirect()->route('category.show', $data->uuid)->with('success', 'Kategori berhasil diubah');
    }
}
