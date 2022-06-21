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
                                    <form action="{{ route('siswa.store') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">NIS (Nomor Induk Siswa)</label>
                                                        <input type="text" class="form-control" name="nis" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Nama Siswa</label>
                                                        <input type="text" class="form-control" name="nama" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Alamat</label>
                                                        <input type="text" class="form-control" name="alamat" required>
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
                    @if($data_siswa->count() == 0)
                    <hr class="horizontal dark">
                    <div class="text-center mb-2">Data siswa belum tersedia</div>
                    @else
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">NIS</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Nama Siswa</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                                    <th class="text-dark opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_siswa as $siswa)
                                <?php $no++; ?>
                                <tr>
                                    <td>
                                        <p class="text-sm text-center mb-0">{{$no}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$siswa->nis}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-secondary mb-0">{{$siswa->nama}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-secondary mb-0">{{$siswa->alamat}}</p>
                                    </td>

                                    <td class="align-middle ms-auto text-center">
                                        <a href="{{ route('siswa.show', $siswa->id) }}" target="_black" class="btn btn-link text-primary px-1 mb-0">Detail Ujian</a>
                                        <a class="btn btn-link text-dark px-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalEdit{{$siswa->id}}">Edit</a>
                                        <a href="#" class="btn btn-link text-danger text-gradient px-1 mb-0 btn-delete" title="Hapus" data-id="{{$siswa->id}}">
                                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="post" id="delete{{$siswa->id}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEdit{{$siswa->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit {{$title}}</h5>
                                            </div>
                                            <form id="formEdit{{$siswa->id}}" action="{{ route('siswa.update', $siswa->id) }}" method="post">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">NIS (Nomor Induk Siswa)</label>
                                                        <input class="form-control" type="text" name="nis" value="{{$siswa->nis}}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Nama siswa</label>
                                                        <input class="form-control" type="text" name="nama" value="{{$siswa->nama}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Alamat</label>
                                                        <input class="form-control" type="text" name="alamat" value="{{$siswa->alamat}}">
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="#" class="btn btn-primary btn-save" data-id="{{$siswa->id}}">Simpan</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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

            $('.btn-save').click(function(e) {
                id = e.target.dataset.id;
                swal({
                    title: 'Apakah anda yakin ?',
                    text: "Simpan perubahan data !",
                    type: 'warning',
                    buttons: {
                        confirm: {
                            text: 'Simpan',
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
                        $(`#formEdit${id}`).submit();
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