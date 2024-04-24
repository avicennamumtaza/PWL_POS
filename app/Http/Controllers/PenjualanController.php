<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Penjualan'
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('penjualan.index2', compact('breadcrumb', 'page', 'activeMenu', 'user'));
    }

    /**
     * Show the table that amount existing resource.
     */
    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'penjualan_kode', 'penjualan_tanggal', 'user_id', 'pembeli')->with('detail', 'user');

        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm mr-2">Detail</a>';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>'
                    . '</form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Transaksi',
            'list' => ['Home', 'Stok', 'Tambah Transaksi']
        ];

        $page = (object) [
            'title' => 'Tambah Transaksi'
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'penjualan';

        $counter = (PenjualanModel::selectRaw("CAST(RIGHT(penjualan_kode, 3) AS UNSIGNED) AS counter")->orderBy('penjualan_id', 'desc')->value('counter')) + 1;
        $penjualan_kode = 'PJ' . sprintf("%04d", $counter);

        return view('penjualan.create2', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'barang' => $barang,
            'penjualan_kode' => $penjualan_kode,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|integer',
            'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
            'pembeli' => 'required|string|max:100',
            'barang_id.*' => 'required|integer',
            'jumlah.*' => 'required|integer',
            'harga.*' => 'required|integer',

        ]);

        foreach ($request->barang_id as $key => $barang_id) {
            // Cek stok yang tersedia
            $stok = StokModel::where('barang_id', $barang_id)->value('stok_jumlah');
            $nama_barang = BarangModel::where('barang_id', $barang_id)->value('barang_nama');
            $requestedQuantity = $request->jumlah[$key];

            if ($stok < $requestedQuantity) {

                // Jika jumlah yang diminta melebihi stok yang tersedia, kembalikan pesan kesalahan
                return redirect()->back()->withInput()->withErrors(['jumlah.' . $key => 'Jumlah Melebihi Stok yang Tersedia. Stok "' . $nama_barang . '" Saat Ini: ' . $stok]);
            }
        }

        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id,
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => now()
        ]);

        $barang_ids = $request->barang_id;
        $jumlahs = $request->jumlah;
        $hargas = $request->harga;

        foreach ($barang_ids as $key => $barang_id) {
            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $barang_id,
                'harga' => $hargas[$key],
                'jumlah' => $jumlahs[$key],
            ]);

            $stok = (StokModel::where('barang_id', $barang_id)->value('stok_jumlah')) - $jumlahs[$key];
            $date = date('Y-m-d');
            StokModel::where('barang_id', $barang_id)->update(['stok_jumlah' => $stok, 'stok_tanggal' => $date, 'user_id' => $request->user_id]);
        }

        return redirect()->route('penjualan', $penjualan->penjualan_id)->with('success', 'Data Transaksi Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $penjualan_detail = PenjualanDetailModel::where('penjualan_id', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan';

        $total = 0;
        foreach ($penjualan_detail as $dt) {
            $total += $dt->jumlah * $dt->harga;
        }

        return view('penjualan.show2', compact('breadcrumb', 'page', 'activeMenu', 'penjualan', 'penjualan_detail', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);

        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }
}
