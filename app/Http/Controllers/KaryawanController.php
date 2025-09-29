<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index(){
        $karyawan = Karyawan::all();
        return view('karyawan.index' , compact('karyawan'));
    }

    public function create(){
        $karyawan = Karyawan::orderBy('nama')->get();
        return view('karyawan.create' , compact('karyawan'));
    }

    public function store(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        Karyawan::create($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil ditambahkan.');
    }

    public function edit($id){
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id){
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        Karyawan::update($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil di update!');
    }

    public function destroy($id){
        $karyawan = Karyawan::findOrFail($id);

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil di hapus.');
    }
}
