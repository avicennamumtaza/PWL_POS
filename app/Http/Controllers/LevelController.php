<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
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
        // return $dataTable->render('level.index');
        // END OF JOBSHIT 4-6
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level'],
        ];
        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];
        $activeMenu = 'level';

        return view('level.index2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data level dalam bentuk json untuk datatables 
    public function list()
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($level) {  // menambahkan kolom aksi
                $btn  = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= 
                '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">' 
                    . csrf_field() 
                    . method_field('DELETE') . 
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
                </form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    }

    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail'],
        ];
        $page = (object) [
            'title' => 'Detail Level'
        ];
        $activeMenu = 'level';

        return view('level.show2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Level Baru',
        ];
        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.create2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {   
        //dd($request->all());
        // $validated = $request->validate([
        //     'kodeLevel' => 'bail|required|max:3|unique:m_level,level_kode',
        //     'namaLevel' => 'required',
        // ]);

        // LevelModel::create([
        //     'level_kode' => $validated['kodeLevel'],
        //     'level_nama' => $validated['namaLevel'],
        // ]);

        // return redirect('/level');
        // END OF JOBSHIT 4-6
        $request->validate([
            'level_kode' => 'required|string|min:3|max:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');

    }

    public function edit(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit'],
        ];
        $page = (object) [
            'title' => 'Edit Level'
        ];
        $activeMenu = 'level';

        return view('level.edit2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }


    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'level_kode' => 'nullable|string|min:3|max:3|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);
    
        // Redirect ke halaman level
        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy($id) {
        // LevelModel::find($id)->delete();
        // return redirect('/level');
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }
        try {
            LevelModel::destroy(($id));
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}