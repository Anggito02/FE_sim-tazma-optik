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
                    <button type="button" class="btn-sm btn-primary bold-text mt-4"><i
                            class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                    <button type="button" class="btn-sm btn-warning bold-text mt-4"><i class="fa-solid fa-eye"></i>
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
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Username</span></th>
                            <th class="thead-text"><span class="nowrap">NIK</span></th>
                            <th class="thead-text"><span class="nowrap">Name</span></th>
                            <th class="thead-text"><span class="nowrap">Department</span></th>
                            <th class="thead-text"><span class="nowrap">Section</span></th>
                            <th class="thead-text"><span class="nowrap">Position</span></th>
                            <th class="thead-text"><span class="nowrap">Role</span></th>
                            <th class="thead-text"><span class="nowrap">Plant</span></th>
                            <th class="thead-text"><span class="nowrap">Status</span></th>
                            <th class="thead-text"><span class="nowrap">Detail</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($employee as $val)
                        <tr>
                            <div class="d-none">
                                {{ $id = $val['id'] }}
                            </div>
                            <td class="txt-center"><span class="nowrap">{{$iterator}}</span></td>
                            <td><span class="nowrap">{{$val['username']}}</span></td>
                            <td><span class="nowrap">{{$val['nik']}}</span></td>
                            <td><span class="nowrap">{{ucwords($val['employee_name'])}}</span></td>
                            <td><span class="nowrap">{{ucwords($val['department'])}}</span></td>
                            <td><span class="nowrap">{{ucwords($val['section'])}}</span></td>
                            <td><span class="nowrap">{{$val['position']}}</span></td>
                            <td><span class="nowrap">{{ucwords($val['role'])}}</span></td>
                            <td><span class="nowrap">{{ucwords($val['plant'])}}</span></td>
                            @if ($val['status'] == 'active')
                            <td>
                                <span class="nowrap text-success">{{ucwords($val['status'])}}</span>
                            </td>
                            @elseif ($val['status'] == 'inactive')
                            <td>
                                <span class="nowrap text-white text-danger">{{ucwords($val['status'])}}</span>
                            </td>
                            @endif

                            <td>
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal Edit-->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
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
                                                        <form method="post" action="/employee/edit">
                                                            @csrf
                                                            @method("put")
                                                            <div class="row">
                                                                <input type="hidden" id="id" name="employee_id"
                                                                    class="form-control" value="{{ $val['id'] }}">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputUsername"
                                                                            class="form-label">Username</label>
                                                                        <input type="text" id="username" name="username"
                                                                            class="form-control"
                                                                            value="{{ $val['username']}}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputEmployee"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" id="employee_name"
                                                                            name="employee_name" class="form-control"
                                                                            value="{{ $val['employee_name']}}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputSection"
                                                                            class="form-label">Section</label>
                                                                        <div>

                                                                            <input type="text" id="section"
                                                                                name="section" class="form-control"
                                                                                value="{{ $val['section']}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputRole"
                                                                            class="form-label">Role</label>
                                                                        <select type="role"
                                                                            class="form-select form-control js-example-basic-single"
                                                                            id="InputRole" name="role">
                                                                            @if ($val['role'] == 'administrator')
                                                                            <option value="administrator" selected>
                                                                                administrator
                                                                            </option>
                                                                            <option value="user">user
                                                                            </option>
                                                                            @elseif ($val['role'] == 'user')
                                                                            <option value="administrator">
                                                                                administrator
                                                                            </option>
                                                                            <option value="user" selected>user
                                                                            </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputStatus"
                                                                            class="form-label">Status</label>
                                                                        <select type="status"
                                                                            class="form-select form-control"
                                                                            id="InputStatus" name="status">
                                                                            @if ($val['status'] == 'active')
                                                                            <option value="active" selected>
                                                                                active
                                                                            </option>
                                                                            <option value="inactive">
                                                                                inactive
                                                                            </option>
                                                                            @elseif ($val['status'] == 'inactive')
                                                                            <option value="active">
                                                                                active
                                                                            </option>
                                                                            <option value="inactive" selected>
                                                                                inactive
                                                                            </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>


                                                                </div>
                                                                <div class="col">

                                                                    <div class="mb-3">
                                                                        <label for="InputNIK"
                                                                            class="form-label">NIK</label>
                                                                        <input type="number" id="nik" name="nik"
                                                                            class="form-control"
                                                                            value="{{ $val['nik']}}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputDepartment"
                                                                            class="form-label">Department</label>
                                                                        <div><input type="text" id="department"
                                                                                name="department" class="form-control"
                                                                                value="{{ $val['department']}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPosition"
                                                                            class="form-label">Position</label>
                                                                        <div><input type="text" id="position"
                                                                                name="position" class="form-control"
                                                                                value="{{ $val['position']}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPlant"
                                                                            class="form-label">Plant</label>
                                                                        <div><input type="text" id="plant" name="plant"
                                                                                class="form-control"
                                                                                value="{{ $val['plant']}}">
                                                                        </div>
                                                                    </div>



                                                                    <div class="mt-5 float-right">
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
                                                <form method="post" action="/employee/delete">
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
                        <form method="post" action="/employee/add">
                            @csrf
                            @method("POST")
                            <div class="row black-text">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputUsername" class="form-label">Username</label>
                                        <input type="text" id="username" name="username" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNik" class="form-label">NIK</label>
                                        <input type="number" id="nik" name="nik" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputDepartment" class="form-label">Department</label>
                                        <div><input type="text" id="department" name="department" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPosition" class="form-label">Position</label>
                                        <div><input type="text" id="position" name="position" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPlant" class="form-label">Plant</label>
                                        <div><input type="text" id="plant" name="plant" class="form-control"></div>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputPhoto" class="form-label">Photo</label>
                                        <div><input type="file" id="photo" name="photo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputEmployee" class="form-label">Name</label>
                                        <div><input type="text" id="employee_name" name="employee_name"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputSection" class="form-label">Section</label>
                                        <div><input type="text" id="section" name="section" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputRole" class="form-label">Role</label>
                                        <select type="role" name="role" class="form-select form-control" id="inputRole">
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <option value="administrator">administrator</option>
                                            <option value="user">user</option>
                                        </select>

                                    </div>

                                    <div class="mb-3">
                                        <label for="InputStatus" class="form-label">Status</label>
                                        <select type="status" name="status" class="form-select form-control"
                                            id="inputStatus">
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <option value="active">active</option>
                                            <option value="inactive">inactive</option>
                                        </select>
                                    </div>

                                    <div class="mt-5 float-right">
                                        <button type="submit" class="btn btn-success">Submit</button>
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
