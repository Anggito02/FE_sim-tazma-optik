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
                            <h5 class="modal-title" id="exampleModalLongTitle">New Data Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="post">
                                        <div class="row">
                                            <label for="InputNIK" class="form-label">NIK</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputNIK" name="NIK" class="form-control"></div>
                                            <label for="InputEmployee" class="form-label">Employee Name</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputEmployee" name="Employee Name" class="form-control"></div>
                                        </div>
                                        <div class="row">
                                            <label for="InputGender" class="form-label">Gender</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputGender" name="Gender" class="form-control"></div>
                                            <label for="InputPhoto" class="form-label">Photo</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputPhoto" name="Photo" class="form-control"></div>
                                        </div>
                                        <div class="row">
                                            <label for="InputAddress" class="form-label">Address</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputAddress" name="Address" class="form-control"></div>
                                            <label for="InputPhone" class="form-label">Phone</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputPhone" name="Phone" class="form-control"></div>
                                        </div>
                                        <div class="row">
                                            <label for="InputMail" class="form-label">Mail</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputMail" name="Mail" class="form-control"></div>
                                            <label for="InputDepartement" class="form-label">Departement</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputDepartement" name="Departement" class="form-control"></div>
                                        </div>
                                        <div class="row">
                                            <label for="InputSection" class="form-label">Section</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputSection" name="Section" class="form-control"></div>
                                            <label for="InputPosition" class="form-label">Position</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputPosition" name="Position" class="form-control"></div>
                                        </div>
                                        <div class="row">
                                            <label for="InputGroup" class="form-label">Group</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputGroup" name="Group" class="form-control"></div>
                                            <label for="InputDomisili" class="form-label">Domisili Kerja</label>
                                            <div class="col-md-4 ms-auto"><input type="text" id="InputDomisili" name="Domisili Kerja" class="form-control"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- <form method="post" action="">
                                @csrf
                                <div class="container text-center">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Email
                                                    address</label>
                                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                                    placeholder="name@example.com">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            2 of 3 (wider)
                                        </div>
                                        <div class="col">
                                            3 of 3
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            1 of 3
                                        </div>
                                        <div class="col-5">
                                            2 of 3 (wider)
                                        </div>
                                        <div class="col">
                                            3 of 3
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>NIK</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Employee Name</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Mail</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Departement</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Section</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Position</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Group</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <th>Domisili Kerja</th>
                                        <td><input type="text" name="title" value="" class="form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" class="btn btn-success" />
                                        </td>
                                    </tr>
                                </table>
                            </form> -->
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
                            <th>No</th>
                            <th>NIK</th>
                            <th>Employee Name</th>
                            <th>Gender</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Mail</th>
                            <th>Departement</th>
                            <th>Section</th>
                            <th>Position</th>
                            <th>Group</th>
                            <th>Domisili Kerja</th>
                            <th>Detail</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Employee Name</th>
                            <th>Gender</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Mail</th>
                            <th>Departement</th>
                            <th>Section</th>
                            <th>Position</th>
                            <th>Group</th>
                            <th>Domisili Kerja</th>
                            <th>Detail</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
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
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="">
                                                    @csrf
                                                    @method('PUT')
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>NIK</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Employee Name</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Gender</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Photo</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mail</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Departement</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Section</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Position</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Group</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Domisili Kerja</th>
                                                            <td><input type="text" name="title" value=""
                                                                    class="form-control" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <input type="submit" class="btn btn-primary" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
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
