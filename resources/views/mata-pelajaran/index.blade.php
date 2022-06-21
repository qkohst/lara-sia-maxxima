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
                                    <form action="{{ route('matpel.store') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Nama Mata Pelajaran</label>
                                                        <input type="text" class="form-control" name="nama_matpel" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">KKM</label>
                                                        <input type="number" class="form-control" name="kkm" required>
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
                    @if($data_matpel->count() == 0)
                    <hr class="horizontal dark">
                    <div class="text-center mb-2">Data matpel belum tersedia</div>
                    @else
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">Nama Mata Pelajaran</th>
                                    <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">KKM</th>
                                    <th class="text-dark opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_matpel as $matpel)
                                <?php $no++; ?>
                                <tr>
                                    <td>
                                        <p class="text-sm text-center mb-0">{{$no}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$matpel->nama_matpel}}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm mb-0">{{$matpel->kkm}}</p>
                                    </td>

                                    <td class="align-middle ms-auto text-center">
                                        <a class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modalEdit{{$matpel->id}}">Edit</a>
                                        <a href="#" class="btn btn-link text-danger text-gradient px-2 mb-0 btn-delete" title="Hapus" data-id="{{$matpel->id}}">
                                            <form action="{{ route('matpel.destroy', $matpel->id) }}" method="post" id="delete{{$matpel->id}}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEdit{{$matpel->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit {{$title}}</h5>
                                            </div>
                                            <form id="formEdit{{$matpel->id}}" action="{{ route('matpel.update', $matpel->id) }}" method="post">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Nama Mata Pelajaran</label>
                                                        <input class="form-control" type="text" name="nama_matpel" value="{{$matpel->nama_matpel}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">KKM</label>
                                                        <input class="form-control" type="number" name="kkm" value="{{$matpel->kkm}}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="#" class="btn btn-primary btn-save" data-id="{{$matpel->id}}">Simpan</a>
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