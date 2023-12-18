@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col mb-2">
                    <div>
                        <label for="InputName" class="form-label black-text">First Name</label>
                        <input type="name" class="form-control" id="InputName">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputKode" class="form-label black-text">Last Name</label>
                        <input type="kode" class="form-control" id="InputKode">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputKode" class="form-label black-text">City</label>
                        <input type="kode" class="form-control" id="InputKode">
                    </div>
                </div>
                <div class="col mb-2">
                    <div>
                        <label for="InputKode" class="form-label black-text">Branch</label>
                        <input type="kode" class="form-control" id="InputKode">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="d-flex flex-row justify-content-end">
                    <button type="button" class="btn-sm btn-primary bold-text mt-4 mx-2"><i
                            class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                    <button type="button" class="btn-sm btn-warning bold-text mt-4 mx-2"><i class="fa-solid fa-eye"></i>
                        Show All
                    </button>
                    <button type="button" class="btn-sm btn-success bold-text mt-4 ml-2" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                        New Customer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">First Name</span></th>
                            <th class="thead-text"><span class="nowrap">Last Name</span></th>
                            <th class="thead-text"><span class="nowrap">Email</span></th>
                            <th class="thead-text"><span class="nowrap">Phone Number</span></th>
                            <th class="thead-text"><span class="nowrap">Address</span></th>
                            <th class="thead-text"><span class="nowrap">City</span></th>
                            <th class="thead-text"><span class="nowrap">Date Birth</span></th>
                            <th class="thead-text"><span class="nowrap">Gender</span></th>
                            <th class="thead-text"><span class="nowrap">Branch</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <div class="d-none">
                            {{-- {{ $iterator = 1 }} --}}
                        </div>
                        {{-- @foreach ($branch as $vals) --}}
                        <tr>
                            <div class="d-none">
                                {{-- {{ $id = $vals['id'] }} --}}
                            </div>
                            <td class="txt-center">1</td>
                            <td><span class="nowrap">Anggito</span></td>
                            <td><span class="nowrap">Anju</span></td>
                            <td><span class="nowrap">anggito@tazma.com</span></td>
                            <td><span class="nowrap">082212346789</span></td>
                            <td><span class="nowrap">Jln. Soekarno Hatta G242</span></td>
                            <td><span class="nowrap">Bandung</span></td>
                            <td><span class="nowrap">31 Mei 1989</span></td>
                            <td><span class="nowrap">Laki-Laki</span></td>
                            <td><span class="nowrap">Cimahi</span></td>
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
                                                        <form method="post" action="">
                                                            @csrf
                                                            @method("PUT")

                                                            <div class="row">
                                                                <input type="hidden" id="id_branch " name="id_branch"
                                                                    class="form-control" value="">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputKode"
                                                                            class="form-label">First Name</label>
                                                                        <input type="text" id="kode_branch"
                                                                            name="kode_branch" class="form-control"
                                                                            value="">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputNama"
                                                                            class="form-label">Last Name</label>
                                                                        <input type="text" id="nama_branch"
                                                                            name="nama_branch" class="form-control"
                                                                            value="">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputNama"
                                                                            class="form-label">Email</label>
                                                                        <input type="text" id="nama_branch"
                                                                            name="nama_branch" class="form-control"
                                                                            value="">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputNama"
                                                                            class="form-label">Phone Number</label>
                                                                        <input type="text" id="nama_branch"
                                                                            name="nama_branch" class="form-control"
                                                                            value="">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputNama"
                                                                            class="form-label">Address</label>
                                                                        <input type="text" id="nama_branch"
                                                                            name="nama_branch" class="form-control"
                                                                            value="">
                                                                    </div>

                                                                </div>
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputAlamat"
                                                                            class="form-label">City</label>
                                                                        <div><input type="text" id="alamat_branch"
                                                                                name="alamat_branch"
                                                                                class="form-control"
                                                                                value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputAlamat"
                                                                            class="form-label">Date Birth</label>
                                                                        <div><input type="date" id="alamat_branch"
                                                                                name="alamat_branch"
                                                                                class="form-control"
                                                                                value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 d-flex flex-column">
                                                                        <label for="InputGender"
                                                                            class="form-label">Gender</label>
                                                                        <select type="employee_name"
                                                                            class="form-control select2"
                                                                            name="employee_id_branch">
                                                                            <option value="" disabled selected hidden>Laki-Laki</option>
                                                                            <option value="">Laki-Laki</option>
                                                                            <option value="">Laki-Laki</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3 d-flex flex-column">
                                                                        <label for="InputGender"
                                                                            class="form-label">Branch</label>
                                                                        <select type="employee_name"
                                                                            class="form-control select2"
                                                                            name="employee_id_branch">
                                                                            <option value="" disabled selected hidden>Cimahi</option>
                                                                            <option value="">Cimahi</option>
                                                                            <option value="">Lembang</option>
                                                                            <option value="">Buah Batu</option>
                                                                            <option value="">Cileunyi</option>
                                                                            <option value="">Siliwangi</option>
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
                                    data-target="#exampleModalCenterDelete">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenterDelete" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Data Customer
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
                                                <form method="post" action="">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" id="id" name="branch_id"
                                                        class="form-control" value="">
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <div class="d-none">
                            {{-- {{ $iterator = $iterator + 1}} --}}
                        </div>
                        {{-- @endforeach --}}

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
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Data Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="POST" action="">
                            @csrf
                            @method("POST")
                            <div class="row black-text">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputKode"
                                            class="form-label">First Name</label>
                                        <input type="text" id="kode_branch"
                                            name="kode_branch" class="form-control"
                                            value="">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNama"
                                            class="form-label">Last Name</label>
                                        <input type="text" id="nama_branch"
                                            name="nama_branch" class="form-control"
                                            value="">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNama"
                                            class="form-label">Email</label>
                                        <input type="text" id="nama_branch"
                                            name="nama_branch" class="form-control"
                                            value="">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNama"
                                            class="form-label">Phone Number</label>
                                        <input type="text" id="nama_branch"
                                            name="nama_branch" class="form-control"
                                            value="">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNama"
                                            class="form-label">Address</label>
                                        <input type="text" id="nama_branch"
                                            name="nama_branch" class="form-control"
                                            value="">
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputAlamat"
                                            class="form-label">City</label>
                                        <div><input type="text" id="alamat_branch"
                                                name="alamat_branch"
                                                class="form-control"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputAlamat"
                                            class="form-label">Date Birth</label>
                                        <div><input type="date" id="alamat_branch"
                                                name="alamat_branch"
                                                class="form-control"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex flex-column">
                                        <label for="InputGender"
                                            class="form-label">Gender</label>
                                        <select type="employee_name"
                                            class="form-control select2"
                                            name="employee_id_branch">
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <option value="">Laki-Laki</option>
                                            <option value="">Laki-Laki</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 d-flex flex-column">
                                        <label for="InputGender"
                                            class="form-label">Branch</label>
                                        <select type="employee_name"
                                            class="form-control select2"
                                            name="employee_id_branch">
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <option value="">Cimahi</option>
                                            <option value="">Lembang</option>
                                            <option value="">Buah Batu</option>
                                            <option value="">Cileunyi</option>
                                            <option value="">Siliwangi</option>
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
