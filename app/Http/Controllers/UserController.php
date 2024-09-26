<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
    $breadcrumb = (object) [
        'title' => 'Daftar User',
        'list' => ['home','user']
    ];

    $page = (object)[
        'title' => 'Daftar user yang terdaftar dalam sistem'
    ];

    $activeMenu = 'user';


    $level = LevelModel::all(); //ambil data level untuk filtel level

    return view('user.index', ['breadcrumb'=> $breadcrumb, 'page'=> $page,'level'=> $level, 'activeMenu' => $activeMenu]);
   }
  
    // Ambil data user dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
    // Mengambil data user beserta relasi dengan level
    $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
                      ->with('level');
    if($request->level_id){
        $users->where('level_id',$request->level_id);
    }
    // Mengembalikan data dalam bentuk DataTables
    return DataTables::of($users)
        // Menambahkan kolom index / nomor urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn() 
        // Menambahkan kolom aksi dengan tombol-tombol aksi (Detail, Edit, Hapus)
        ->addColumn('aksi', function ($user) {
            $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/'.$user->user_id).'">'
                . csrf_field() . method_field('DELETE') . 
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        // Memberitahu bahwa kolom 'aksi' berisi HTML
        ->rawColumns(['aksi']) 
        ->make(true);
    }

    //menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title'=> 'Tambah User',
            'list' => ['Home', 'User','Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah User Baru'
        ];
        $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page'=> $page, 'level'=> $level, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request){
        $request->validate([
            //username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);
        return redirect('/user')->with('succes','Data user berhasil disimpan');
    }

    //menampilkan detail user
    public function show(string $id){
        $user = UserModel::with('level')-> find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home','User','Detail']
        ];
        $page = (object) [
            'title'=> 'Detail user'
        ];
        $activeMenu = 'user';
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user'=> $user, 'activeMenu'=> $activeMenu]);
    }
    
    //menampilkan halaman form edit user
    public function edit(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home','User','Edit']
        ];
        $page = (object) [
            'title' => 'Edit User'
        ];
        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('user.edit', ['breadcrumb'=> $breadcrumb, 'page'=> $page, 'user'=> $user, 'level'=> $level, 'activeMenu' => $activeMenu]);
    }

    //menyimpan perubahan data user
    public function update(Request $request, string $id){
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter
            // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,' .$id. ',user_id',
            'nama' => 'required|string|max:100', //nama harus diisi berupa string maksimal 100 karakter
            'password' => 'nullable|min:5', //password bisa diisi min 5 karakter dan bisa tidak diisi
            'level_id' => 'required|integer' //level_id harus diisi dan berupa angka
        ]);
        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);
        return redirect('/user')->with('success','Data user berhasil diubah');
    }
    
    public function destroy(string $id){
        $check = UserModel::find($id);
        if(!$check){
            return redirect('/user')->with('eror','data user tidak ditemukan');
        }
        try{
            UserModel::destroy($id); //hapus data level
            return redirect('/user')->with('succes', 'data user berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            //jika terjadi ketika menghapus data redirect kembali ke halaman dengan membawa pesan
            return redirect('/user')-> with('error','data user gagal dihapus karena masih ada yang berkaitan');
        }
    }

}
