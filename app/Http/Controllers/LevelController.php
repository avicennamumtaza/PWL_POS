<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // DB::insert('insert into m_level (level_kode, level_nama, created_at) values (?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return 'insert data berhasil.';

        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'update data berhasil.' . PHP_EOL . "Jumlah data yang diupdate ada $row baris.";

        $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        return 'delete data berhasil.' . PHP_EOL . "Jumlah data yang dihapus ada $row baris.";
    }
}
