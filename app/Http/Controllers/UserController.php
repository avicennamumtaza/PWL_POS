<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() // CRUD DATA IN DATABASE WITH ELOQUENT ORM
    {
        // add a user data with Eloquent Model
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 3,
        // ];
        // UserModel::insert($data);
        
        // // change a user data with Eloquent Model
        // $data = [
        //     'nama' => 'Pelanggan Pertama'
        // ];
        // UserModel::where('username', 'customer-1')->update($data);

        // delete a user data with Eloquent Model
        // UserModel::where('username', 'manager_tiga')->delete();
        
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        // $user = UserModel::find(1);
        // $user = UserModel::where('level_id', 1)->first();
        // $user = UserModel::firstWhere('level_id', 1);
        $user = UserModel::findOr(20, ['username', 'nama'], function() {
            abort(404);
            // abort(403, 'data yang ditemukan tidak cukup');
        });
        // try to access UserModel
        // $user = UserModel::all();
        return view('user', ['d' => $user]);
    }
}
