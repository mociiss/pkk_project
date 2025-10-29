<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;

class ProductController extends Controller
{
    public function index(Request $request){
        $query = Product::with('kategori');

        if($request->filled('kategori_id')){
            $query->where('kategori_id', $request->kategori_id);
        }

        $produk =  $query->get();

        if($request->ajax()){
            return view('produk.table', compact('produk'))->render();
        }

        $kategori = Kategori::all();
        return view('produk.index', compact('produk', 'kategori'));
    }

    public function create(){
        $produk = Product::orderBy('nama_produk')->get();
        $kategori = Kategori::orderBy('nama_kategori')->get();
        return view('produk.create', compact('kategori', 'produk'));
    }

    public function store(Request $request){
        $request->validate([
            'nama_produk' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2848',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        $data = $request->except('gambar');
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['gambar'] = $filename;
        }

        Product::create($data);

        return redirect()->route('produk.index')->with('success','Produk berhasil ditambahkan!');
    }

    public function edit($id){
        $produk = Product::findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori')->get();
        return view('produk.edit', compact('produk','kategori'));
    }

    public function update(Request $request, $id){
        $produk = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2848',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'stok' => 'required',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        $data = $request->except('gambar');

        if($request->hasFile('gambar')){
            if($produk->gambar && file_exists(public_path('images/'. $produk->gambar))){
                unlink(public_path('images/' . $produk->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['gambar'] = $filename;
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success','Produk berhasil diperbaharui.');
    }

    public function destroy($id){
        $produk = Product::findOrfail($id);

        if($produk->gambar && file_exists(public_path('Gambar/'. $produk->gambar))){
                unlink(public_path('images/' . $produk->gambar));
            }

            $produk->delete();

            return redirect()->route('produk.index')->with('success','Produk berhasil dihapus.');
    }
}
