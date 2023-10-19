@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="mb-4">
        <a href="/PO/detail/{{ $po['id'] }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between p-5 black-text">
                <div class="d-flex flex-column">
                    <h1>{{$ro['nomor_receive_order']}}</h1>
                    <h2>{{$ro['tanggal_penerimaan']}}</h2>
                </div>
            </div>

            <div class="d-flex justify-content-between p-5 black-text">
                <div class="d-flex flex-column">
                    <h3>Nama Vendor: {{$po['nama_vendor']}}</h3>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <p>Checked By: {{$ro['checked_by_name']}}</p>
                    <p>Approved By: {{$ro['approved_by_name']}}</p>
                    <p>Receive By: {{$ro['received_by_name']}}</p>
                </div>
            </div>
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
                            <td class="nowrap">@if ($valPod['received_qty'] == null)
                                <div class="text-danger">Item Not Received</div>
                                @else
                                <div class="text-right">{{ $valPod['received_qty'] }}</div>
                                @endif</td>
                            <td class="nowrap">@if ($valPod['not_good_qty'] == null)
                                <div class="text-danger">Item Not Received</div>
                                @else
                                <div class="text-right">{{ $valPod['not_good_qty'] }}</div>
                                @endif</td>
                            <td class="nowrap ">{{ $valPod['unit'] }}</td>
                            <td class="nowrap text-right">{{ $valPod['harga_beli_satuan'] }}</td>
                            <td>
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenterEdit{{$valPod['id']}}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <!-- Modal Update Data -->
                            <div class="modal fade" id="exampleModalCenterEdit{{$valPod['id']}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data PO</h5>
                        
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/receive-order/edit">
                                                @csrf
                                                @method("PUT")
                                                <div class="row">
                                                    <div class="col">
                                                    <input type="hidden" name="id" class="form-control" value="{{ $valPod['id'] }}">
                                                    <input type="hidden" name="pre_order_qty" class="form-control" value="{{ $valPod['pre_order_qty'] }}">
                                                    <input type="hidden" name="unit" class="form-control" value="{{ $valPod['unit'] }}">
                                                    <input type="hidden" name="harga_beli_satuan" class="form-control" value="{{ $valPod['harga_beli_satuan'] }}">
                                                    <input type="hidden" name="harga_jual_satuan" class="form-control" value="{{ $valPod['harga_jual_satuan'] }}">
                                                    <input type="hidden" name="diskon" class="form-control" value="{{ $valPod['diskon'] }}">
                                                    <input type="hidden" name="item_id" class="form-control" value="{{ $valPod['item_id'] }}">
                                                    <input type="hidden" name="purchase_order_id" class="form-control" value="{{ $valPod['purchase_order_id'] }}">
                                                    <input type="hidden" name="receive_order_id" class="form-control" value="{{ $ro['id'] }}">
                        
                                                        <div class="mb-3">
                                                            <label for="InputNomor" class="form-label">Received Quantity</label>
                                                            <input type="number" name="received_qty" class="form-control" value="{{ $valPod['received_qty'] }}">
                                                        </div>
                                                    </div>
                        
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="InputQtyReceive" class="form-label">Not Good Quantity</label>
                                                            <input type="number" name="not_good_qty" class="form-control" value="{{ $valPod['not_good_qty'] }}">
                                                        </div>
                        
                                                        <div class="mt-2 float-right">
                                                            <button type="submit" class="btn btn-success">Update</button>
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
