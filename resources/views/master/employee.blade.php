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
            <div class="row black-text">
                <div class="col mb-2">
                    <div>
                        <label for="InputEmployee" class="form-label">Employee Name</label>
                        <input type="employee" class="form-control" id="InputEmployee">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputGender" class="form-label">Gender</label>
                        <select type="gender" class="form-control" id="">
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
            <div class="row black-text">
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
                        <input type="text" class="form-control" id="InputDomisili">
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
                        Register
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
                            <th class="thead-text"><span class="nowrap">Name</span></th>
                            <th class="thead-text"><span class="nowrap">Username</span></th>
                            <th class="thead-text"><span class="nowrap">Email</span></th>
                            <th class="thead-text"><span class="nowrap">NIK</span></th>
                            <th class="thead-text"><span class="nowrap">NIP</span></th>
                            <th class="thead-text"><span class="nowrap">Phone</span></th>
                            <th class="thead-text"><span class="nowrap">Domisili</span></th>
                            <th class="thead-text"><span class="nowrap">Group</span></th>
                            <th class="thead-text"><span class="nowrap">Department</span></th>
                            <th class="thead-text"><span class="nowrap">Section</span></th>
                            <th class="thead-text"><span class="nowrap">Position</span></th>
                            <th class="thead-text"><span class="nowrap">Role</span></th>
                            <th class="thead-text"><span class="nowrap">Cabang</span></th>
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
                            <td class="txt-center"><span class="nowrap">{{ucwords($val['employee_name'])}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{$val['username']}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{$val['email']}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['nik']}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['nip']}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['phone']}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{$val['domicile']}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{ucwords($val['group'])}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{ucwords($val['department'])}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{$val['section']}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{ucwords($val['position'])}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{ucwords($val['role'])}}</span></td>
                            <td class="txt-center"><span class="nowrap">{{ucwords($val['nama_branch'])}}</span></td>
                            @if ($val['status'] == '1')
                            <td class="txt-center">
                                <span class="nowrap text-success">Active</span>
                            </td>
                            @elseif ($val['status'] == '0')
                            <td class="txt-center">
                                <span class="nowrap text-white text-danger">Inactive</span>
                            </td>
                            @endif

                            <td class="">
                                <!-- Button trigger modal Edit -->
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal Edit-->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                                <form method="post" action="/employee/edit">
                                                    @csrf
                                                    @method("put")
                                                    <div class="row">
                                                        <input type="hidden" id="id" name="employee_id" value="{{ $val['id'] }}">
                                                        <div class="col">
                                                            <div class="d-flex flex-column justify-content-between">
                                                                <div class="mb-2">
                                                                    <label for="" class="form-label">Data Diri</label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Email</label>
                                                                    <input type="text" class="form-control" name="email" value="{{ $val['email']}}" readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="InputUsername" class="form-label">Username</label>
                                                                    <input type="text" id="username" name="username" class="form-control" value="{{ $val['username']}}" readonly>
                                                                </div>
                                                                
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Nama</label>
                                                                    <input type="text" name="employee_name" class="form-control" value="{{ $val['employee_name']}}" readonly>
                                                                </div>
                                                                
                                                                <div class="mb-3">
                                                                    <label for="InputNIK" class="form-label">NIK</label>
                                                                    <input type="number" id="nik" name="nik" class="form-control" value="{{ $val['nik']}}" readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">NIP</label>
                                                                    <input type="number" name="nip" class="form-control" value="{{ $val['nip']}}" readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="InputPhone" class="form-label">No HP</label>
                                                                    <input type="text" name="phone" class="form-control" value="{{ $val['phone']}}">
                                                                </div>
                                                                
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Alamat</label>
                                                                    <input type="text" name="address" class="form-control" value="{{ $val['address']}}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Gender</label>
                                                                    <input type="text" name="gender" class="form-control" value="{{ $val['gender']}}" readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="InputDomisili" class="form-label">Domisili</label>
                                                                    <input type="text" id="domisili" name="domicile" class="form-control" value="{{ $val['domicile']}}">
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="d-flex flex-column justify-content-between">
                                                                <div>
                                                                    <div class="mb-2">
                                                                        <label for="">Pekerjaan</label>
                                                                    </div>
        
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Group</label>
                                                                        <input type="text" name="group" class="form-control" value="{{ $val['group']}}">
                                                                    </div>
                                                                    
                                                                    <div class="mb-3">
                                                                        <label for="InputDepartment" class="form-label">Department</label>
                                                                        <input type="text" id="department" name="department" class="form-control" value="{{ $val['department']}}">
                                                                    </div>
                                                                    
                                                                    <div class="mb-3">
                                                                        <label for="InputSection" class="form-label">Section</label>
                                                                        <input type="text" id="section" name="section" class="form-control" value="{{ $val['section']}}">
                                                                    </div>
                                                                    
                                                                    <div class="mb-3">
                                                                        <label for="InputPosition" class="form-label">Position</label>
                                                                        <input type="text" id="position" name="position" class="form-control" value="{{ $val['position']}}">
                                                                    </div>
        
                                                                    <div class="mb-3">
                                                                        <label for="InputRole" class="form-label">Role</label>
                                                                        <select type="role" class="form-select form-control js-example-basic-single" id="InputRole" name="role">
                                                                            @if ($val['role'] == 'administrator')
                                                                            <option value="administrator" selected>
                                                                                Administrator
                                                                            </option>
                                                                            <option value="user">
                                                                                User
                                                                            </option>
                                                                            @elseif ($val['role'] == 'user')
                                                                            <option value="administrator">
                                                                                Administrator
                                                                            </option>
                                                                            <option value="user" selected>
                                                                                User
                                                                            </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
        
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Cabang</label>
                                                                        <select name="branch_id" class="form-control" id="">
                                                                            <option value="{{$val['branch_id']}}" selected hidden disabled>{{$val['nama_branch']}}</option>
                                                                            @foreach ($branch as $cabang)
                                                                            <option value="{{ $cabang['id'] }}">{{ $cabang['nama_branch'] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
            
                                                                    <div class="mb-3">
                                                                        <label for="InputStatus" class="form-label">Status</label>
                                                                        <select class="form-select form-control" id="InputStatus" name="status">
                                                                            @if ($val['status'] == '1')
                                                                                <option value="1" selected>Active</option>
                                                                                <option value="0">Inactive</option>
                                                                            @elseif ($val['status'] == '0')
                                                                                <option value="1">Active</option>
                                                                                <option value="0" selected>Inactive</option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <div class="mt-5 float-right">
                                                                        <button type="sumbit" class="btn btn-primary">Update</button>
                                                                    </div>
                                                                </div>
    
                                                            </div>
                                                        </div>
                                                    </div>
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
                            <td class="">
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                        <form method="post" action="/employee/add" enctype="multipart/form-data">
                            @csrf
                            @method("POST")

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <p>Akun</p>
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputUsername" class="form-label">Email</label>
                                    <input type="email" id="username" name="email" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputUsername" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputPassword" class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control" minlength="8"
                                    maxlength="20">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <p>Data Diri</p>
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputName" class="form-label">Nama</label>
                                    <input type="text" id="name" name="employee_name" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputNIK" class="form-label">NIK</label>
                                    <input type="number" id="nik" name="nik" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputNIP" class="form-label">NIP</label>
                                    <input type="number" id="nip" name="nip" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputGender" class="form-label">Gender</label>
                                    <select type="gender" name="gender" class="form-control" id="">
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputAddress" class="form-label">Alamat</label>
                                    <input type="text" id="address" name="address" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputPhone" class="form-label">Nomor Telpon</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputDomicile" class="form-label">Domisili</label>
                                    <input type="text" id="domicile" name="domicile" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <p>Bagian Pekerjaan, Posisi, dan lain-lain</p>
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputDepartment" class="form-label">Department</label>
                                    <input type="text" id="department" name="department" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputSection" class="form-label">Section</label>
                                    <input type="text" id="section" name="section" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputPosition" class="form-label">Jabatan</label>
                                    <input type="text" id="position" name="position" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputGroup" class="form-label">Group</label>
                                    <input type="text" id="group" name="group" class="form-control">
                                </div>
                                <div class="col-md-4 black-text">
                                    <label for="InputBranch" class="form-label">Cabang</label>
                                    <select name="branch_id" class="form-select form-control">
                                        <option value="" disabled selected hidden>Choose...</option>
                                        @foreach ($branch as $val)
                                        <option value="{{ $val['id'] }}">{{ $val['nama_branch'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="status" name="status" value="1">
                                <input type="hidden" id="role" name="role" value="User">
                            </div>

                            <div class="row black-text">
                                
                                <div class="col">
                                    <div class="mt-4 float-right">
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
