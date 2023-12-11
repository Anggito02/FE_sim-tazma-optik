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
        <div class="card-body">
            <div class="d-flex justify-content-between p-5">
                <div class="d-flex flex-column">
                    <h1>{{$po['nomor_po']}}</h1>
                    <h2>{{$po['tanggal_dibuat']}}</h2>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <p>made: {{$po['made_by_name']}}</p>
                    <p>checked: {{$po['checked_by_name']}}</p>
                    <p>Approved By: {{$po['approved_by_name']}}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between p-5">
                <div class="d-flex flex-column">
                    <h3>Nama Vendor: {{$po['nama_vendor']}}</h3>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <p>Status PO: {{$po['status_po']}}</p>
                    <p>Status Penerimaan: {{$po['status_penerimaan']}}</p>
                    <p>Status Pembayaran: {{$po['status_pembayaran']}}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">WARNA SHEET</h6>
        </div> -->

        <div class="card-body">
            <button type="button" class="btn-sm btn-success float-right bold-text mb-3" data-toggle="modal"
                data-target="#exampleModalCenter">
                Add Item
            </button>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Pre Order Quantity</span></th>
                            <th class="thead-text"><span class="nowrap">Received Quantity</span></th>
                            <th class="thead-text"><span class="nowrap">Not Good Quantity</span></th>
                            <th class="thead-text"><span class="nowrap">Unit</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli Satuan</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Jual Satuan</span></th>
                            <th class="thead-text"><span class="nowrap">Diskon</span></th>
                            <th class="thead-text"><span class="nowrap">Purchase Order Id</span></th>
                            <th class="thead-text"><span class="nowrap">Item Id</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($pod as $vals)
                        <tr>
                            <div class="d-none">
                                {{ $id = $vals['id'] }}
                            </div>
                            <td class="txt-center">{{$iterator}}</td>
                            <td class="nowrap">{{ $vals['pre_order_qty']}}</td>
                            <td class="nowrap">{{ $vals['received_qty']}}</td>
                            <td class="nowrap text-right">{{ $vals['not_good_qty']}}</td>
                            <td class="nowrap text-right">{{ $vals['unit']}}</td>
                            <td class="nowrap text-right">{{ $vals['harga_beli_satuan']}}</td>
                            <td class="nowrap text-right">{{ $vals['harga_jual_satuan']}}</td>
                            <td class="nowrap text-right">{{ $vals['diskon']}}</td>
                            <td class="nowrap text-right">{{ $vals['purchase_order_id']}}</td>
                            <td class="nowrap text-right">{{ $vals['item_id']}}</td>
                            <td>
                                <form action="/PO/detail" method="post">
                                    @csrf
                                    @method("POST")
                                <input type="hidden" id="id" name="status_po" class="form-control"
                                        value="{{ $po['status_po'] }}">

                                    <input type="hidden" id="id" name="status_pembayaran" class="form-control"
                                        value="{{ $po['status_pembayaran'] }}">

                                    <input type="hidden" id="id" name="status_penerimaan" class="form-control"
                                        value="{{ $po['status_penerimaan'] }}">

                                    <input type="hidden" id="id" name="checked_by_name" class="form-control"
                                        value="{{ $po['checked_by_name'] }}">

                                    <input type="hidden" id="id" name="tanggal_dibuat" class="form-control"
                                        value="{{ $po['tanggal_dibuat'] }}">

                                    <input type="hidden" id="id" name="nomor_po" class="form-control"
                                        value="{{ $po['nomor_po'] }}">

                                    <input type="hidden" id="id" name="nama_vendor" class="form-control"
                                        value="{{ $po['nama_vendor'] }}">

                                    <input type="hidden" id="id" name="made_by_name" class="form-control"
                                        value="{{ $po['made_by_name'] }}">

                                    <input type="hidden" id="id" name="approved_by_name" class="form-control"
                                        value="{{ $po['approved_by_name'] }}">

                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data PO</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputVendor"
                                                                    class="form-label">Vendor</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputJumlah"
                                                                    class="form-label">Jumlah</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputJual" class="form-label">Harga Jual
                                                                    Unit</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputKode" class="form-label">Kode
                                                                    Item</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputUnit" class="form-label">Unit</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputMade" class="form-label">Made
                                                                    by</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputApprove" class="form-label">Approve
                                                                    by</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputStatus" class="form-label">Status
                                                                    Receiving</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputNomor" class="form-label">Nomor
                                                                    PO</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputMerk" class="form-label">Merek</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputBeli" class="form-label">Harga Beli
                                                                    Unit</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputTanggal" class="form-label">Tanggal
                                                                    Masuk PO</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputName" class="form-label">Nama
                                                                    Item</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputDisc" class="form-label">Diskon</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputCheck" class="form-label">Check
                                                                    by</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputStatus" class="form-label">Status
                                                                    PO</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputStatus" class="form-label">Status
                                                                    Invoice</label>
                                                                <input type="text" id="id" name="" class="form-control"
                                                                    value="">
                                                            </div>

                                                            <div class="mt-5 float-right">
                                                                <button type="sumbit"
                                                                    class="btn btn-primary">Update</button>
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
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                    data-target="#exampleModalCenterDelete{{$id}}">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Modal Delete Data -->
                                <div class="modal fade" id="exampleModalCenterDelete{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Data PO</h5>
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
                                                <form method="post" action="/PO/detail/delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" id="id" name="id" class="form-control" value="">
                                                    <button type="submit" class="btn btn-primary">Yes</button>
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

        <!-- Modal Add Data -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">New Pre-Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/PO/detail/add">
                            @csrf
                            @method("POST")
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="InputKode" class="form-label">Pilih Jenis Item</label>
                                        <select type="text" name="jenis_item" id="select_item" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Item</option>
                                            <option value="frame">Frame</option>
                                            <option value="lensa">Lensa</option>
                                            <option value="aksesoris">Aksesoris</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="InputVendor" class="form-label">Pre-Order Quantity</label>
                                        <input type="number" id="add_detail" name="pre_order_qty" class="form-control"disabled>

                                    </div>

                                    <div class="mb-3 ">
                                        <label for="InputMade" class="form-label">Harga Beli Satuan</label>
                                        <input type="number" id="add_detail" name="harga_beli_satuan" class="form-control"disabled>
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="InputApprove" class="form-label">Purchase Order</label>
                                        <select type="number" name="purchase_order_id" id="add_detail" class="form-control" disabled>
                                            @foreach ($po_all as $po)
                                            <option value="{{$po['id']}}" name="purchase_order_id">{{$po['nomor_po']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                
                                <div class="col">
                                    
                                    <div class="mb-3 ">
                                        <label for="InputTanggal" class="form-label">Unit</label>
                                        <input type="text" id="add_detail" name="unit" class="form-control"disabled>
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="InputCheck" class="form-label">Harga Jual Satuan</label>
                                        <input type="number" id="add_detail" name="harga_jual_satuan" class="form-control"disabled>
                                    </div>
                                    
                                    <div class="mb-3 ">
                                        <label for="InputApprove" class="form-label">Diskon</label>
                                        <input type="number" id="add_detail" name="diskon" class="form-control"disabled>
                                    </div>
                                    
                                    <div class="mb-3 frame-detail">
                                        <label for="InputStatus" class="form-label">Item</label>
                                        <!-- <input type="text" id="id" name="item_id" class="form-control"> -->
                                        <select name="item_id" id="" class="form-control">
                                            <option value="" disabled selected>Choose...</option>
                                            @foreach ($item as $item)
                                            <option value="{{$item['id']}}" name="item_id">{{$item['kode_item']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- <div class="mb-3 lensa-detail">
                                        <label for="InputStatus" class="form-label">Item</label>
                                        
                                    </div> -->

                                    <!-- <div class="mb-3 aksesoris-detail">
                                        <label for="InputStatus" class="form-label">Item</label>
                                    </div> -->

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



</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/poDetail.js') }}"></script>
@endpush