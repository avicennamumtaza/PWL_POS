<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use App\DataTables\BarangDataTable;
use App\Models\KategoriModel;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang'],
        ];
        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];
        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Ambil data barang dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'kategori_id', 'harga_beli', 'harga_jual')
            ->with('kategori');

        if ($request->kategori_id) {
            $barangs->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barangs)
            ->addIndexColumn() // menambahkan kolom index / no urut (default barang_nama kolom: DT_RowIndex) 
            ->addColumn('aksi', function ($barang) {  // menambahkan kolom aksi
                $btn  = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .=
                    '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
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
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail'],
        ];
        $page = (object) [
            'title' => 'Detail Barang'
        ];
        $activeMenu = 'barang';

        return view('barang.show2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Barang Baru',
        ];
        $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan dalam form
        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.create2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => [
                'required',
                'string',
                // 'regex:/^BRG' . $request->kategori_id . '\d{3}$/',
                'unique:m_barang,barang_kode',
            ],
            'barang_nama' => [
                'required',
                'string',
                // 'regex:/^Barang ' . $request->kategori_id . '\d{3}$/',
                'max:100',
            ],
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer',
        ]);

        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function edit(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit'],
        ];
        $page = (object) [
            'title' => 'Edit Barang'
        ];
        $activeMenu = 'barang';

        return view('barang.edit2', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // public function update(Request $request, $id): RedirectResponse
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => [
                'required',
                'string',
                // 'regex:/^BRG' . $request->kategori_id . '\d{3}$/',
                // 'unique:m_barang,barang_kode',
            ],
            'barang_nama' => [
                'required',
                'string',
                // 'regex:/^Barang ' . $request->kategori_id . '\d{3}$/',
                'max:100',
            ],
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer',
        ]);

        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy($id)
    {
        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }
        try {
            BarangModel::destroy(($id));
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
