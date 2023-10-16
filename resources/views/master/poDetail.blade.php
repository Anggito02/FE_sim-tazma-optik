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
            <div class="d-flex justify-content-between p-5 black-text">
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

            <div class="d-flex justify-content-between p-5 black-text">
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
                New Pre-Order
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

                        </div>

                        <tr>
                            <td class="txt-center"></td>
                            <td class="nowrap"></td>
                            <td class="nowrap"></td>
                            <td class="nowrap text-right"></td>
                            <td class="nowrap text-right"></td>
                            <td class="nowrap text-right"></td>
                            <td class="nowrap text-right"></td>
                            <td class="nowrap text-right"></td>
                            <td class="nowrap text-right"></td>
                            <td class="nowrap text-right"></td>
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
                                    <label for="InputVendor" class="form-label">Pre-Order Quantity</label>
                                    <input type="text" id="id" name="tanggal_dibuat" class="form-control">

                                </div>


                                <div class="mb-3">
                                    <label for="InputMade" class="form-label">Harga Beli Satuan</label>
                                    <input type="text" id="id" name="tanggal_dibuat" class="form-control" >

                                </div>


                                <div class="mb-3">
                                    <label for="InputApprove" class="form-label">Diskon</label>
                                    <input type="text" id="id" name="tanggal_dibuat" class="form-control">

                                </div>

                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputTanggal" class="form-label">Unit</label>
                                    <input type="text" id="id" name="tanggal_dibuat" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="InputCheck" class="form-label">Harga Jual Satuan</label>
                                    <input type="text" id="id" name="tanggal_dibuat" class="form-control">

                                </div>

                                <div class="mb-3">
                                    <label for="InputStatus" class="form-label">ID Item</label>
                                    <input type="text" id="id" name="tanggal_dibuat" class="form-control">

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
                    <h5 class="modal-title black-text" id="exampleModalLongTitle">Edit Data PO</h5>

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
                    <h5 class="modal-title black-text" id="exampleModalLongTitle">Delete Data PO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body black-text">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer black-text">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="sumbit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
