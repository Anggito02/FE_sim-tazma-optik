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
                data-target="#exampleModalCenter">
                New Pre-Order
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
                                <td class="text-white text-success">PAID</td>
                            @elseif ($val['status_pembayaran'] == '0')
                                <td class="text-white text-danger">UNPAID</td>
                            @endif

                            @if ($val['status_penerimaan'] == '1')
                                <td class="text-white text-success">OPEN</td>
                            @elseif ($val['status_penerimaan'] == '0')
                                <td class="text-white text-danger">CLOSED</td>
                            @endif
                            <td>
                                @foreach ($po as $val)
                                    <form action="/PO/detail" method="post">
                                    @csrf
                                    @method("POST")
                                    <input type="hidden" id="id" name="status_po" class="form-control"
                                        value="{{ $val['status_po'] }}">

                                    <input type="hidden" id="id" name="status_pembayaran" class="form-control"
                                        value="{{ $val['status_pembayaran'] }}">

                                    <input type="hidden" id="id" name="status_penerimaan" class="form-control"
                                        value="{{ $val['status_penerimaan'] }}">

                                    <input type="hidden" id="id" name="checked_by_name" class="form-control"
                                        value="{{ $val['checked_by_name'] }}">

                                    <input type="hidden" id="id" name="tanggal_dibuat" class="form-control"
                                        value="{{ $val['tanggal_dibuat'] }}">

                                    <input type="hidden" id="id" name="nomor_po" class="form-control"
                                        value="{{ $val['nomor_po'] }}">

                                    <input type="hidden" id="id" name="po_id" class="form-control"
                                        value="{{ $val['id'] }}">

                                    <input type="hidden" id="id" name="nama_vendor" class="form-control"
                                        value="{{ $val['nama_vendor'] }}">

                                    <input type="hidden" id="id" name="made_by_name" class="form-control"
                                        value="{{ $val['made_by_name'] }}">

                                    <input type="hidden" id="id" name="approved_by_name" class="form-control"
                                        value="{{ $val['approved_by_name'] }}">

                                    <button type="submit" class="btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                </form>
                                @endforeach

                            </td>
                            <td>
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                    data-target="#exampleModalCenterDelete">
                                    <i class="fa fa-trash"></i>
                                </button>


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
                    <h5 class="modal-title black-text" id="exampleModalLongTitle">New Pre-Order</h5>
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
                                        <option value="{{$val['id']}}" name="approved_by">{{$val['employee_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">Status Penerimaan</label>
                                    <select type="status-penerimaan" name="status_penerimaan" class="form-control" id="">
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="true">OPEN</option>
                                        <option value="false">CLOSED</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputTanggal" class="form-label">Tanggal Dibuat</label>
                                    <input type="text" id="id" name="tanggal_dibuat" class="form-control" placeholder="YYYY-MM-DD">
                                </div>

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
                                    <label for="InputStatus" class="form-label">Status PO</label>
                                    <select type="status-po" name="status_po" class="form-control" id="">
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="true">OPEN</option>
                                        <option value="false">CLOSED</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">Status Pembayaran</label>
                                    <select type="status-pembayaran" name="status_pembayaran" class="form-control" id="">
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="true">PAID</option>
                                        <option value="false">UNPAID</option>
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

    <!-- Modal Update Data -->
    <div class="modal fade" id="exampleModalCenterEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data PO</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body black-text">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputVendor" class="form-label">Vendor</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJumlah" class="form-label">Jumlah</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJual" class="form-label">Harga Jual Unit</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputKode" class="form-label">Kode Item</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputUnit" class="form-label">Unit</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputMade" class="form-label">Made by</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputApprove" class="form-label">Approve by</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">Status Receiving</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputNomor" class="form-label">Nomor PO</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputMerk" class="form-label">Merek</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeli" class="form-label">Harga Beli Unit</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputTanggal" class="form-label">Tanggal Masuk PO</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputName" class="form-label">Nama Item</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputDisc" class="form-label">Diskon</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputCheck" class="form-label">Check by</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">Status PO</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">Status Invoice</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mt-5 float-right">
                                    <button type="sumbit" class="btn btn-primary">Update</button>
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

    <!-- Modal Delete Data -->
    <div class="modal fade" id="exampleModalCenterDelete" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Data PO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    @foreach ($po as $val)
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <form method="post" action="/PO/delete">
                            @csrf
                            @method("DELETE")

                            <input type="hidden" id="id" name="po_id" class="form-control"
                                value="{{ $val['id'] }}">
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
