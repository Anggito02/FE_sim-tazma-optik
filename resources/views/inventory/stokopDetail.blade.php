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
                        <label for="InputKode" class="form-label">Kode Item</label>
                        <input type="kode" class="form-control" id="InputKode">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputJenis" class="form-label">Jenis Item</label>
                        <input type="jenis" class="form-control" id="InputJenis">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>
                        <label for="InputStatus" class="form-label">Adjustment Status</label>
                        <input type="pic" class="form-control" id="InputStatus">
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label for="InputAdjustmentBy" class="form-label">Adjustment by</label>
                        <input type="pic" class="form-control" id="InputAdjustmentBy">
                    </div>
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
                    <button type="button" class="btn-sm btn-success bold-text mt-4"><i class="fa-solid fa-pencil"></i>
                        New Detail
                    </button>
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
                            <th class="thead-text"><span class="nowrap">Kode Item</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text"><span class="nowrap">Open by</span></th>
                            <th class="thead-text"><span class="nowrap">Close by</span></th>
                            <th class="thead-text"><span class="nowrap">SO Start</span></th>
                            <th class="thead-text"><span class="nowrap">SO End</span></th>
                            <th class="thead-text"><span class="nowrap">SO Duration</span></th>
                            <th class="thead-text"><span class="nowrap">Actual QTY</span></th>
                            <th class="thead-text"><span class="nowrap">SYS QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Diff QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Positif Diff QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Neg Diff QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Type</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Status</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment by</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Date</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Note</span></th>
                            <th class="thead-text"><span class="nowrap">Adjust</span></th>
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
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center"><span class="nowrap">1</span></td>
                            <td class="txt-center">
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-warning no-wrap" data-toggle="modal"
                                    data-target="#modalAddAdjustment">
                                    <span class="nowrap">Add Adjustment Note</span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modalAddAdjustment" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="exampleModalLongTitle">Modal menambahkan adjustment note</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex flex-row">
                                                    <p>Employee name : </p>
                                                    <p style="margin-left:1%;">Niko</p>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <p>Adjustment date : </p>
                                                    <p style="margin-left:1%;">31-01-2023</p>
                                                </div>
                                                <div class="d-flex flex-column align-items-start">
                                                    <p class="m-0">Adjusment note :</p>
                                                    <textarea name="" id="" cols="30" rows="10" style="min-width:100%;">

                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary px-4" data-dismiss="">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="txt-center">
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-warning no-wrap" data-toggle="modal"
                                    data-target="#modalAdjust">
                                    <span class="nowrap">Adjust</span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modalAdjust" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="exampleModalLongTitle">Modal menambahkan adjustment note</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex flex-row">
                                                    <p>Adjust Type : </p>
                                                    <p style="margin-left:1%;">Niko</p>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <p>Adjustment by : </p>
                                                    <p style="margin-left:1%;">Niko</p>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <p>Kode Item : </p>
                                                    <p style="margin-left:1%;">Niko</p>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <p>Adjustment QTY : </p>
                                                    <p style="margin-left:1%;">31-01-2023</p>
                                                </div>
                                            </div>
                                            <div class="alert alert-danger rounded-0" role="alert">
                                                Can't be undone
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary px-4" data-dismiss="">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
