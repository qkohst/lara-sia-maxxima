@extends('layouts.master')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="text-uppercase mb-0">Data {{$title}}</h6>
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
                                    <form action="{{ route('ujian.store') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Nama Ujian</label>
                                                        <input type="text" class="form-control" name="nama_ujian" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Mata Pelajaran</label>
                                                        <select class="form-select" aria-label="Default select example" name="id_matpel" required>
                                                            <option value="" selected>-- Pilih Mata Pelajaran --</option>
                                                            @foreach($data_matpel as $matpel)
                                                            <option value="{{$matpel->id}}" {{ old('id_matpel') == $matpel->id ? "selected" : "" }}>{{$matpel->nama_matpel}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Tanggal</label>
                                                        <input type="datetime-local" class="form-control" name="tanggal" required>
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
                    @if($data_ujian->count() == 0)
                    <hr class="horizontal dark">
                    <div class="text-center mb-2">Data ujian belum tersedia</div>
                    @else
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Nama Ujian</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Mata Pelajaran</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Peserta</th>
                                    <th class="text-dark opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_ujian as $ujian)
                                <?php $no++; ?>
                                <tr>
                                    <td>
                                        <p class="text-sm text-center mb-0">{{$no}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$ujian->nama_ujian}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$ujian->tanggal}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$ujian->mata_pelajaran->nama_matpel}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0 text-danger">0 belum</p>
                                    </td>

                                    <td class="align-middle ms-auto text-center">
                                        <a href="#" class="btn btn-link text-danger text-gradient px-2 mb-0 btn-delete" title="Hapus" data-id="{{$ujian->id}}">
                                            <form action="{{ route('ujian.destroy', $ujian->id) }}" method="post" id="delete{{$ujian->id}}">
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