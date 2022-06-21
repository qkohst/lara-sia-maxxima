@extends('layouts.master')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 align-items-center">
                            <h6 class="text-uppercase mb-0">Data {{$title}}</h6>
                            <p class="text-sm texf-secondary">{{$siswa->nis}} {{$siswa->nama}}</p>
                        </div>

                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if($data_peserta->count() == 0)
                    <hr class="horizontal dark">
                    <div class="text-center mb-2">Data ujian belum tersedia</div>
                    @else
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Nama Ujian</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Nilai</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_peserta as $peserta)
                                <?php $no++; ?>
                                <tr>
                                    <td>
                                        <p class="text-sm text-center mb-0">{{$no}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$peserta->ujian->nama_ujian}} {{$peserta->ujian->mata_pelajaran->nama_matpel}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$peserta->nilai}}</p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        @if($peserta->nilai >= $peserta->ujian->mata_pelajaran->kkm)
                                        <span class="badge badge-sm bg-gradient-success">lulus</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-warning">Tidak Lulus</span>
                                        @endif
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection