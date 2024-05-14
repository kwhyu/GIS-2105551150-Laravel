<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Marker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //jika pakai eloquent
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DataController extends Controller
{
    // Fungsi untuk menampilkan semua pengguna
    public function getData()
    {
        $data = Data::orderBy('id_rs', 'desc')->get();
        return view('/index')->with('data', $data);
    }

    public function getMarker()
    {
        $markers = Data::select('id_rs', 'nama_rs','latlng_rs', 'tipe_rs')->get();
        return response()->json($markers);
        // $markers = Marker::select('latlng_rs')->get();
        // return response()->json($markers);
    }

    // Fungsi untuk menampilkan formulir tambah pengguna
    public function create()
    {

    }

    // Fungsi untuk menyimpan pengguna baru
    public function storeData(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama_rs' => 'required',
            'latlng_rs' => 'required',
            'tipe_rs' => 'required',
            'gambar_rs' => 'required|image',
            'alamat_rs' => 'required',

            // Sesuaikan dengan nama-nama field yang ada pada tabel
        ]);

        $gambar = file_get_contents($request->file('gambar_rs')->getRealPath());

        // Memasukkan data ke dalam database
        $data = Data::create([
            'nama_rs' => $validatedData['nama_rs'],
            'latlng_rs' => $validatedData['latlng_rs'],
            'tipe_rs' => $validatedData['tipe_rs'],
            'gambar_rs' => $gambar,
            // 'gambar_rs' => $validatedData['gambar_rs'],
            'alamat_rs' => $validatedData['alamat_rs'],
            // Sesuaikan dengan nama-nama field yang ada pada tabel
        ]);

        // Jika data berhasil dimasukkan, Anda dapat menangani respons di sini
        return redirect('/index')->with('success', 'Data rumah sakit berhasil disimpan.');
        // return view('index');
    }

    // Fungsi untuk menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        // Logika untuk menampilkan detail pengguna
    }
    // Fungsi untuk menampilkan formulir edit pengguna berdasarkan ID
    public function edit($id_rs)
    {
        $data = Data::findOrFail($id_rs);
        return view('editRS', compact('data'));
    }    

    public function update(Request $request, $id_rs)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama_rs' => 'sometimes|string',
            'latlng_rs' => 'sometimes|string',
            'tipe_rs' => 'sometimes|string',
            'alamat_rs' => 'sometimes|string',
            'gambar_rs' => 'sometimes|image',
        ]);

        // Temukan data yang ingin diperbarui
        $data = Data::findOrFail($id_rs);

        // Mengambil data yang diperlukan dari formulir
        if ($request->has('nama_rs')) {
            $data->nama_rs = $request->input('nama_rs');
        }
        if ($request->has('latlng_rs')) {
            $data->latlng_rs = $request->input('latlng_rs');
        }
        if ($request->has('tipe_rs')) {
            $data->tipe_rs = $request->input('tipe_rs');
        }
        if ($request->has('alamat_rs')) {
            $data->alamat_rs = $request->input('alamat_rs');
        }

        // Jika ada gambar yang diunggah, simpan ke dalam tipe data blob image
        if ($request->hasFile('gambar_rs')) {
            $image = $request->file('gambar_rs');
            $imageData = file_get_contents($image->getRealPath());
            $data->gambar_rs = $imageData;
        }

        // Perbarui data
        $data->save();

        return redirect('/index')->with('success', 'Data berhasil diperbarui.');
    }
    
    
    // Fungsi untuk memperbarui pengguna berdasarkan ID 
    // public function update(Request $request, $id_rs)
    // {
    //     $data = Data::findOrFail($id_rs);
    //     $data->update($request->all());

    //     return redirect('/index')->with('success', 'Data berhasil diperbarui.');
    // }

    // Fungsi untuk menghapus pengguna berdasarkan ID
    public function destroy($id_rs): RedirectResponse
    {
        Data::where('id_rs', $id_rs)->delete();
        return redirect('/index')->with('success', 'Data berhasil dihapus.');
    }
}