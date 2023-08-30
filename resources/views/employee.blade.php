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
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">EMPLOYEE INFORMATION SHEET</h6>

            <!-- Button trigger modal Add New-->
            <button type="button" class="btn-sm btn-success float-right" data-toggle="modal"
                data-target="#exampleModalCenter">
                New Employee
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title black-text" id="exampleModalLongTitle">New Data Employee</h5>
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
                                                    <label for="InputNIK" class="form-label">NIK</label>
                                                    <input type="text" id="InputNIK" name="NIK" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputEmployee" class="form-label">Employee Name</label>
                                                    <input type="text" id="InputEmployee" name="Employee Name"
                                                        class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputGender" class="form-label">Gender</label>
                                                    <div><input type="text" id="InputGender" name="Gender"
                                                            class="form-control"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputPhoto" class="form-label">Photo</label>
                                                    <div><input type="file" id="InputPhoto" name="Photo"
                                                            class="form-control" accept="image/png, image/jpg, image/jpeg"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputAddress" class="form-label">Address</label>
                                                    <div><input type="text" id="InputAddress" name="Address"
                                                            class="form-control"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputPhone" class="form-label">Phone</label>
                                                    <div><input type="text" id="InputPhone" name="Phone"
                                                            class="form-control"></div>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="InputMail" class="form-label">Mail</label>
                                                    <div><input type="text" id="InputMail" name="Mail"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputDepartement" class="form-label">Departement</label>
                                                    <div><input type="text" id="InputDepartement" name="Departement"
                                                            class="form-control"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputSection" class="form-label">Section</label>
                                                    <div><input type="text" id="InputSection" name="Section"
                                                            class="form-control"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputPosition" class="form-label">Position</label>
                                                    <div><input type="text" id="InputPosition" name="Position"
                                                            class="form-control"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputGroup" class="form-label">Group</label>
                                                    <div><input type="text" id="InputGroup" name="Group"
                                                            class="form-control"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="InputDomisili" class="form-label">Domisili Kerja</label>
                                                    <div><input type="text" id="InputDomisili" name="Domisili Kerja"
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
                            {{-- <button type="button" class="btn btn-success">Save</button> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><span class="nowrap">No</span></th>
                            <th><span class="nowrap">NIK</span></th>
                            <th><span class="nowrap">Employee Name</span></th>
                            <th><span class="nowrap">Gender</span></th>
                            <th><span class="nowrap">Photo</span></th>
                            <th><span class="nowrap">Address</span></th>
                            <th><span class="nowrap">Phone</span></th>
                            <th><span class="nowrap">Mail</span></th>
                            <th><span class="nowrap">Departement</span></th>
                            <th><span class="nowrap">Section</span></th>
                            <th><span class="nowrap">Position</span></th>
                            <th><span class="nowrap">Group</span></th>
                            <th><span class="nowrap">Domisili Kerja</span></th>
                            <th><span class="nowrap">Detail</span></th>
                            <th><span class="nowrap">Delete</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>123456</td>
                            <td>Divisi Informatika</td>
                            <td>Laki - Laki</td>
                            <td></td>
                            <td>PT. KARYA PUTRA SANGKURIANG</td>
                            <td>0</td>
                            <td>0</td>
                            <td>ADMIN</td>
                            <td>ADMIN</td>
                            <td>ADMINISTRATOR</td>
                            <td>ADMIN</td>
                            <td>BANDUNG</td>
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
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Employee</h5>
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
                                                                        <label for="InputNIK" class="form-label">NIK</label>
                                                                        <input type="text" id="InputNIK" name="NIK" class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputEmployee" class="form-label">Employee Name</label>
                                                                        <input type="text" id="InputEmployee" name="Employee Name"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputGender" class="form-label">Gender</label>
                                                                        <div><input type="text" id="InputGender" name="Gender"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPhoto" class="form-label">Photo</label>
                                                                        <div><input type="file" id="InputPhoto" name="Photo"
                                                                                class="form-control" accept="image/png, image/jpg, image/jpeg"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputAddress" class="form-label">Address</label>
                                                                        <div><input type="text" id="InputAddress" name="Address"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPhone" class="form-label">Phone</label>
                                                                        <div><input type="text" id="InputPhone" name="Phone"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputMail" class="form-label">Mail</label>
                                                                        <div><input type="text" id="InputMail" name="Mail"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputDepartement" class="form-label">Departement</label>
                                                                        <div><input type="text" id="InputDepartement" name="Departement"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputSection" class="form-label">Section</label>
                                                                        <div><input type="text" id="InputSection" name="Section"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPosition" class="form-label">Position</label>
                                                                        <div><input type="text" id="InputPosition" name="Position"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputGroup" class="form-label">Group</label>
                                                                        <div><input type="text" id="InputGroup" name="Group"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputDomisili" class="form-label">Domisili Kerja</label>
                                                                        <div><input type="text" id="InputDomisili" name="Domisili Kerja"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3 float-right">
                                                                        <button type="sumbit" class="btn btn-primary">Update</button>
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
                                                {{-- <button type="button" class="btn btn-success">Save</button> --}}
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
<!-- /.container-fluid -->
@endsection
