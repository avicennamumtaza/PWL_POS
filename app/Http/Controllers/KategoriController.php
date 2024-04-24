<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori'],
        ];
        $page = (object) [
            'title' => 'Daftar kategori yang terdaftar dalam sistem'
        ];
        $activeMenu = 'kategori';

        return view('kategori.index2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data kategori dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategoris)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($kategori) {  // menambahkan kolom aksi
                $btn  = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= 
                '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">' 
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
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail'],
        ];
        $page = (object) [
            'title' => 'Detail Kategori'
        ];
        $activeMenu = 'kategori';

        return view('kategori.show2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Kategori Baru',
        ];
        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.create2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => [
                'required',
                'string',
                'min:6',
                'max:6',
                'regex:/^KAT\d{3}$/',
                'unique:m_kategori,kategori_kode',
            ],
            'kategori_nama' => 'required|string|max:100',
        ], [
            'kategori_kode.regex' => 'Format kode kategori tidak valid. Gunakan format KAT001, KAT002, dst.'
        ]);        

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    public function edit(string $id){
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit'],
        ];
        $page = (object) [
            'title' => 'Edit Kategori'
        ];
        $activeMenu = 'kategori';

        return view('kategori.edit2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }


    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'kategori_kode' => [
                'required',
                'string',
                'min:6',
                'max:6',
                'regex:/^KAT\d{3}$/',
                // 'unique:m_kategori,kategori_kode',
            ],
            'kategori_nama' => 'required|string|max:100',
        ], [
            'kategori_kode.regex' => 'Format kode kategori tidak valid. Gunakan format KAT001, KAT002, dst.'
        ]);
        
        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);
    
        // Redirect ke halaman kategori
        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function destroy($id) {
        $check = KategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }
        try {
            KategoriModel::destroy(($id));
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

// <?php

// namespace App\Http\Controllers;

// use App\DataTables\KategoriDataTable;
// use App\Http\Requests\StorePostRequest;
// use App\Models\KategoriModel;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class KategoriController extends Controller
// {
//     public function index(KategoriDataTable $dataTable) // CRUD DATA IN DATABASE WITH QUERY BUILDER
//     {
//         // $data = [
//         //     'kategori_kode' => 'SNK',
//         //     'kategori_nama' => 'Snack/Makanan Ringan',
//         //     'created_at' => now(),
//         // ];
//         // DB::table('m_kategori')->insert($data);
//         // return 'insert data berhasil.';

//         // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
//         // return 'update data berhasil' . PHP_EOL . "Jumlah data yang diupdate ada $row baris.";

//         // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
//         // return 'delete data berhasil' . PHP_EOL . "Jumlah data yang dihapus ada $row baris.";

//         // $data = DB::table('m_kategori')->get();
//         // return view('kategori', ['data' => $data]);
            
//         return $dataTable->render('kategori.index');
//     }

//     public function create() {
//         return view('kategori.create');
//     }

//     public function store(StorePostRequest $request) {
//         // $validated = $request->validate([
//         //     'kodeKategori' => ['required'],
//         //     'namaKategori' => ['required'],
//         // ]);
//         // KategoriModel::create([
//         //     'kategori_kode' => $request->kodeKategori,
//         //     'kategori_nama' => $request->namaKategori,
//         // ]);
//         // $validated = $request->validateWithBag('post', [
//         //     'kategori_kode' => ['required'],
//         //     'kategori_nama' => ['required'],
//         // ]);

//         // $validated = $request->validate([
//         //     'kodeKategori' => 'bail|required|max:6|min:3|unique:m_kategori,kategori_kode',
//         //     'namaKategori' => 'required',
//         // ]);
//         $validated = $request->validated();
//         $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
//         // $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);
        
//         // KategoriModel::create([
//         //     'kategori_kode' => $validated['kategori_kode'],
//         //     'kategori_nama' => $validated['kategori_nama'],
//         // ]);

//         return redirect('/kategori');
//     }

//     public function edit($id){
//         $kategori = KategoriModel::find($id);
//         return view('kategori.edit', ['data' => $kategori]);
//     }

//     public function update(Request $request, $id){
//         $kategori = KategoriModel::find($id);
//         $kategori->kategori_kode = $request->kategori_kode;
//         $kategori->kategori_nama = $request->kategori_nama;
//         $kategori->save();
//         return redirect('/kategori');    
//     }

//     public function destroy($id) {
//         // Cek apakah ada entri di m_barang yang memiliki kategori_id yang sama dengan $id
//         // $barangCount = KategoriModel::where('kategori_id', $id)->count();
    
//         // // Jika ada barang yang terkait dengan kategori, berikan pesan error
//         // if ($barangCount > 0) {
//         //     return redirect('/kategori')->with('error', 'Tidak dapat menghapus kategori karena masih terdapat barang terkait.');
//         // }
    
//         // Jika tidak ada barang terkait, hapus kategori
//         KategoriModel::find($id)->delete();
    
//         // Redirect ke halaman kategori
//         return redirect('/kategori')->with('success', 'Kategori berhasil dihapus.');
//     }
// }
