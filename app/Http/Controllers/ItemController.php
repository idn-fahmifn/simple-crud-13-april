<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $categories = Category::all();
        return view('item.index', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // harus disesuaikan dengan name yang ada di form.
            'nama_barang' => 'required|string|min:3|max:20',
            'kategori' => 'required|integer|exists:categories,id',
            'merk' => 'required|string|min:3|max:20',
            'stok' => 'required|integer|min:1|max:100',
            'gambar' => 'required|file|max:2048|mimes:png,jpg,jpeg,gif,svg',
            'deskripsi' => 'required',
        ]);

        // buat array untuk data yang ingin disimpan
        $data_simpan = [
            'item_name' => $request->input('nama_barang'),
            'uuid' => Str::orderedUuid(),
            'category_id' => $request->input('kategori'),
            'brand' => $request->input('merk'),
            'stock' => $request->input('stok'),
            'desc' => $request->input('deskripsi'),
        ];

        // jika ada gambar yang diupload
        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            $lokasi = 'public/images/items';
            $format = $gambar->extension();
            $nama = 'siinventaris_'.Carbon::now('Asia/Jakarta')
            ->format('YmdHis').random_int(000, 999).'.'.$format;
            $data_simpan['image'] = $nama;

            // simpan gambar ke lokasi yang sudah di define
            $gambar->storeAs($lokasi, $nama);
        }


        // simpan data array data_simpan ke database
        Item::create($data_simpan);
        return redirect()->route('item.index')->with('success', 'Barang berhasil disimpan');
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

    public function destroy($param)
    {
        $category = Category::findOrFail($param);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
