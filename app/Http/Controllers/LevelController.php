<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Monolog\Level;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    //menampilkan halaman awal level
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Level',
            'list'  => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; //set menu yang sedang aktif

        $level = LevelModel::all();

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,'activeMenu' => $activeMenu
        ]);
    }
   // Ambil data level dalam bentuk json untuk datatables
   public function list(Request $request)
   {
       $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

       return DataTables::of($levels)
           ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
           ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
               $btn = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
               $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
               $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
               return $btn;
           })
           ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
           ->make(true);
   }

   //menampilkan halaman form tambah level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list'  => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Level Baru'
        ];

        $level = LevelModel::all();
        $activeMenu = 'level';

        return view('level.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'level' => $level, 
            'activeMenu' => $activeMenu
        ]);
    }

    //menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_kode'    => 'required|string|max:10', 
            'level_nama'    => 'required|string|max:100',                   
        ]);

        levelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    //menampilkan detail level
    public function show(string $id)
    {
        $level = LevelModel::find($id);

        //memastikan level ditemukan
        if (!$level) {
            return redirect('/level')->with('error', 'Level tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail level',
            'list'  => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level';

        return view('level.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'level' => $level, 
            'activeMenu' => $activeMenu
        ]);
    }

    //menampilkan halaman form edit level
    public function edit(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', ['breadcrumb' => $breadcrumb,'page' => $page,'level' => $level,'activeMenu' => $activeMenu]);
    }

    //menyimpan data level
    public function update(Request $request, string $id)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'level_kode' => 'required|string|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100' // nama harus diisi, berupa string, dan maksimal 100 karakter
        ]);

        $level = LevelModel::find($id);

        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,

        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    //menghapus data level
    public function destroy (string  $id)
    {
        //cek apakah data level dengan ID yang dimaksud ada tidak
        $check = LevelModel::find($id);

        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak Ditemukan');
        } 
        
        try{
            //hapus data level
            levelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level Berhasil dihapus');
        } catch (\Illuminate\Database\QueryException){
            // Jika terjadi error ketika menghapus data, redirect kembali
            return redirect('/level')->with('error', 'Data level Gagal dihapus karena terdapat Tabel lain yang terkait dengan data ini');
        }
    }

    //fungsi create_ajax()
    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    //proses simpan data melalui ajax
    public function store_ajax(Request $request)
    {
        //cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'level_kode' => 'required|string|max:10',
                'level_nama' => 'required|string|max:100'
            ];

            //use illuminate\Support\Facades\Validator
            $validator =Validator::make($request->all(), $rules);

            if($validator-> fails()){
                return response()->json([
                    'status' => false, //response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->erros(),
                ]);
            }

            // Simpan data level
            LevelModel::create([
                'level_kode' => $request->level_kode,
                'level_nama' => $request->level_nama,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        
        }
        redirect('/');
    }
    public function show_ajax(string $id)
    {
        $level = LevelModel::find($id);

        return view('level.show_ajax', ['level' => $level]);
    }
     // Menampilkan halaman form edit level ajax
     public function edit_ajax(string $id)
     {
         $level = LevelModel::find($id);
         
         return view('level.edit_ajax', ['level' => $level]);
     }

     public function update_ajax(Request $request, $id)
    {
        // Cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|max:10',
                'level_nama' => 'required|string|max:100',
            ];

            // Validasi data
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // Menunjukkan field mana yang error
                ]);
            }

            $check = LevelModel::find($id);
            
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        
        return redirect('/');
    }

    public function confirm_ajax(string $id) 
    {
        $level = LevelModel::find($id);

        return view('level.confirm_ajax', ['level' => $level]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX atau permintaan JSON
        if ($request->ajax() || $request->wantsJson()) {
            // Cari level berdasarkan id
            $level = LevelModel::find($id);
            
            // Jika level ditemukan, hapus data
            if ($level) {
                $level->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        // Jika bukan request AJAX, arahkan kembali ke halaman sebelumnya
        return redirect('/');
    }

}