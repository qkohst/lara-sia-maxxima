<?php

namespace App\Http\Controllers;

use App\Peserta;
use App\Siswa;
use App\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesertaUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $title = 'Peserta Ujian';
        $data_peserta = Peserta::where('id_ujian', $id)->get();
        $data_siswa = Siswa::all();
        $ujian = Ujian::findorfail($id);
        return view('peserta.index', compact(
            'title',
            'data_peserta',
            'data_siswa',
            'ujian'
        ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_siswa' => 'required',
            'nilai' => 'required|integer|between:1,100',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        } else {
            $peserta = new Peserta([
                'id_ujian' => $request->id,
                'id_siswa' => $request->id_siswa,
                'nilai' => $request->nilai,
            ]);
            $peserta->save();
            return back()->with('toast_success', 'Berhasil disimpan.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $pesertum)
    {
        try {
            $peserta = Peserta::findorfail($pesertum);
            $peserta->delete();
            return back()->with('toast_success', 'Berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Data tidak dapat dihapus.');
        }
    }
}
