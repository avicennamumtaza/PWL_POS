<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable)
    {
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) 
        // values (?, ?, ?)', ['CUS', 'Pelanggan', now()]);   
        
        // return 'Insert Data Baru Berhasil!';
        
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', 
        // ['Customer', 'CUS']);
        // return 'Update Data Berhasil Jumlah Data yang Diupdate: '.$row.' baris';
        
        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete Data Berhasil. Jumlah Data yang Dihapus: '.$row.' baris';\
        
        // $data = DB::select('select * from m_level');
        // return view('level', ['data' => $data]);
        return $dataTable->render('level.index');
    }

    public function create()
    {
        return view('level.create');
    }

    public function store(Request $request): RedirectResponse
    {   
        //dd($request->all());
        $validated = $request->validate([
            'kodeLevel' => 'bail|required|max:3|unique:m_level,level_kode',
            'namaLevel' => 'required',
        ]);

        LevelModel::create([
            'level_kode' => $validated['kodeLevel'],
            'level_nama' => $validated['namaLevel'],
        ]);

        return redirect('/level');
    }

    public function edit($id){
        $level = LevelModel::find($id);
        return view('level.edit', ['data' => $level]);
    }


    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'kodeLevel' => 'bail|required|max:3',
            'namaLevel' => 'required',
        ]);
    
        // Temukan level berdasarkan ID
        $level = LevelModel::find($id);
    
        // Perbarui atribut level
        $level->level_kode = $validated['kodeLevel'];
        $level->level_nama = $validated['namaLevel'];
    
        // Simpan perubahan
        $level->save();
    
        // Redirect ke halaman level
        return redirect('/level');
    }

    public function destroy($id) {
        LevelModel::find($id)->delete();

        return redirect('/level');
    }
}