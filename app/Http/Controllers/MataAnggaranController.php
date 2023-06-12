<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jenispenggunaan;
use App\Models\SubJenisPenggunaan;
use App\Models\Pejabat;
use App\Models\MataAnggaran;
use App\Models\Unit;



class MataAnggaranController extends Controller
{
    public function nav(){
        $mataanggaran = MataAnggaran::all();
        return view('partial.sidebar', compact('mataanggaran'));
    }
    public function create(){
        $pejabat = Pejabat::all();
        $jenispenggunaan = Jenispenggunaan::all();
        $unit = Unit::all();
        return view('workplan.mataanggaran.create', compact('jenispenggunaan', 'pejabat', 'unit'));
    }

    public function getSubJenisPenggunaan(Request $request)
    {
        $subjenispenggunaan = \DB::table('subjenispenggunaan')
            ->where('jenispenggunaan_id', $request->jenispenggunaan_id)
            ->get();
        
        if (count($subjenispenggunaan) > 0) {
            return response()->json($subjenispenggunaan);
        }
    }

    public function store(Request $request){
        $request->validate([
            'jenispenggunaan_id' => 'required',
            'mataAnggaran' => 'required',
            'namaAnggaran' => 'required',
            'unit' => 'required',
            'controller' => 'required',
        ],
        [
            'jenispenggunaan_id' => 'Silahkan Pilih Jenis Penggunaan',
            'mataAnggaran' => 'Mata Anggaran Harus Diisi',
            'namaAnggaran' => 'Nama Anggaran Harus Diisi',
            'unit' => 'Silahkan Pilih Unit',
            'controller' => 'Silahkan Pilih Controller'
        ]);
        $input = $request->input('unit');
        $unit = json_encode($input, true);

        $mataanggaran = new MataAnggaran();
        $mataanggaran->jenispenggunaan_id = $request->jenispenggunaan_id;
        $mataanggaran->subjenispenggunaan_id = $request->subjenispenggunaan_id;
        $mataanggaran->mataAnggaran = $request->mataAnggaran;
        $mataanggaran->namaAnggaran = $request->namaAnggaran;
        $mataanggaran->unit = $unit;
        $mataanggaran->controller = $request->controller;

        $mataanggaran->save();
        
        return redirect('/jp');

    }

    public function edit($id){
        $jenispenggunaan = Jenispenggunaan::all();
        $subjenispenggunaan = SubJenisPenggunaan::all();
        $unitDB = Unit::all();
        $pejabat = Pejabat::all();
        $mataanggaran = MataAnggaran::findOrFail($id);
        $unit = json_decode($mataanggaran->unit, true);
        $mataAnggaranData = [
            'unit' => $unit,
            'controller' => $mataanggaran->controller,
        ];

        return view('workplan.mataanggaran.edit', compact('jenispenggunaan', 'pejabat', 'mataanggaran', 'subjenispenggunaan', 'mataAnggaranData', 'unitDB'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'jenispenggunaan_id' => 'required',
            'mataAnggaran' => 'required',
            'namaAnggaran' => 'required',
            'controller' => 'required',
            'unit' => 'required',
        ],
        [
            'jenispenggunaan_id' => 'Silahkan Pilih Jenis Penggunaan',
            'mataAnggaran' => 'Mata Anggaran Harus Diisi',
            'namaAnggaran' => 'Nama Anggaran Harus Diisi',
            'unit' => 'Silahkan Pilih Unit',
            'controller' => 'Silahkan Pilih Controller',
        ]);

        $input = $request->input('unit');
        $unit = json_encode($input, true);

        $mataanggaran = MataAnggaran::find($id);
        $mataanggaran->jenispenggunaan_id = $request->jenispenggunaan_id;
        $mataanggaran->subjenispenggunaan_id = $request->subjenispenggunaan_id;
        $mataanggaran->mataAnggaran = $request->mataAnggaran;
        $mataanggaran->namaAnggaran = $request->namaAnggaran;
        $mataanggaran->unit = $unit;
        $mataanggaran->controller = $request->controller;;

        $mataanggaran->save();
        
        return redirect('/jp');

    }

    public function destroy($id){
        $mataanggaran = MataAnggaran::find($id)->delete();
        return redirect('/jp');
    }

}
