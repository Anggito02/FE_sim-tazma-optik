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
            <button type="button" class="btn-sm btn-success float-right bold-text" data-toggle="modal"
                data-target="#exampleModalCenter">
                New Item
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
                            <th class="thead-text"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Item</span></th>
                            <th class="thead-text"><span class="nowrap">Deskripsi</span></th>
                            <th class="thead-text"><span class="nowrap">Frame SKU Vendor</span></th>
                            <th class="thead-text"><span class="nowrap">Frame SUB Kategori</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Jual Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Produk Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Jual Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Item Aksesoris</span></th>
                            <th class="thead-text"><span class="nowrap">Kategori Aksesoris</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli Aksesoris</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Jual Aksesoris</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>

                        </tr>
                    </thead>
                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($item as $val)
                        <tr>
                            <div class="d-none">
                                {{ $id = $val['id'] }}
                            </div>
                            <td class="txt-center"><span class="nowrap">{{$iterator}}</span></td>
                            <td class="nowrap">CV GITO</td>
                            <td class="nowrap">RayBand</td>
                            <td class="nowrap text-right">100</td>
                            <td class="nowrap text-right">Rp 120.000</td>
                            <td class="nowrap text-right">Rp 150.000</td>
                            <td class="nowrap text-right">9-11-2023</td>
                            <td class="nowrap">AAB-01</td>
                            <td class="nowrap">dummy item</td>
                            <td class="nowrap">1/item</td>
                            <td class="nowrap text-right">10%</td>
                            <td class="nowrap">Last login</td>
                            <td class="nowrap">employee A</td>
                            <td class="nowrap">employee A</td>
                            <td class="nowrap">open</td>
                            <td class="nowrap">close</td>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">

                    <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputItem" class="form-label">Jenis Item</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>
                            
                                <div class="mb-3">
                                    <label for="InputDeskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputFrameSub" class="form-label">Frame SUB Kategori</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliFrame" class="form-label">Harga Beli Frame</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliLensa" class="form-label">Jenis Produk Lensa</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJualLensa" class="form-label">Harga Jual Lensa</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputAksesoris" class="form-label">Kategori Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJualAksesoris" class="form-label">Harga Jual Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputKode" class="form-label">Kode Item</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputFrameSku" class="form-label">Frame SKU Vendor</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputKodeFrame" class="form-label">Kode Frame</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJualFrame" class="form-label">Harga Jual Frame</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliLensa" class="form-label">Harga Beli Lensa</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputItemAksesoris" class="form-label">Nama Item Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliAksesoris" class="form-label">Harga Beli Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        
                    <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputItem" class="form-label">Jenis Item</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>
                            
                                <div class="mb-3">
                                    <label for="InputDeskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputFrameSub" class="form-label">Frame SUB Kategori</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliFrame" class="form-label">Harga Beli Frame</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliLensa" class="form-label">Jenis Produk Lensa</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJualLensa" class="form-label">Harga Jual Lensa</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputAksesoris" class="form-label">Kategori Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJualAksesoris" class="form-label">Harga Jual Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputKode" class="form-label">Kode Item</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputFrameSku" class="form-label">Frame SKU Vendor</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputKodeFrame" class="form-label">Kode Frame</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputJualFrame" class="form-label">Harga Jual Frame</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliLensa" class="form-label">Harga Beli Lensa</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputItemAksesoris" class="form-label">Nama Item Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliAksesoris" class="form-label">Harga Beli Aksesoris</label>
                                    <input type="text" id="id" name="" class="form-control" value="">
                                </div>

                                <div class="mt-5 float-right">
                                    <button type="submit" class="btn btn-success">Add new</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="sumbit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
