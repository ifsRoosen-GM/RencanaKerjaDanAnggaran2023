<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jenispenggunaan;
use App\Models\SubJenisPenggunaan;
use App\Models\MataAnggaran;
use App\Models\Workgroup;
use App\Models\Pejabat;

class JPenggunaanController extends Controller
{
    public function JPenggunaan(){
      
        return view('workplan.jPenggunaan.index');
    }

    public function jpCreate(){
        return view('workplan.jPenggunaan.create');
    }

    public function jpStore(Request $request){
        $request->validate([
            'namaJenisPenggunaan' => 'required',
        ],
        [
            'namaJenisPenggunaan.required' => 'Nama Jenis Anggaran Harus Di Isi',
        ]);
        DB::table('jenispenggunaan')->insert(
            [
                'namaJenisPenggunaan' => $request['namaJenisPenggunaan']
            ]
        );
        return redirect('/jp')->with('success', 'Data berhasil ditambahkan');
    }

    public function JPenggunaanIndex(){
        $pejabat = Pejabat::all();
        $Jenispenggunaan = Jenispenggunaan::all();
        $Subjenispenggunaan = SubJenisPenggunaan::all();
        $mataanggaranData = MataAnggaran::get();
        $mataanggaran = [];
        
        foreach($mataanggaranData as $mata){
            $unit = json_decode($mata->unit, true);
            $mataanggaran[$mata->id] = [
                'id' => $mata->id,
                'mataAnggaran' => $mata->mataAnggaran,
                'namaAnggaran' => $mata->namaAnggaran,
                'jenispenggunaan_id' => $mata->jenispenggunaan_id,
                'subjenispenggunaan_id' => $mata->subjenispenggunaan_id,
                'controller' => $mata->controller,
                'unit'=> $unit,
            ];

        }
        
        return view('workplan.jPenggunaan.index', compact('Jenispenggunaan', 'Subjenispenggunaan', 'mataanggaran', 'pejabat'));
    }

    public function JPEdit($id){
        $Jenispenggunaan = DB::table('jenispenggunaan')->where('id', $id)->first();

        return view('workplan.jPenggunaan.edit', compact('Jenispenggunaan')); //namaVariabel
    }

    public function JPUpdate($id, Request $request){
        $request->validate([
            'namaJenisPenggunaan' => 'required',
        ],
        [
            'namaJenisPenggunaan.required' => 'Nama Jenis Anggaran Harus Di Isi',
        ]);
        DB::table('jenispenggunaan')->where('id', $id)->update(
            [
                'namaJenisPenggunaan' => $request['namaJenisPenggunaan']
            ]
        );
        return redirect('/jp');
    }

    public function JPDestroy($id){
        DB::table('jenispenggunaan')->where('id', '=', $id)->delete();
        return redirect('/jp');
    }


}