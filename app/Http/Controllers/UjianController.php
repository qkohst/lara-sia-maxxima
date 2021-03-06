<?php

namespace App\Http\Controllers;

use App\MataPelajaran;
use App\Peserta;
use App\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Ujian';
        $data_ujian = Ujian::filter(request(['date_filter']))->get();
        foreach ($data_ujian as $ujian) {
            $ujian->count_peserta_lulus = Peserta::where('id_ujian', $ujian->id)->where('nilai', '>=', $ujian->mata_pelajaran->kkm)->count();
        }
        $data_matpel = MataPelajaran::all();
        return view('ujian.index', compact(
            'title',
            'data_ujian',
            'data_matpel'
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ujian' => 'required|min:2|max:50',
            'id_matpel' => 'required',
            'tanggal' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        } else {
            $ujian = new Ujian([
                'nama_ujian' => $request->nama_ujian,
                'id_matpel' => $request->id_matpel,
                'tanggal' => $request->tanggal,
            ]);
            $ujian->save();
            return back()->with('toast_success', 'Berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ujian = Ujian::findorfail($id);
            $ujian->delete();
            return back()->with('toast_success', 'Berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Data tidak dapat dihapus.');
        }
    }
}
