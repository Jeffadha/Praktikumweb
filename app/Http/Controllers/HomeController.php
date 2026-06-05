<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = Mahasiswa::all();
        return view('home', compact('data'));
    }

    public function storeajax(Request $request){
        $mahasiswa = Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim
        ]);
        return response()->json($mahasiswa);
    }

    public function showajax(){
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa);
    }

    public function searchajax(Request $request){
        $keyword = $request->keyword;
        $mahasiswa = Mahasiswa::where('nama', 'like', '%' . $keyword . '%')
                                ->orWhere('nim', 'like', '%' . $keyword . '%')
                                ->get();
        return response()->json($mahasiswa);
    }

    


}
