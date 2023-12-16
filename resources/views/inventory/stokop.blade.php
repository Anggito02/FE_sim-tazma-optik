@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <div>
                        <label for="InputTahun" class="form-label">Tahun</label>
                        <input type="tahun" class="form-control" id="InputTahun">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputBulan" class="form-label">Bulan</label>
                        <input type="bulan" class="form-control" id="InputBulan">
                    </div>
                </div>
            </div>
            <div class="row">
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
                        New SO
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
                            <th class="thead-text"><span class="nowrap">Tahun</span></th>
                            <th class="thead-text"><span class="nowrap">Bulan</span></th>
                            <th class="thead-text"><span class="nowrap">Detail</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        <tr>
                            <td class="txt-center">1</td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center">
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-warning" data-toggle="modal"
                                    data-target="">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <div class="d-none">
                            {{ $iterator = $iterator + 1}}
                        </div>

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
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <option value="" name="employee_id_branch"></option>
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
