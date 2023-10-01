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
            <div class="d-flex justify-content-end">

                <div class="search">
                    <form id="itemForm" action="/item" method="POST">
                        @csrf
                        <!-- <label for="InputItem" class="form-label">Jenis
                            Item</label> -->
                        <select name="jenis_item" id="get_jenis_item" class="form-control">
                            <option value="frame">Frame</option>
                            <option value="lensa">Lensa</option>
                            <option value="aksesoris">Aksesoris</option>
                        </select>
                    </form>
                </div>

                <div class="add-btn">
                    <button type="button" class="btn-sm btn-success bold-text" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        New Item
                    </button>
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
                            <th class="thead-text"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Item</span></th>
                            <th class="thead-text"><span class="nowrap">Deskripsi</span></th>
                            <th class="thead-text"><span class="nowrap">Frame SKU Vendor</span></th>
                            <th class="thead-text"><span class="nowrap">Frame SUB Kategori</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Jual</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Produk Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Item Aksesoris</span></th>
                            <th class="thead-text"><span class="nowrap">Kategori Aksesoris</span></th>
                            <th class="thead-text"><span class="nowrap">Stok</span></th>
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
                            <td class="nowrap">{{ $val['jenis_item'] }}</td>
                            <td class="nowrap">{{ $val['kode_item']}}</td>
                            <td class="nowrap text-right">{{ $val['deskripsi']}}</td>
                            <td class="nowrap text-right">{{ $val['frame_sku_vendor']}}</td>
                            <td class="nowrap text-right">{{ $val['frame_sub_kategori']}}</td>
                            <td class="nowrap text-right">{{ $val['frame_kode']}}</td>
                            <td class="nowrap">{{ $val['harga_beli']}}</td>
                            <td class="nowrap">{{ $val['harga_jual']}}</td>
                            <td class="nowrap">{{ $val['lensa_jenis_produk']}}</td>
                            <td class="nowrap text-right">{{ $val['lensa_jenis_lensa']}}</td>
                            <td class="nowrap">{{ $val['aksesoris_nama_item']}}</td>
                            <td class="nowrap">{{ $val['aksesoris_kategori']}}</td>
                            <td class="nowrap">{{ $val['stok']}}</td>
                            <td>
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="/item/edit">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row">
                                                        <input type="hidden" id="id" name="item_id" class="form-control"
                                                            value="{{$val['id']}}">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputItem" class="form-label">Jenis
                                                                    Item</label>
                                                                <select type="jenis" name="jenis_item"
                                                                    id="edit_jenisItem" class="form-control">
                                                                    <option value="{{$val['jenis_item']}}" selected
                                                                        hidden>{{$val['jenis_item']}}
                                                                    </option>
                                                                    <option value="frame">Frame</option>
                                                                    <option value="lensa">Lensa</option>
                                                                    <option value="aksesoris">Aksesoris</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputDeskripsi"
                                                                    class="form-label">Deskripsi</label>
                                                                <input type="text" id="id" name="deskripsi"
                                                                    class="form-control" value="{{$val['deskripsi']}}">
                                                            </div>

                                                            <div class="mb-3 frameSubKategoriEdit">
                                                                <label for="InputFrameSub" class="form-label">Frame SUB
                                                                    Kategori</label>
                                                                <input type="text" id="" name="frame_sub_kategori"
                                                                    class="form-control"
                                                                    value="{{$val['frame_sub_kategori']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputBeli" class="form-label">Harga
                                                                    Beli</label>
                                                                <input type="text" id="id" name="harga_beli"
                                                                    class="form-control" value="{{$val['harga_beli']}}">
                                                            </div>

                                                            <div class="mb-3 jenisProdukLensaEdit">
                                                                <label for="InputBeliLensa" class="form-label">Jenis
                                                                    Produk Lensa</label>
                                                                <input type="text" id="" name="lensa_jenis_produk"
                                                                    class="form-control"
                                                                    value="{{$val['lensa_jenis_produk']}}">
                                                            </div>

                                                            <div class="mb-3 kategoriAksesorisEdit">
                                                                <label for="InputAksesoris" class="form-label">Kategori
                                                                    Aksesoris</label>
                                                                <input type="text" id="" name="aksesoris_kategori"
                                                                    class="form-control"
                                                                    value="{{$val['aksesoris_kategori']}}">
                                                            </div>

                                                        </div>

                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputKode" class="form-label">Kode
                                                                    Item</label>
                                                                <input type="text" id="id" name="kode_item"
                                                                    class="form-control" value="{{$val['kode_item']}}">
                                                            </div>

                                                            <div class="mb-3 frameSkuVendorEdit">
                                                                <label for="InputFrameSku" class="form-label"
                                                                    id="">Frame SKU
                                                                    Vendor</label>
                                                                <input type="text" id="" name="frame_sku_vendor"
                                                                    class="form-control"
                                                                    value="{{$val['frame_sku_vendor']}}">
                                                            </div>

                                                            <div class="mb-3 kodeFrameEdit">
                                                                <label for="InputKodeFrame" class="form-label">Kode
                                                                    Frame</label>
                                                                <input type="text" id="" name="frame_kode"
                                                                    class="form-control" value="{{$val['frame_kode']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="InputJualFrame" class="form-label">Harga
                                                                    Jual</label>
                                                                <input type="text" id="id" name="harga_jual"
                                                                    class="form-control" value="{{$val['harga_jual']}}">
                                                            </div>

                                                            <div class="mb-3 jenisLensaEdit">
                                                                <label for="InputLensa" class="form-label">Jenis
                                                                    Lensa</label>
                                                                <input type="text" id="" name="lensa_jenis_lensa"
                                                                    class="form-control"
                                                                    value="{{$val['lensa_jenis_lensa']}}">
                                                            </div>

                                                            <div class="mb-3 namaItemAksesorisEdit">
                                                                <label for="InputItemAksesoris" class="form-label">Nama
                                                                    Item Aksesoris</label>
                                                                <input type="text" id="" name="aksesoris_nama_item"
                                                                    class="form-control"
                                                                    value="{{$val['aksesoris_nama_item']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="stok" class="form-label">Stok</label>
                                                                <input type="number" id="stok" name="stok"
                                                                    class="form-control" value="{{$val['stok']}}">
                                                            </div>

                                                            <div class="mt-5 float-right">
                                                                <button type="submit" class="btn btn-success">Edit
                                                                    Item</button>
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
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Item</h5>
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
                                                <form method="post" action="/item/delete">
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
                    <form method="post" action="/item/add">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputItem" class="form-label">Jenis Item</label>
                                    <select type="jenis" name="jenis_item" id="choose_jenisItem" class="form-control"
                                        id="">
                                        <option value="" disablemd selected hidden>Choose...</option>
                                        <option value="frame">Frame</option>
                                        <option value="lensa">Lensa</option>
                                        <option value="aksesoris">Aksesoris</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="InputNamaBrand" class="form-label">Nama Brand</label>
                                    <input type="text" id="id_addItem" name="nama_brand_item" class="form-control addItem"
                                        disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="InputJualFrame" class="form-label">Harga Jual</label>
                                    <input type="text" id="id_addItem" name="harga_jual" class="form-control addItem"
                                        disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="InputFrameSub" class="form-label">Frame SUB Kategori</label>
                                    <input type="text" id="frameSubKategori" name="frame_sub_kategori"
                                        class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="InputKodeFrame" class="form-label">Kode Frame</label>
                                    <input type="text" id="kodeFrame" name="frame_kode" class="form-control" disabled>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="InputBeliLensa" class="form-label">Jenis Produk Lensa</label>
                                    <input type="text" id="jenisProdukLensa" name="lensa_jenis_produk"
                                        class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="InputAksesoris" class="form-label">Kategori Aksesoris</label>
                                    <input type="text" id="kategoriAksesoris" name="aksesoris_kategori"
                                    class="form-control" disabled>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" id="id_addItem" name="stok" class="form-control addItem"
                                        disabled>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="InputDeskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" id="id_addItem" name="deskripsi" class="form-control addItem"
                                        disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="InputBeliFrame" class="form-label">Harga Beli</label>
                                    <input type="text" id="id_addItem" name="harga_beli" class="form-control addItem"
                                        disabled>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="InputKode" class="form-label">Kode Item</label>
                                    <input type="text" id="id_addItem" name="kode_item" class="form-control addItem"
                                        disabled>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="InputFrameSku" class="form-label">Frame SKU Vendor</label>
                                    <input type="text" id="frameSkuVendor" name="frame_sku_vendor" class="form-control"
                                        disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="InputIndexLensa" class="form-label">Index Lensa</label>
                                    <input type="text" id="indexLensa" name="index_lensa" class="form-control"
                                        disabled>
                                </div>




                                <div class="mb-3">
                                    <label for="InputJenisLensa" class="form-label">Jenis Lensa</label>
                                    <input type="text" id="jenisLensa" name="lensa_jenis_lensa" class="form-control"
                                        disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="InputItemAksesoris" class="form-label">Nama Item Aksesoris</label>
                                    <input type="text" id="namaItemAksesoris" name="aksesoris_nama_item"
                                        class="form-control" disabled>
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
