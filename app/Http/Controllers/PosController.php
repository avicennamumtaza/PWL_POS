<?php

namespace App\Http\Controllers;

use App\Models\m_user;
use App\Models\UserModel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class POSController extends Controller
{
    /** 
     * Display a listing of the resource. 
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination 
        $useri = UserModel::all(); // Mengambil semua isi tabel 
        return view('m_user.index', compact('useri'))->with('i');
    }


    /** 
     * Show the form for creating a new resource. 
     */
    public function create()
    {
        return view('m_user.create');
    }

    /** 
     * Store a newly created resource in storage. 
     */
    public function store(Request $request)
    {
        //melakukan validasi data 
        $request->validate([
            'user_id' => 'max 20',
            'username' => 'required',
            'nama' => 'required',

        ]);
        //fungsi eloquent untuk menambah data 
        UserModel::create($request->all());

        return redirect()->route('m_user.index')
            ->with('success', 'user Berhasil Ditambahkan');
    }

    /** 
     * Display the specified resource. 
     */
    public function show(string $id, m_user $useri)
    {
        $useri = UserModel::findOrFail($id);
        return view('m_user.show', compact('useri'));
    }

    /** 
     * Show the form for editing the specified resource. 
     */
    public function edit(string $id)
    {
        $useri = UserModel::find($id);
        return view('m_user.edit', compact('useri'));
    }

    /** 
     * Update the specified resource in storage. 
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita 
        UserModel::find($id)->update($request->all());
        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('m_user.index')->with('success', 'Data Berhasil Diupdate');
    }

    /** 
     * Remove the specified resource from storage. 
     */
    public function destroy(string $id)
    {
        $useri = UserModel::findOrFail($id)->delete();
        return \redirect()->route('m_user.index')

            ->with('success', 'data Berhasil Dihapus');
    }
}
