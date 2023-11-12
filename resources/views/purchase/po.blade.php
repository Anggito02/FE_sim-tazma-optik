@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body black-text">
            <button type="button" class="btn-sm btn-success float-right bold-text" data-toggle="modal"
                data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                New Purchase Order
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">WARNA SHEET</h6>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Nomor PO</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Dibuat</span></th>
                            <th class="thead-text"><span class="nowrap">Status PO</span></th>
                            <th class="thead-text"><span class="nowrap">Status Pembayaran</span></th>
                            <th class="thead-text"><span class="nowrap">Status Penerimaan</span></th>
                            <th class="thead-text"><span class="nowrap">Detail</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>

                        </tr>
                    </thead>
                    <tbody>

                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($po as $val)
                        <tr>
                            <div class="d-none">
                                {{ $id = $val['id'] }}
                            </div>

                            <div class="d-none">
                                {{ $vendor_id = $val['vendor_id'] }}
                            </div>

                            <div class="d-none">
                                {{ $made_by = $val['made_by_name'] }}
                            </div>

                            <div class="d-none">
                                {{ $checked_by = $val['checked_by_name'] }}
                            </div>

                            <div class="d-none">
                                {{ $approved_by = $val['approved_by_name'] }}
                            </div>

                            <td class="txt-center">{{ $iterator }}</td>
                            <td class="nowrap">{{ $val['nomor_po'] }}</td>
                            <td class="nowrap">{{ $val['tanggal_dibuat'] }}</td>
                            @if ($val['status_po'] == '1')
                            <td class="text-white text-success">OPEN</td>
                            @elseif ($val['status_po'] == '0')
                            <td class="text-white text-danger">CLOSED</td>
                            @endif

                            @if ($val['status_pembayaran'] == '1')
                            <td class="text-white text-success">Sudah Dibayar</td>
                            @elseif ($val['status_pembayaran'] == '0')
                            <td class="text-white text-danger">Belum Dibayar</td>
                            @endif

                            @if ($val['status_penerimaan'] == '1')
                            <td class="text-white text-success">Sudah diterima</td>
                            @elseif ($val['status_penerimaan'] == '0')
                            <td class="text-white text-danger">Belum diterima</td>
                            @endif
                            <td>
                                <a href="/PO/detail/{{ $val['id'] }}">
                                    <button type="button" class="btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                @if ($val['status_po'] == '0')
                                <button type="button" class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-edit"></i>
                                </button>
                                @else
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                @endif

                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Edit Data
                                                    PO</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <form method="post" action="/PO/edit">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" name="id" value="{{$val['id']}}">
                                                            <input type="hidden" name="status_penerimaan" value="{{$val['status_penerimaan']}}">

                                                            <div class="mb-3">
                                                                <label for="UpdateVendor" class="form-label">Vendor</label>
                                                                <select name="vendor_id" class="form-control">
                                                                    <option value="{{$val['vendor_id']}}" selected hidden>{{$val['nama_vendor']}}</option>
                                                                    @foreach ($vendor as $valvendor)
                                                                        <option value="{{$valvendor['id']}}" name="vendor_id">{{$valvendor['nama_vendor']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Status PO</label>
                                                                <select type="text" name="status_po" class="form-control">
                                                                    <option value="@if ($val['status_po'] == 1) OPEN @elseif ($val['status_po'] == 0) CLOSED @endif" selected hidden >@if ($val['status_po'] == 1) OPEN @elseif ($val['status_po'] == 0) CLOSED @endif</option>
                                                                    <option value="1">OPEN</option>
                                                                    <option value="0">CLOSED</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Checked By</label>
                                                                <select type="text" name="checked_by" class="form-control" value="">
                                                                <option value="{{$val['checked_by_id']}}" selected hidden>{{$val['checked_by_name']}}</option>
                                                                    @foreach ($employee as $valemployee)
                                                                        <option value="{{$valemployee['id']}}" name="checked_by">{{$valemployee['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col">

                                                            <div class="mb-3">
                                                                <label class="form-label">Status Pembayaran</label>
                                                                <select name="status_pembayaran" class="form-control">
                                                                    <option value="@if ($val['status_pembayaran'] == 1) Sudah Dibayar @elseif ($val['status_pembayaran'] == 0) Belum Dibayar @endif" selected hidden >@if ($val['status_pembayaran'] == 1) Sudah Dibayar @elseif ($val['status_pembayaran'] == 0) Belum Dibayar @endif</option>
                                                                    <option value="1">Sudah Dibayar</option>
                                                                    <option value="0">Belum Dibayar</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Made By</label>
                                                                <select disabled type="text" name="made_by" class="form-control" value="">
                                                                <option value="{{$val['made_by_id']}}"selected hidden>{{$val['made_by_name']}}</option>
                                                                    {{-- @foreach ($employee as $valemployee)
                                                                        <option value="{{$valemployee['id']}}" name="made_by">{{$valemployee['employee_name']}}</option>
                                                                    @endforeach --}}
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Approved By</label>
                                                                <select type="text" name="approved_by" class="form-control">
                                                                    <option value="{{$val['approved_by_id']}}"selected hidden>{{$val['approved_by_name']}}</option>
                                                                    @foreach ($employee as $valemployee)
                                                                        <option value="{{$valemployee['id']}}" name="approved_by">{{$valemployee['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mt-5 float-right">
                                                                <button type="button"
                                                                    class="btn-sm btn-success bold-text mb-3"
                                                                    data-toggle="modal"
                                                                    data-target="#exampleModalCenterConfirm{{$val['id']}}">
                                                                    Update
                                                                </button>
                                                                <div class="modal fade"
                                                                    id="exampleModalCenterConfirm{{$val['id']}}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLongTitle">Are You
                                                                                    Sure?</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Once you change Status PO to "CLOSED" it cannot be
                                                                                undone.
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Yes</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">No</button>
                                                                            </div>
                                                                        </div>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($val['status_po'] == 0)
                                <button type="button" class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-trash"></i>
                                </button>
                                @else
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                    data-target="#exampleModalCenterDelete{{$id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif

                                <!-- Modal Delete Data -->
                                <div class="modal fade" id="exampleModalCenterDelete{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Delete
                                                    Data PO</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <p>Are you sure you want to delete?</p>
                                            </div>
                                            <div class="modal-footer black-text">

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <form method="post" action="/PO/delete">
                                                    @csrf
                                                    @method("DELETE")

                                                    <input type="hidden" id="id" name="po_id" class="form-control"
                                                        value="{{ $id }}">
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        <div class="d-none">
                            {{ $iterator = $iterator + 1 }}
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Data -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title black-text" id="exampleModalLongTitle">New Purchase Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body black-text">
                    <form method="post" action="/PO/add">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col">

                                <div class="mb-3">
                                    <label for="InputVendor" class="form-label">Vendor</label>
                                    <select type="vendor" name="vendor_id" class="form-control" id="">
                                        @foreach ($vendor as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id']}}" name="vendor_id">{{$val['nama_vendor']}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="InputMade" class="form-label">Made by</label>
                                    <select type="made-by" name="made_by" class="form-control" name="made_by" id="">
                                        @foreach ($employee as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id']}}" name="made_by">{{$val['employee_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="InputApprove" class="form-label">Approved by</label>
                                    <select type="approved-by" name="approved_by" class="form-control" id="">
                                        @foreach ($employee as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id']}}" name="approved_by">{{$val['employee_name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="InputVendor" class="form-label">Status Penerimaan</label>
                                    <input type="text" name="status_penerimaan" class="form-control" value="Belum Diterima" readonly="readonly">
                                </div>

                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputCheck" class="form-label">Check by</label>

                                    <select type="check-by" name="checked_by" class="form-control" id="">
                                        @foreach ($employee as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">StatusPO</label>
                                    <input type="text" name="status_po" class="form-control" value="OPEN" readonly="readonly">
                                </div>

                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">Status Pembayaran</label>
                                    <select type="status-pembayaran" name="status_pembayaran" class="form-control"
                                        id="">
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="Sudah Dibayar">Sudah Dibayar</option>
                                        <option value="Belum Dibayar">Belum Dibayar</option>
                                    </select>
                                </div>

                                <div class="mt-5 float-right">
                                    <button type="submit" class="btn btn-success">Add new</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
