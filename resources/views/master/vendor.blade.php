@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-4 mb-2">
                    <div>
                        <label for="InputName" class="form-label">Name</label>
                        <input type="name" class="form-control" id="InputName">
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <div>
                        <label for="InputPIC" class="form-label">PIC</label>
                        <input type="pic" class="form-control" id="InputPIC">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div>
                        <label for="InputKode" class="form-label">Kode</label>
                        <input type="kode" class="form-control" id="InputKode">
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label for="InputStatus" class="form-label">Status</label>
                        <select type="status" class="form-select form-control" id="InputStatus">
                            <option>Active</option>
                        </select>
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
                        New Vendor
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">VENDOR INFORMATION SHEET</h4>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Kode</span></th>
                            <th class="thead-text"><span class="nowrap">NPWP</span></th>
                            <th class="thead-text"><span class="nowrap">Nama</span></th>
                            <th class="thead-text"><span class="nowrap">Alamat</span></th>
                            <th class="thead-text"><span class="nowrap">Nomor Telpon Vendor</span></th>
                            <th class="thead-text"><span class="nowrap">PIC</span></th>
                            <th class="thead-text"><span class="nowrap">No Telp PIC</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Awal Persediaan</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Terakhir Persediaan</span></th>
                            <th class="thead-text"><span class="nowrap">Status</span></th>
                            <th class="thead-text"><span class="nowrap">Detail</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <div class="d-none">
                            {{ $i = 1 }}
                        </div>
                        @foreach ($vendor as $val)
                        <tr>
                            <div class="d-none">
                                {{ $id = $val['id'] }}
                            </div>
                            <td class="txt-center"><span class="nowrap">{{$i}}</span></td>
                            <td><span class="nowrap">{{$val['kode_vendor']}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['npwp_vendor']}}</span></td>
                            <td><span class="nowrap">{{ucwords($val['nama_vendor'])}}</span></td>
                            <td><span class="nowrap">{{ucwords($val['alamat_vendor'])}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['no_telp_vendor']}}</span></td>
                            <td><span class="nowrap">{{$val['pic_vendor']}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['no_telp_pic']}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['init_date_supply']}}</span></td>
                            <td class="txt-right"><span class="nowrap">{{$val['last_date_supply']}}</span></td>
                            @if ($val['status_blacklist'] == 0)
                            <td>
                                <span class="nowrap text-white text-success">Active</span>
                            </td>
                            @elseif ($val['status_blacklist'] == 1)
                            <td>
                                <span class="nowrap text-white text-danger">Blacklist</span>
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
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Vendor</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <form method="post" action="/vendors/edit">
                                                            @csrf
                                                            @method("put")
                                                            <div class="row">
                                                                <input type="hidden" id="id" name="id"
                                                                    class="form-control" value="{{ $val['id'] }}">
                                                                <div class="col">
                                                                    <div class="mb-3">
                                                                        <label for="InputKode"
                                                                            class="form-label">Kode</label>
                                                                        <div><input type="text" id="kode_vendor"
                                                                                name="kode_vendor" class="form-control"
                                                                                value="{{ $val['kode_vendor']}}"></div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputNama"
                                                                            class="form-label">Nama</label>
                                                                        <input type="text" id="nama_vendor"
                                                                            name="nama_vendor" class="form-control"
                                                                            value="{{ $val['nama_vendor'] }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputTelpVendor"
                                                                            class="form-label">No Telp Vendor</label>
                                                                        <div><input type="number" id="no_telp_vendor"
                                                                                name="no_telp_vendor"
                                                                                class="form-control"
                                                                                value="{{ $val['no_telp_vendor'] }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputPIC"
                                                                            class="form-label">PIC</label>
                                                                        <div><input type="text" id="pic_vendor"
                                                                                name="pic_vendor" class="form-control"
                                                                                value="{{ $val['pic_vendor'] }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputInitDateSupply"
                                                                            class="form-label">Tanggal Awal
                                                                            Persediaan</label>
                                                                        <div><input type="date" id="init_date_supply"
                                                                                name="init_date_supply"
                                                                                class="form-control"
                                                                                value="{{ $val['init_date_supply']}}">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col">

                                                                    <div class="mb-3">
                                                                        <label for="InputNPWP"
                                                                            class="form-label">NPWP</label>
                                                                        <div><input type="number" id="npwp_vendor"
                                                                                name="npwp_vendor" class="form-control"
                                                                                value="{{ $val['npwp_vendor'] }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputAlamat"
                                                                            class="form-label">Alamat</label>
                                                                        <input type="text" id="alamat_vendor"
                                                                            name="alamat_vendor" class="form-control"
                                                                            value="{{ $val['alamat_vendor'] }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputTelpPIC" class="form-label">No
                                                                            Telp PIC</label>
                                                                        <div><input type="text" id="no_telp_pic"
                                                                                name="no_telp_pic" class="form-control"
                                                                                value="{{ $val['no_telp_pic']}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputStatus"
                                                                            class="form-label">Status</label>
                                                                        <select type="status_blacklist"
                                                                            class="form-select form-control"
                                                                            name="status_blacklist"
                                                                            id="status_blacklist">
                                                                            @if ($val['status_blacklist'] == 0)
                                                                            <option value="0" selected>Active</option>
                                                                            <option value="1">Blacklist</option>
                                                                            @elseif ($val['status_blacklist'] == 1)
                                                                            <option value="0">Active</option>
                                                                            <option value="1" selected>Blacklist
                                                                            </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="InputLastDateSupply"
                                                                            class="form-label">Tanggal Terakhir
                                                                            Persediaan</label>
                                                                        <div><input type="date" id="last_date_supply"
                                                                                name="last_date_supply"
                                                                                class="form-control"
                                                                                value="{{ $val['last_date_supply']}}">
                                                                        </div>
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
                                    data-target="#exampleModalCenterDelete{{$id}}">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal delete -->
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
                                                <form method="post" action="/vendors/delete">
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
                            {{ $i++ }}
                        </div>
                        @endforeach
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
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Data Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body black-text">
                    <div class="container-fluid">
                        <form method="post" action="/vendors/add">
                            @csrf
                            @method("POST")
                            <div class="row">
                                <div class="col">

                                    <div class="mb-3">
                                        <label for="InputKode" class="form-label">Kode</label>
                                        <input type="text" id="kode_vendor" name="kode_vendor" class="form-control">

                                    </div>

                                    <div class="mb-3">
                                        <label for="InputNama" class="form-label">Nama</label>
                                        <input type="text" id="nama_vendor" name="nama_vendor" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputTelpVendor" class="form-label">No Telp Vendor</label>
                                        <input type="text" id="no_telp_vendor" name="no_telp_vendor"
                                            class="form-control">

                                    </div>

                                    <div class="mb-3">
                                        <label for="InputPIC" class="form-label">PIC</label>
                                        <input type="text" id="pic_vendor" name="pic_vendor" class="form-control">

                                    </div>



                                </div>
                                <div class="col">

                                    <div class="mb-3">
                                        <label for="InputNPWP" class="form-label">NPWP</label>
                                        <input type="number" id="npwp_vendor" name="npwp_vendor" class="form-control">

                                    </div>

                                    <div class="mb-3">
                                        <label for="InputAlamat" class="form-label">Alamat</label>
                                        <input type="text" id="alamat_vendor" name="alamat_vendor" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputTelpPIC" class="form-label">No
                                            Telp PIC</label>
                                        <input type="text" id="no_telp_pic" name="no_telp_pic" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="InputInitDateSupply" class="form-label">Tanggal Awal
                                            Persediaan</label>
                                        <input type="date" id="init_date_supply" name="init_date_supply"
                                            class="form-control">
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="InputStatus" class="form-label">Status</label>
                                        <select type="status_blacklist" class="form-select form-control"
                                            name="status_blacklist" id="status_blacklist">
                                            <option value="" disabled selected hidden>Choose...</option>
                                            <option value="0">Active</option>
                                            <option value="1">Blacklist</option>
                                        </select>
                                    </div> --}}

                                    {{-- <div class="mb-3">
                                        <label for="InputLastDateSupply" class="form-label">Tanggal Terakhir
                                            Persediaan</label>
                                        <input type="date" id="last_date_supply" name="last_date_supply"
                                            class="form-control">
                                    </div> --}}

                                    <div class="mb-3 float-right">
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
            </div>
        </div>
    </div>
</div>
@endsection
