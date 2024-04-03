<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use App\DataTables\UserDataTable;

class UserController extends Controller
{

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request): RedirectResponse
    {   
        // dd($request->all());
        $validated = $request->validate([
            'level_id' => 'required',
            'username' => 'bail|required|min:4|unique:m_user,username',
            'nama' => 'required',
            'password' => 'required',
        ]);

        $password = Hash::make($validated['password']);

        UserModel::create([
            'level_id' => $validated['level_id'],
            'username' => $validated['username'],
            'nama' => $validated['nama'],
            'password' => $password,
        ]);

        return redirect('/user');
    }

    public function edit($id){
        $user = UserModel::find($id);
        return view('user.edit', ['data' => $user]);
    }

    // public function update(Request $request, $id){
    //     $user = UserModel::find($id);
    //     $user->level_id = $request->level_id;
    //     $user->username = $request->username;
    //     $user->name = $request->name;
    //     $user->password = $request->password;
    //     $user->save();
    //     return redirect('/user');    
    // }
    public function update(Request $request, $id): RedirectResponse
    {
        // dd($request->all());
        // Validasi input
        $validated = $request->validate([
            'level_id' => 'required',
            'username' => 'bail|required|min:4',
            'nama' => 'required',
            'password' => 'required',
        ]);
    
        // Temukan level berdasarkan ID
        $user = UserModel::find($id);
        $password = Hash::make($validated['password']);
    
        // Perbarui atribut level
        $user->level_id = $validated['level_id'];
        $user->username = $validated['username'];
        $user->nama = $validated['nama'];
        $user->password = $password;
    
        // Simpan perubahan
        $user->save();
    
        // Redirect ke halaman level
        return redirect('/user');
    }

    public function destroy($id) {
        UserModel::find($id)->delete();

        return redirect('/user');
    }
    
        
    

    // public function index()
    // {
    //     // $user = UserModel::all();
    //     $user = userModel::with('level')->get();
    //     //dd($user);
    //     return view('user', ['data' => $user]);

    // }

    // public function tambah()
    // {
    //     return view('user_tambah');
    // }

    // public function tambah_simpan(Request $request)
    // {
    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama' => $request->name,
    //         'password' => Hash::make($request->password),
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user');
    // }

    // public function ubah($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request)
    // {
    //     $user = UserModel::find($id);
        
    //     $user->username = $request->username;
    //     $user->name = $request->name;
    //     $user->password = Hash::make($request->password);
    //     $user->level_id = $request->level_id;
    //     $user->save();

    //     return redirect('/user');
    // }

    // public function hapus($id)
    // {
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

        // $user = UserModel::create([
        //     'username' => 'manager11',
        //     'nama' => 'Manager11',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);

        // $user->username = 'manager12';
        // $user->save();

        // $user->wasChanged(); //true
        // $user->wasChanged('username'); //true
        // $user->wasChanged(['nama', 'username']); //true
        // $user->wasChanged('nama'); //false
        // dd($user->wasChanged(['nama', 'username'])); //true


        // $user = UserModel::create([
        //     'username' => 'manager55',
        //     'nama' => 'Manager55',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);

        // $user -> username = 'manager56';

        // $user->isDirty(); //true
        // $user->isDirty('username'); //true
        // $user->isDirty('nama'); //false
        // $user->isDirty(['nama', 'username']); //true

        // $user->isClean(); //false
        // $user->isClean('username'); //false
        // $user->isClean('nama'); //true
        // $user->isClean(['nama', 'username']); //false

        // $user->save();

        // $user->isDirty(); //false
        // $user->isClean(); //true
        // dd($user->isDirty());

        

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user -> save();

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        //$user = UserModel::where('level_id', 2)-> count();
        //dd($user);

        //$user = UserModel::where('username', 'manager9')->firstOrFail();

        //$user = UserModel::findOrFail(1);

        // $user = UserModel::findOr(20, ['username', 'nama'], function(){
        //     abort(404);
        // });

        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4
        // ];
        // UserModel::insert($data);

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data);

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        //$user = UserModel::firstWhere('level_id', 1);
    
}