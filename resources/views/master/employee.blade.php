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
                        <label for="InputEmployee" class="form-label">Employee Name</label>
                        <input type="employee" class="form-control" id="InputEmployee">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputGender" class="form-label">Gender</label>
                        <select type="gender" class="form-select form-control" id="InputGender">
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputDepartment" class="form-label">Department</label>
                        <select type="department" class="form-select form-control" id="InputDepartment">
                            <option>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputSection" class="form-label">Section</label>
                        <select type="section" class="form-select form-control" id="InputSection">
                            <option>Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>
                        <label for="InputPosition" class="form-label">Position</label>
                        <select type="position" class="form-select form-control" id="InputPosition">
                            <option>Sales Head</option>
                            <option>Administrator</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label for="InputGroup" class="form-label">User Group</label>
                        <select type="group" class="form-select form-control" id="InputGroup">
                            <option>Administrator</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label for="InputDomisili" class="form-label">Domisili Kerja</label>
                        <input type="domisili" class="form-control" id="InputDomisili">
                    </div>
                </div>
                <div class="col">
                    <button type="button" class="btn-sm btn-primary bold-text mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                    <button type="button" class="btn-sm btn-warning bold-text mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa-solid fa-eye"></i>
                        Show All
                    </button>
                    <button type="button" class="btn-sm btn-success bold-text mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                        Add New
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">EMPLOYEE INFORMATION SHEET</h6>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">NIK</span></th>
                            <th class="thead-text"><span class="nowrap">Employee Name</span></th>
                            <th class="thead-text"><span class="nowrap">Gender</span></th>
                            <th class="thead-text"><span class="nowrap">Photo</span></th>
                            <th class="thead-text"><span class="nowrap">Address</span></th>
                            <th class="thead-text"><span class="nowrap">Phone</span></th>
                            <th class="thead-text"><span class="nowrap">Mail</span></th>
                            <th class="thead-text"><span class="nowrap">Departement</span></th>
                            <th class="thead-text"><span class="nowrap">Section</span></th>
                            <th class="thead-text"><span class="nowrap">Position</span></th>
                            <th class="thead-text"><span class="nowrap">Group</span></th>
                            <th class="thead-text"><span class="nowrap">Domisili Kerja</span></th>
                            <th class="thead-text"><span class="nowrap">Detail</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>
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
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Employee
                                                </h5>
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
                                                                        <label for="InputNIK"
                                                                            class="form-label">NIK</label>
                                                                        <input type="text" id="InputNIK" name="NIK"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputEmployee"
                                                                            class="form-label">Employee Name</label>
                                                                        <input type="text" id="InputEmployee"
                                                                            name="Employee Name" class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputGender"
                                                                            class="form-label">Gender</label>
                                                                        <div><input type="text" id="InputGender"
                                                                                name="Gender" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPhoto"
                                                                            class="form-label">Photo</label>
                                                                        <div><input type="file" id="InputPhoto"
                                                                                name="Photo" class="form-control"
                                                                                accept="image/png, image/jpg, image/jpeg">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputAddress"
                                                                            class="form-label">Address</label>
                                                                        <div><input type="text" id="InputAddress"
                                                                                name="Address" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPhone"
                                                                            class="form-label">Phone</label>
                                                                        <div><input type="text" id="InputPhone"
                                                                                name="Phone" class="form-control"></div>
                                                                    </div>

                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputMail"
                                                                            class="form-label">Mail</label>
                                                                        <div><input type="text" id="InputMail"
                                                                                name="Mail" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputDepartement"
                                                                            class="form-label">Departement</label>
                                                                        <div><input type="text" id="InputDepartement"
                                                                                name="Departement" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputSection"
                                                                            class="form-label">Section</label>
                                                                        <div><input type="text" id="InputSection"
                                                                                name="Section" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPosition"
                                                                            class="form-label">Position</label>
                                                                        <div><input type="text" id="InputPosition"
                                                                                name="Position" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputGroup"
                                                                            class="form-label">Group</label>
                                                                        <div><input type="text" id="InputGroup"
                                                                                name="Group" class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputDomisili"
                                                                            class="form-label">Domisili Kerja</label>
                                                                        <div><input type="text" id="InputDomisili"
                                                                                name="Domisili Kerja"
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
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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
                                        <input type="text" id="InputEmployee" name="Employee Name" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputGender" class="form-label">Gender</label>
                                        <div><input type="text" id="InputGender" name="Gender" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPhoto" class="form-label">Photo</label>
                                        <div><input type="file" id="InputPhoto" name="Photo" class="form-control"
                                                accept="image/png, image/jpg, image/jpeg"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputAddress" class="form-label">Address</label>
                                        <div><input type="text" id="InputAddress" name="Address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPhone" class="form-label">Phone</label>
                                        <div><input type="text" id="InputPhone" name="Phone" class="form-control"></div>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputMail" class="form-label">Mail</label>
                                        <div><input type="text" id="InputMail" name="Mail" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputDepartement" class="form-label">Departement</label>
                                        <div><input type="text" id="InputDepartement" name="Departement"
                                                class="form-control"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputSection" class="form-label">Section</label>
                                        <div><input type="text" id="InputSection" name="Section" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPosition" class="form-label">Position</label>
                                        <div><input type="text" id="InputPosition" name="Position" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputGroup" class="form-label">Group</label>
                                        <div><input type="text" id="InputGroup" name="Group" class="form-control"></div>
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
@endsection
