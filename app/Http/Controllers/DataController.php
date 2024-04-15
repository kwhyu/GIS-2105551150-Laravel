<?php

namespace App\Http\Controllers;

use App\Models\Data;
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
        return view('index', compact('data'));
    }

    public function getMarker()
    {
        $latLngs = Data::pluck('latlng_rs');
        $markers = [];

        $markers = $latLngs->map(function ($latLng) {
        });
        Log::info($markers);
        return response()->json($markers);
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
            'gambar_rs' => 'required',
            'alamat_rs' => 'required',

            // Sesuaikan dengan nama-nama field yang ada pada tabel
        ]);

        // Memasukkan data ke dalam database
        $data = Data::create([
            'nama_rs' => $validatedData['nama_rs'],
            'latlng_rs' => $validatedData['latlng_rs'],
            'tipe_rs' => $validatedData['tipe_rs'],
            'gambar_rs' => $validatedData['gambar_rs'],
            'alamat_rs' => $validatedData['alamat_rs'],

            // Sesuaikan dengan nama-nama field yang ada pada tabel
        ]);

        // Jika data berhasil dimasukkan, Anda dapat menangani respons di sini
        return redirect('/')->with('success', 'Data rumah sakit berhasil disimpan.');
        // return view('index');
    }

    // Fungsi untuk menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        // Logika untuk menampilkan detail pengguna
    }
// Fungsi untuk menampilkan formulir edit pengguna berdasarkan ID
    public function edit($id)
    {
        // Logika untuk menampilkan formulir edit pengguna
    }

    // Fungsi untuk memperbarui pengguna berdasarkan ID
    public function update(Request $request, $id)
    {
        // Logika untuk memperbarui pengguna
    }

    // Fungsi untuk menghapus pengguna berdasarkan ID
    public function destroy($id)
    {
        // Logika untuk menghapus pengguna
    }
}