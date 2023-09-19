@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <button type="button" class="btn-sm btn-success float-right bold-text" data-toggle="modal"
                data-target="#exampleModalCenter">
                New COA
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">BRAND SHEET</h6>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text">No</th>
                            <th class="thead-text">Kode COA</th>
                            <th class="thead-text">Deskripsi</th>
                            <th class="thead-text">Kategori</th>
                            <th class="thead-text">Edit</th>
                            <th class="thead-text">Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($coa as $val)
                        <tr>
                            <div class="d-none">
                                {{ $id = $val['id'] }}
                            </div>
                            <td class="txt-center">{{ $iterator }}</td>
                            <td class="txt-center">{{ $val['kode_coa'] }}</td>
                            <td>{{ $val['deskripsi']}}</td>
                            <td>{{ $val['kategori']}}</td>
                            <td>
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal Edit-->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit COA Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="/coa/edit">
                                                    @csrf
                                                    @method("put")

                                                    <input type="hidden" id="id" name="id_coa" class="form-control"
                                                        value="{{ $val['id'] }}">
                                                    <div class="mb-3">
                                                        <label for="InputBrand" class="form-label">KODE</label>
                                                        <input type="text" id="deskripsi_coa" name="deskripsi_coa"
                                                            class="form-control" value="{{ $val['deskripsi'] }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="InputBrand" class="form-label">Deskripsi</label>
                                                        <input type="text" id="deskripsi_coa" name="deskripsi_coa"
                                                            class="form-control" value="{{ $val['deskripsi'] }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="InputDeskripsi" class="form-label">Kategori</label>
                                                        <input type="text" id="kategori_coa" name="kategori_coa"
                                                            class="form-control" value="{{ $val['kategori'] }}">
                                                    </div>

                                                    <div class="mb-3 float-right">
                                                        <button type="sumbit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <!-- Button trigger modal Delete -->
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                    data-target="#exampleModalCenterDelete{{$id}}">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal Delete-->
                                <div class="modal fade" id="exampleModalCenterDelete{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <form method="post" action="/coa/delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" id="id" name="id" class="form-control"
                                                        value="{{ $id }}">
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <div class="d-none">
                            {{ $iterator++ }}
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Modal add-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Data COA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/coa/add">
                    @csrf
                    @method("POST")

                    <div class="mb-3 black-text">
                        <label for="" class="form-label">Kode COA</label>
                        <input type="text" id="kode_coa" name="kode_coa" class="form-control">
                    </div>

                    <div class="mb-3 black-text">
                        <label for="" class="form-label">Deskripsi</label>
                        <input type="text" id="deskripsi_coa" name="deskripsi_coa" class="form-control">
                    </div>

                    <div class="mb-3 black-text">
                        <label for="" class="form-label">Kategori</label>
                        <input type="text" id="kategori_coa" name="kategori_coa" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success float-right">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
