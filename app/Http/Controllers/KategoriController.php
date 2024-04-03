<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) // CRUD DATA IN DATABASE WITH QUERY BUILDER
    {
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now(),
        // ];
        // DB::table('m_kategori')->insert($data);
        // return 'insert data berhasil.';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'update data berhasil' . PHP_EOL . "Jumlah data yang diupdate ada $row baris.";

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'delete data berhasil' . PHP_EOL . "Jumlah data yang dihapus ada $row baris.";

        // $data = DB::table('m_kategori')->get();
        // return view('kategori', ['data' => $data]);
            
        return $dataTable->render('kategori.index');
    }

    public function create() {
        return view('kategori.create');
    }

    public function store(StorePostRequest $request) {
        // $validated = $request->validate([
        //     'kodeKategori' => ['required'],
        //     'namaKategori' => ['required'],
        // ]);
        // KategoriModel::create([
        //     'kategori_kode' => $request->kodeKategori,
        //     'kategori_nama' => $request->namaKategori,
        // ]);
        // $validated = $request->validateWithBag('post', [
        //     'kategori_kode' => ['required'],
        //     'kategori_nama' => ['required'],
        // ]);

        // $validated = $request->validate([
        //     'kodeKategori' => 'bail|required|max:6|min:3|unique:m_kategori,kategori_kode',
        //     'namaKategori' => 'required',
        // ]);
        $validated = $request->validated();
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        // $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);
        
        // KategoriModel::create([
        //     'kategori_kode' => $validated['kategori_kode'],
        //     'kategori_nama' => $validated['kategori_nama'],
        // ]);

        return redirect('/kategori');
    }

    public function edit($id){
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $kategori]);
    }

    public function update(Request $request, $id){
        $kategori = KategoriModel::find($id);
        $kategori->kategori_kode = $request->kategori_kode;
        $kategori->kategori_nama = $request->kategori_nama;
        $kategori->save();
        return redirect('/kategori');    
    }

    public function destroy($id) {
        // Cek apakah ada entri di m_barang yang memiliki kategori_id yang sama dengan $id
        // $barangCount = KategoriModel::where('kategori_id', $id)->count();
    
        // // Jika ada barang yang terkait dengan kategori, berikan pesan error
        // if ($barangCount > 0) {
        //     return redirect('/kategori')->with('error', 'Tidak dapat menghapus kategori karena masih terdapat barang terkait.');
        // }
    
        // Jika tidak ada barang terkait, hapus kategori
        KategoriModel::find($id)->delete();
    
        // Redirect ke halaman kategori
        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus.');
    }
    
}
