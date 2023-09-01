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
                    <button type="button" class="btn-sm btn-primary bold-text mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Search
                    </button>
                    <button type="button" class="btn-sm btn-warning bold-text mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Show All
                    </button>
                    <button type="button" class="btn-sm btn-success bold-text mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Add New
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">BRANCH INFORMATION SHEET</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Nama</span></th>
                            <th class="thead-text"><span class="nowrap">Alamat</span></th>
                            <th class="thead-text"><span class="nowrap">Kode</span></th>
                            <th class="thead-text"><span class="nowrap">No Telp Cabang</span></th>
                            <th class="thead-text"><span class="nowrap">PIC</span></th>
                            <th class="thead-text"><span class="nowrap">No Telp PIC</span></th>
                            <th class="thead-text"><span class="nowrap">Init Supply</span></th>
                            <th class="thead-text"><span class="nowrap">Checkin Supply</span></th>
                            <th class="thead-text"><span class="nowrap">Checkout Supply</span></th>
                            <th class="thead-text"><span class="nowrap">Detail</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Anggito</td>
                            <td>Jl. Disitu Boleh</td>
                            <td>SI-155-25-40</td>
                            <td>456778903578</td>
                            <td>Anandito</td>
                            <td>432187654321</td>
                            <td>3500</td>
                            <td>1500</td>
                            <td>500</td>
                            <td>
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenterEdit" tabindex="-1" role="dialog"
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
                                                        <form method="post">
                                                            @csrf
                                                            @method("put")
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputNama"
                                                                            class="form-label">Nama</label>
                                                                        <input type="text" id="InputNama" name="Nama"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputAlamatss="
                                                                            form-label">Alamat</label>
                                                                        <input type="text" id="InputAlamate=" Alamat"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputKode"
                                                                            class="form-label">Kode</label>
                                                                        <div><input type="text" id="InputKode"
                                                                                name="Kode" class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputTelpCabang"
                                                                            class="form-label">No Telp Cabang</label>
                                                                        <div><input type="text" id="InputTelpCabang"
                                                                                name="TelpCabang" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPIC"
                                                                            class="form-label">PIC</label>
                                                                        <div><input type="text" id="InputPIC" name="PIC"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputTelpPIC" class="form-label">No
                                                                            Telp PIC</label>
                                                                        <div><input type="text" id="InputTelpPIC"
                                                                                name="TelpPIC" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputInitSupply"
                                                                            class="form-label">Init Supply</label>
                                                                        <div><input type="text" id="InputInitSupply"
                                                                                name="InitSupply" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputCheckInSupply"
                                                                            class="form-label">Checkin Supply</label>
                                                                        <div><input type="text" id="InputCheckInSupply"
                                                                                name="CheckInSupply"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputCheckOutSupply"
                                                                            class="form-label">Checkout Supply</label>
                                                                        <div><input type="text" id="InputCheckOutSupply"
                                                                                name="CheckOutSupply"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3 float-right">
                                                                        <button type="sumbit"
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
                                    data-target="#exampleModalCenterDelete">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenterDelete" tabindex="-1" role="dialog"
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
                                                <button type="button" class="btn btn-danger">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
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
                        <form method="post">
                            @csrf
                            <div class="row black-text">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputNama" class="form-label">Nama</label>
                                        <input type="text" id="InputNama" name="Nama" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputAlamatss=" form-label">Alamat</label>
                                        <input type="text" id="InputAlamate=" Alamat" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputKode" class="form-label">Kode</label>
                                        <div><input type="text" id="InputKode" name="Kode" class="form-control"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputTelpCabang" class="form-label">No Telp Cabang</label>
                                        <div><input type="text" id="InputTelpCabang" name="TelpCabang"
                                                class="form-control"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPIC" class="form-label">PIC</label>
                                        <div><input type="text" id="InputPIC" name="PIC" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputTelpPIC" class="form-label">No Telp PIC</label>
                                        <div><input type="text" id="InputTelpPIC" name="TelpPIC" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputInitSupply" class="form-label">Init Supply</label>
                                        <div><input type="text" id="InputInitSupply" name="InitSupply"
                                                class="form-control"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputCheckInSupply" class="form-label">Checkin Supply</label>
                                        <div><input type="text" id="InputCheckInSupply" name="CheckInSupply"
                                                class="form-control"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputCheckOutSupply" class="form-label">Checkout Supply</label>
                                        <div><input type="text" id="InputCheckOutSupply" name="CheckOutSupply"
                                                class="form-control"></div>
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
