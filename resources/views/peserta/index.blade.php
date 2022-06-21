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
                            <p class="text-sm texf-secondary">{{$ujian->nama_ujian}} {{$ujian->mata_pelajaran->nama_matpel}}</p>
                        </div>
                        <div class="col-6 text-end">
                            <a class="btn bg-gradient-primary mb-0" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="icofont-plus me-2"></i>Tambah</a>
                        </div>
                        <!-- Modal Tambah-->
                        <div class="modal fade" id="modalTambah" aria-labelledby="exampleModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah {{$title}}</h5>
                                    </div>
                                    <form action="{{ route('peserta-ujian.store', $ujian->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Siswa</label>
                                                        <select class="form-select" aria-label="Default select example" name="id_siswa" required>
                                                            <option value="" selected>-- Pilih Siswa--</option>
                                                            @foreach($data_siswa as $siswa)
                                                            <option value="{{$siswa->id}}" {{ old('id_siswa') == $siswa->id ? "selected" : "" }}>{{$siswa->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Nilai Ujian</label>
                                                        <input type="number" class="form-control" name="nilai" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if($data_peserta->count() == 0)
                    <hr class="horizontal dark">
                    <div class="text-center mb-2">Data peserta belum tersedia</div>
                    @else
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Nilai</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-dark opacity-7"></th>
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
                                        <p class="text-sm mb-0">{{$peserta->siswa->nama}}</p>
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


                                    <td class="align-middle ms-auto text-center">
                                        <a href="#" class="btn btn-link text-danger text-gradient px-2 mb-0 btn-delete" title="Hapus" data-id="{{$ujian->id}}">
                                            <form action="/ujian/{{$ujian->id}}/peserta/{{$peserta->id}}" method="post" id="delete{{$ujian->id}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            Hapus
                                        </a>
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

@section('scripts')
<!-- Sweet Alert -->
<script src="/assets/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    //== Class definition
    var SweetAlert2Demo = function() {
        //== Demos
        var initDemos = function() {

            $('.btn-delete').click(function(e) {
                id = e.target.dataset.id;
                swal({
                    title: 'Apakah anda yakin ?',
                    text: "Hapus data secara permanen !",
                    type: 'warning',
                    buttons: {
                        confirm: {
                            text: 'Hapus',
                            className: 'btn bg-gradient-primary'
                        },
                        cancel: {
                            visible: true,
                            text: 'Batal',
                            className: 'btn btn-outline-danger'
                        }
                    }
                }).then((Delete) => {
                    if (Delete) {
                        $(`#delete${id}`).submit();
                    } else {
                        swal.close();
                    }
                });
            });

        };
        return {
            //== Init
            init: function() {
                initDemos();
            },
        };
    }();
    //== Class Initialization
    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
</script>
@endsection