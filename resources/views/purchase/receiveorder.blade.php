@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="mb-4">
        <a href="/PO/detail/{{ $po['id'] }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form>
                <div class="row"> <!-- Memastikan ada row untuk wrap kolom -->
                    <div class="col-md-2">
                        <label for="InputBeli1" class="form-label"><b>Receive Order Number</b></label>
                        <input type="text" id="InputBeli1" name="harga_beli_satuan" class="form-control" value="{{$ro['nomor_receive_order']}}">
                    </div>
                    <div class="col-md-2">
                        <label for="InputBeli1" class="form-label"><b>Receive Order Date</b></label>
                        <input type="text" id="InputBeli1" name="harga_beli_satuan" class="form-control" value="<?php echo date('d-m-Y H:i:s',strtotime($ro['tanggal_penerimaan']));?>">
                    </div>
                    <div class="col-md-2">
                        <label for="InputBeli1" class="form-label"><b>Supplier Name</b></label>
                        <input type="text" id="InputBeli1" name="harga_beli_satuan" class="form-control" value="{{$po['nama_vendor']}}">
                    </div>
                    <div class="col-md-2">
                        <label for="InputBeli1" class="form-label"><b>Checked By</b></label>
                        <input type="text" id="InputBeli1" name="harga_beli_satuan" class="form-control" value="{{$ro['checked_by_name']}}">
                    </div>
                    <div class="col-md-2">
                        <label for="InputBeli1" class="form-label"><b>Approved By</b></label>
                        <input type="text" id="InputBeli1" name="harga_beli_satuan" class="form-control" value="{{$ro['approved_by_name']}}">
                    </div>
                    <div class="col-md-2">
                        <label for="InputBeli1" class="form-label"><b>Received By</b></label>
                        <input type="text" id="InputBeli1" name="harga_beli_satuan" class="form-control" value="{{$ro['received_by_name']}}">
                    </div>
                </div>
            </form>
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
                            <th class="thead-text"><span class="nowrap">Nama Item</span></th>
                            <th class="thead-text"><span class="nowrap">PO Quantity</span></th>
                            <th class="thead-text"><span class="nowrap">Received Quantity</span></th>
                            <th class="thead-text"><span class="nowrap">Not Good Quantity</span></th>
                            <th class="thead-text"><span class="nowrap">Unit</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli Satuan</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                        </tr>
                    </thead>
                    <tbody>

                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($pod as $valPod)
                        <tr>
                            <td class="txt-center">{{ $iterator }}</td>
                            <td class="nowrap">{{ $valPod['kode_item'] }}</td>
                            <td class="nowrap text-right">{{ $valPod['pre_order_qty'] }}</td>
                            <td class="nowrap">
                                @if ($valPod['received_qty'] == 0)
                                <div class="text-right text-danger">0</div>
                                @else
                                <div class="text-right">{{ $valPod['received_qty'] }}</div>
                                @endif</td>
                            <td class="nowrap">
                                @if ($valPod['not_good_qty'] == 0)
                                <div class="text-right text-danger">0</div>
                                @else
                                <div class="text-right">{{ $valPod['not_good_qty'] }}</div>
                                @endif</td>
                            <td class="nowrap ">{{ $valPod['unit'] }}</td>
                            <td class="nowrap text-right">{{ $valPod['harga_beli_satuan'] }}</td>
                            <td>
                                @if ((($valPod['received_qty'] == 0) && ($valPod['not_good_qty']) == 0))
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$valPod['id']}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                @elseif ((($valPod['received_qty'] != 0) || ($valPod['not_good_qty']) != 0)) 
                                <button type="button" class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-edit"></i>
                                </button>
                                @endif
                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$valPod['id']}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data PO</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="/receive-order/edit">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" name="id" class="form-control"
                                                                value="{{ $valPod['id'] }}">
                                                            <input type="hidden" name="pre_order_qty"
                                                                class="form-control"
                                                                value="{{ $valPod['pre_order_qty'] }}">
                                                            <input type="hidden" name="item_id" class="form-control"
                                                                value="{{ $valPod['item_id'] }}">
                                                            <input type="hidden" name="purchase_order_id"
                                                                class="form-control"
                                                                value="{{ $valPod['purchase_order_id'] }}">
                                                            <input type="hidden" name="receive_order_id"
                                                                class="form-control" value="{{ $ro['id'] }}">

                                                            <div class="mb-3">
                                                                <label for="InputNomor" class="form-label">Received
                                                                    Quantity</label>
                                                                <input type="number" name="received_qty"
                                                                    class="form-control"
                                                                    value="{{ $valPod['received_qty'] }}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputQtyReceive" class="form-label">Not Good
                                                                    Quantity</label>
                                                                <input type="number" name="not_good_qty"
                                                                    class="form-control"
                                                                    value="{{ $valPod['not_good_qty'] }}">
                                                            </div>

                                                            <div class="mt-2 float-right">
                                                                <button type="button"
                                                                    class="btn-sm btn-success bold-text mb-3"
                                                                    data-toggle="modal"
                                                                    data-target="#exampleModalCenterConfirm{{$valPod['id']}}">
                                                                    Update
                                                                </button>
                                                                <div class="modal fade"
                                                                    id="exampleModalCenterConfirm{{$valPod['id']}}"
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
                                                                                Once you click "Yes" it cannot be
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
</div>
@endsection
