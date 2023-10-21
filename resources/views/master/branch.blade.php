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
            <div class="row">
                <div class="col mb-2">
                    <div>
                        <label for="InputName" class="form-label">Name</label>
                        <input type="name" class="form-control" id="InputName">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputKode" class="form-label">Kode</label>
                        <input type="kode" class="form-control" id="InputKode">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>
                        <label for="InputPIC" class="form-label">PIC</label>
                        <input type="pic" class="form-control" id="InputPIC">
                    </div>
                </div>
                <div class="col">
                    <button type="button" class="btn-sm btn-primary bold-text mt-4"><i
                            class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                    <button type="button" class="btn-sm btn-warning bold-text mt-4"><i class="fa-solid fa-eye"></i>
                        Show All
                    </button>
                    <button type="button" class="btn-sm btn-success bold-text mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                        New Branch
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">BRANCH INFORMATION SHEET</h6>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Kode</span></th>
                            <th class="thead-text"><span class="nowrap">Nama PIC</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Branch</span></th>
                            <th class="thead-text"><span class="nowrap">Alamat</span></th>
                            <th class="thead-text"><span class="nowrap">Detail</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($branch as $vals)
                        <tr>
                            <div class="d-none">
                                {{ $id = $vals['id'] }}
                            </div>
                            <td class="txt-center">{{ $iterator }}</td>
                            <td><span class="nowrap">{{ $vals['kode_branch']}}</span></td>
                            <td><span class="nowrap">{{ ucwords($vals['employee_name'])}}</span></td>
                            <td><span class="nowrap">{{ ucwords($vals['nama_branch'])}}</span></td>
                            <td><span class="nowrap">{{ ucwords($vals['alamat'])}}</span></td>
                            <td>
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Branch</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form method="post" action="/branch/edit">
                                                            @csrf
                                                            @method("put")

                                                            <div class="row">
                                                                <input type="hidden" id="id_branch " name="id_branch"
                                                                    class="form-control" value="{{ $id }}">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputKode"
                                                                            class="form-label">Kode</label>
                                                                        <input type="text" id="kode_branch"
                                                                            name="kode_branch" class="form-control"
                                                                            value="{{ $vals['kode_branch'] }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputNama"
                                                                            class="form-label">Nama Cabang</label>
                                                                        <input type="text" id="nama_branch"
                                                                            name="nama_branch" class="form-control"
                                                                            value="{{ $vals['nama_branch'] }}">
                                                                    </div>

                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputAlamat"
                                                                            class="form-label">Alamat</label>
                                                                        <div><input type="text" id="alamat_branch"
                                                                                name="alamat_branch"
                                                                                class="form-control"
                                                                                value="{{ $vals['alamat'] }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputGender"
                                                                            class="form-label">Employee Name</label>
                                                                        <!-- <select class="form-control" name="" id="category">
                                                                            <option value="">damas</option>
                                                                            <option value="">toliso</option>
                                                                        </select> -->
                                                                        <select type="employee_name"
                                                                            class="form-control select2"
                                                                            name="employee_id_branch">
                                                                            @foreach ($employee as $val)
                                                                            <option value="" disabled selected hidden>{{$vals['employee_name']}}</option>
                                                                            <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3 float-right">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Update</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenterDelete{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Data Branch
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No
                                                </button>
                                                <form method="post" action="/branch/delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" id="id" name="branch_id"
                                                        class="form-control" value="{{ $id }}">
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <div class="d-none">
                            {{ $iterator = $iterator + 1}}
                        </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Data Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="POST" action="/branch/add">
                            @csrf
                            @method("POST")
                            <div class="row black-text">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputKode" class="form-label">Kode</label>
                                        <input type="text" id="kode_branch" name="kode_branch" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNama" class="form-label">Nama</label>
                                        <input type="text" id="nama_branch" name="nama_branch" class="form-control">
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputAlamat" class="form-label">Alamat</label>
                                        <div>
                                            <input type="text" id="alamat_branch" name="alamat_branch"
                                            class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputGender" class="form-label">Employee Name</label>
                                        <select type="employee_name" class="form-select form-control" id="InputGender"
                                            name="employee_id_branch">
                                            @foreach ($employee as $val)
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <option value="{{$val['id']}}" name="employee_id_branch">{{$val['employee_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 float-right">
                                        <button type="sumbit" class="btn btn-success">Submit</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
