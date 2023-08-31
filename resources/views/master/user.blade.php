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
            <button type="button" class="btn-sm btn-success float-right" data-toggle="modal"
                data-target="#exampleModalCenter">
                New User
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">USERS INFORMATION SHEET</h6>

        </div>
        <div class="card-body">
            <button type="button" class="btn-sm btn-success float-right" data-toggle="modal"
                data-target="#exampleModalCenter">
                New User
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><span class="nowrap">No</span></th>
                            <th><span class="nowrap">Username</span></th>
                            <th><span class="nowrap">NIK</span></th>
                            <th><span class="nowrap">Employee Name</span></th>
                            <th><span class="nowrap">Department</span></th>
                            <th><span class="nowrap">Section</span></th>
                            <th><span class="nowrap">Position</span></th>
                            <th><span class="nowrap">User Role</span></th>
                            <th><span class="nowrap">Plant</span></th>
                            <th><span class="nowrap">Detail</span></th>
                            <th><span class="nowrap">Delete</span></th>
                            <th><span class="nowrap">Status Active</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Teddy123</td>
                            <td>123456789</td>
                            <td>Teddy</td>
                            <td>SALES</td>
                            <td>SALES & PURCHASED</td>
                            <td>SALES HEAD</td>
                            <td>Administrator</td>
                            <td>KPS-IA|CENTRAL</td>
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
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Edit Data
                                                    User</h5>
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
                                                                        <label for="InputUsername"
                                                                            class="form-label">Username</label>
                                                                        <input type="text" id="InputNIK" name="Username"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputNIK"
                                                                            class="form-label">NIK</label>
                                                                        <input type="text" id="InputNIK" name="NIK"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputEmployeeName"
                                                                            class="form-label">Employee Name</label>
                                                                        <div><input type="text" id="InputEmployeeName"
                                                                                name="EmployeeName"
                                                                                class="form-control"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputDepartement"
                                                                            class="form-label">Departement</label>
                                                                        <div><input type="text" id="InputDepartement"
                                                                                name="Departement" class="form-control">
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                                <div class="col">
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
                                                                        <label for="InputUserRole"
                                                                            class="form-label">User Role</label>
                                                                        <div><input type="text" id="InputUserRole"
                                                                                name="UserRole" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPlant"
                                                                            class="form-label">Plant</label>
                                                                        <div><input type="text" id="InputPlant"
                                                                                name="Plant" class="form-control"></div>
                                                                    </div>



                                                                    <div class="mb-3 float-right">
                                                                        <button type="button"
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
                                                    data-bs-dismiss="modal">Close</button>
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
                            <td>
                                Active
                            </td>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Teddy123</td>
                            <td>123456789</td>
                            <td>Teddy</td>
                            <td>SALES</td>
                            <td>SALES & PURCHASED</td>
                            <td>SALES HEAD</td>
                            <td>Administrator</td>
                            <td>KPS-IA|CENTRAL</td>
                            <td>
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Warna</th>
                                                            <td><input type="text" name="warna" class="form-control">
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success">Update</button>
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
                            <td>
                                Active
                            </td>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Teddy123</td>
                            <td>123456789</td>
                            <td>Teddy</td>
                            <td>SALES</td>
                            <td>SALES & PURCHASED</td>
                            <td>SALES HEAD</td>
                            <td>Administrator</td>
                            <td>KPS-IA|CENTRAL</td>
                            <td>
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Warna</th>
                                                            <td><input type="text" name="warna" class="form-control">
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success">Update</button>
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
                            <td>
                                Active
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputUsername" class="form-label">Username</label>
                                        <input type="text" id="InputNIK" name="Username" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNIK" class="form-label">NIK</label>
                                        <input type="text" id="InputNIK" name="NIK" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputEmployeeName" class="form-label">Employee
                                            Name</label>
                                        <div><input type="text" id="InputEmployeeName" name="EmployeeName"
                                                class="form-control"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputDepartement" class="form-label">Departement</label>
                                        <div><input type="text" id="InputDepartement" name="Departement"
                                                class="form-control"></div>
                                    </div>

                                </div>
                                <div class="col">
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
                                        <label for="InputUserRole" class="form-label">User Role</label>
                                        <div><input type="text" id="InputUserRole" name="UserRole" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPlant" class="form-label">Plant</label>
                                        <div><input type="text" id="InputPlant" name="Plant" class="form-control"></div>
                                    </div>

                                    <div class="mb-3 float-right">
                                        <button type="button" class="btn btn-success">Submit</button>
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
