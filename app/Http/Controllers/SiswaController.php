<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function index(){
        $siswa = Siswa::all();
        return view('siswa.tampil', compact('siswa'));
    }

    function storeAjax(Request $request){
        $siswa = new Siswa();
        $siswa->nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->absen = $request->absen;
        $siswa->save();

        return response()->json(['status' => 'success', 'data' => $siswa]);
    }

    function editAjax($id){
        $siswa = Siswa::find($id);
        if ($siswa) {
            return response()->json(['status' => 'success', 'data' => $siswa]);
        }
        return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }

    function updateAjax(Request $request, $id){
        $siswa = Siswa::find($id);
        if ($siswa) {
            $siswa->nama = $request->nama;
            $siswa->kelas = $request->kelas;
            $siswa->absen = $request->absen;
            $siswa->update();

            return response()->json(['status' => 'success', 'data' => $siswa]);
        }
        return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }

    function deleteAjax($id){
        $siswa = Siswa::find($id);
        if ($siswa) {
            $siswa->delete();
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        }
        return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }
}
