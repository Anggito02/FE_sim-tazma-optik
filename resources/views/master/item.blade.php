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

                    <form action="/item" method="POST">
                        @csrf
                        @method("POST")
                        <select name="jenis_item" class="form-control">
                            <option value="frame">Frame</option>
                            <option value="lensa">Lensa</option>
                            <option value="aksesoris">Aksesoris</option>
                        </select>
                        <!-- <button type="submit">Submit</button> -->
                    </form>
                </div>

                <div class="add-btn">
                    <button type="button" class="btn-sm btn-success bold-text btn-new-item" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        New Item
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
                        @foreach ($item as $vals)
                        <tr>
                            <div class="d-none">
                                {{ $id = $vals['id'] }}
                            </div>
                            <td class="txt-center"><span class="nowrap">{{$iterator}}</span></td>
                            <td class="nowrap">{{ $vals['jenis_item'] }}</td>
                            <td class="nowrap">{{ $vals['kode_item']}}</td>
                            <td class="nowrap text-right">{{ $vals['deskripsi']}}</td>
                            <td class="nowrap text-right">{{ $vals['frame_sku_vendor']}}</td>
                            <td class="nowrap text-right">{{ $vals['frame_sub_kategori']}}</td>
                            <td class="nowrap text-right">{{ $vals['frame_kode']}}</td>
                            <td class="nowrap">{{ $vals['harga_beli']}}</td>
                            <td class="nowrap">{{ $vals['harga_jual']}}</td>
                            <td class="nowrap">{{ $vals['lensa_jenis_produk']}}</td>
                            <td class="nowrap text-right">{{ $vals['lensa_jenis_lensa']}}</td>
                            <td class="nowrap">{{ $vals['aksesoris_nama_item']}}</td>
                            <td class="nowrap">{{ $vals['aksesoris_kategori']}}</td>
                            <td class="nowrap">{{ $vals['stok']}}</td>
                            <td>
                                <button type="button" class="btn-sm btn-primary btn-edit-item" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                                    @if ($vals['jenis_item'] == 'lensa')
                                                    <div class="row">
                                                        <input type="hidden" id="id" name="item_id" class="form-control"
                                                            value="{{$id}}">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputItem" class="form-label">Jenis
                                                                    Item</label>
                                                                <input type="text" name="jenis_item"
                                                                    class="form-control"
                                                                    value="{{$vals['jenis_item']}}">
                                                            </div>
                                                            <div class="mb-3 ">
                                                                <label for="lensa_jenis_produk" class="form-label">Jenis
                                                                    Produk Lensa</label>
                                                                <input type="text" name="lensa_jenis_produk"
                                                                    class="form-control"
                                                                    value="{{$vals['lensa_jenis_produk']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="lensa_jenis_lensa" class="form-label">Jenis
                                                                    Lensa</label>
                                                                <input type="text" name="lensa_jenis_lensa"
                                                                    class="form-control"
                                                                    value="{{$vals['lensa_jenis_lensa']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="lens_category_id"
                                                                    class="form-label">Kategori Lensa</label>
                                                                <select type="text" name="lensa_lens_category_id"
                                                                    class="form-control">
                                                                    @foreach ($lensaCategory as $val)
                                                                    <option
                                                                        value="{{ $val['id'].'-'.$val['nama_kategori'] }}"
                                                                        {{ $val['id'] == $vals['lensa_lens_category_id'] ? 'selected' : ''}}>
                                                                        {{$val['nama_kategori']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Deskripsi</label>
                                                                <input type="text" name="deskripsi" class="form-control"
                                                                    value="{{$vals['deskripsi']}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Stok</label>
                                                                <input type="number" name="stok" class="form-control"
                                                                    value="{{$vals['stok']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Harga Beli</label>
                                                                <input type="number" name="harga_beli"
                                                                    class="form-control"
                                                                    value="{{$vals['harga_beli']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Harga Jual</label>
                                                                <input type="number" name="harga_jual"
                                                                    class="form-control"
                                                                    value="{{$vals['harga_jual']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Brand Lensa</label>
                                                                <select type="text" name="lensa_brand_id"
                                                                    class="form-control">
                                                                    @foreach ($brand as $val)
                                                                    <option
                                                                        value="{{ $val['id'].'-'.$val['nama_brand'] }}"
                                                                        {{ $val['id'] == $vals['lensa_brand_id'] ? 'selected' : '' }}>
                                                                        {{ $val['nama_brand'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Index Lensa</label>
                                                                <select name="lensa_index_id" class="form-control"
                                                                    id="">
                                                                    @foreach ($index as $val)
                                                                    <option value="{{ $val['id'].'-'.$val['value'] }}"
                                                                        {{ $val['id'] == $vals['lensa_index_id'] ? 'selected' : '' }}>
                                                                        {{ $val['value'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mt-5 float-right">
                                                                <button type="submit" class="btn btn-success">Edit
                                                                    Item</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @elseif ($vals['jenis_item'] == 'frame')
                                                    <div class="row">
                                                        <input type="hidden" id="id" name="item_id" class="form-control"
                                                            value="{{$id}}">
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputItem" class="form-label">Jenis
                                                                    Item</label>
                                                                <input type="text" name="jenis_item"
                                                                    class="form-control"
                                                                    value="{{$vals['jenis_item']}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Deskripsi</label>
                                                                <input type="text" name="deskripsi" class="form-control"
                                                                    value="{{$vals['deskripsi']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Stok</label>
                                                                <input type="number" name="stok" class="form-control"
                                                                    value="{{$vals['stok']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Harga Beli</label>
                                                                <input type="number" name="harga_beli"
                                                                    class="form-control"
                                                                    value="{{$vals['harga_beli']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Harga Jual</label>
                                                                <input type="number" name="harga_jual"
                                                                    class="form-control"
                                                                    value="{{$vals['harga_jual']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Brand Frame</label>
                                                                <select name="frame_brand_id" class="form-control"
                                                                    value="{{$vals['frame_brand_id']}}">
                                                                    @foreach ($brand as $val)
                                                                    <option
                                                                        value="{{ $val['id'].'-'.$val['nama_brand'] }}"
                                                                        {{ $val['id'] == $vals['frame_brand_id'] ? 'selected' : '' }}>
                                                                        {{ $val['nama_brand'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Kode Frame</label>
                                                                <input type="text" name="frame_kode"
                                                                    class="form-control"
                                                                    value="{{$vals['frame_kode']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Frame SKU
                                                                    Vendor</label>
                                                                <input type="text" name="frame_sku_vendor"
                                                                    class="form-control"
                                                                    value="{{$vals['frame_sku_vendor']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Warna</label>
                                                                <select type="text" name="frame_color_id"
                                                                    class="form-control">
                                                                    @foreach ($color as $val)
                                                                    <option
                                                                        value="{{ $val['id'].'-'.$val['color_name'] }}"
                                                                        {{ $val['id'] == $vals['frame_color_id'] ? 'selected' : '' }}>
                                                                        {{ $val['color_name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Frame SUB
                                                                    Kategori</label>
                                                                <input type="text" name="frame_sub_kategori"
                                                                    class="form-control"
                                                                    value="{{$vals['frame_sub_kategori']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Kategori Frame</label>
                                                                <select name="frame_frame_category_id"
                                                                    class="form-control">
                                                                    @foreach ($frameCategory as $val)
                                                                    <option
                                                                        value="{{ $val['id'].'-'.$val['nama_kategori'] }}"
                                                                        {{ $val['id'] == $vals['frame_frame_category_id'] ? 'selected' : '' }}>
                                                                        {{ $val['nama_kategori'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Vendor Frame</label>
                                                                <select name="frame_vendor_id" class="form-control"
                                                                    value="frame_vendor_id">
                                                                    @foreach ($vendor as $val)
                                                                    <option
                                                                        value="{{ $val['id'].'-'.$val['nama_vendor'] }}"
                                                                        {{ $val['id'] == $vals['frame_vendor_id'] ? 'selected' : '' }}>
                                                                        {{ $val['nama_vendor'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mt-5 float-right">
                                                                <button type="submit" class="btn btn-success">Edit
                                                                    Item</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @elseif ($vals['jenis_item'] == 'aksesoris')
                                                    <div class="row">
                                                        <input type="hidden" id="id" name="item_id" class="form-control"
                                                            value="{{$id}}" disabled>
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="InputItem" class="form-label">Jenis
                                                                    Item</label>
                                                                <input type="text" name="jenis_item"
                                                                    class="form-control"
                                                                    value="{{$vals['jenis_item']}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Deskripsi</label>
                                                                <input type="text" name="deskripsi" class="form-control"
                                                                    value="{{$vals['deskripsi']}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Stok</label>
                                                                <input type="number" name="stok" class="form-control"
                                                                    value="{{$vals['stok']}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Harga Beli</label>
                                                                <input type="number" name="harga_beli"
                                                                    class="form-control"
                                                                    value="{{$vals['harga_beli']}}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Nama Aksesoris</label>
                                                                <input type="text" name="aksesoris_nama_item"
                                                                    class="form-control"
                                                                    value="{{$vals['aksesoris_nama_item']}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Kategori
                                                                    Aksesoris</label>
                                                                <input type="text" name="aksesoris_kategori"
                                                                    class="form-control"
                                                                    value="{{$vals['aksesoris_kategori']}}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Brand Aksesoris</label>
                                                                <select name="aksesoris_brand_id" class="form-control"
                                                                    value="{{$vals['aksesoris_brand_id']}}">
                                                                    @foreach ($brand as $val)
                                                                    <option
                                                                        value="{{ $val['id'].'-'.$val['nama_brand'] }}"
                                                                        {{ $val['id'] == $vals['aksesoris_brand_id'] ? 'selected' : '' }}>
                                                                        {{ $val['nama_brand'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Harga Jual</label>
                                                                <input type="number" name="harga_jual"
                                                                    class="form-control"
                                                                    value="{{$vals['harga_jual']}}">
                                                            </div>
                                                            <div class="mt-5 float-right">
                                                                <button type="submit" class="btn btn-success">Edit
                                                                    Item</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <form method="post" action="/item/delete">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" id="id" name="id" class="form-control" value="{{ $id }}">
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                                <select type="text" name="jenis_item" id="choose_jenisItem" class="form-control" id="">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    <option value="frame" name="jenis_item">Frame</option>
                                    <option value="lensa" name="jenis_item">Lensa</option>
                                    <option value="aksesoris" name="jenis_item">Aksesoris</option>
                                </select>
                            </div>

                            <div class="form-add-item " id="frameSubKategori">
                                <div class="mb-3">
                                    <label for="InputFrameSub" class="form-label">Frame SUB Kategori</label>
                                    <input type="text" name="frame_sub_kategori" class="form-control">
                                </div>
                            </div>

                            <div class="form-add-item " id="kategoriFrame">
                                <div class="mb-3">
                                    <label for="FrameCategory" class="form-label">Kategori Frame</label>
                                    <select type="number" name="frame_frame_category_id" id="" class="form-control">
                                        @foreach ($frameCategory as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id']}}" name="frame_frame_category_id">
                                            {{$val['nama_kategori']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-add-item " id="indexLensa">
                                <div class="mb-3">
                                    <label for="InputIndexLensa" class="form-label">Index Lensa</label>
                                    <select type="number" name="lensa_index_id" class="form-control">
                                        @foreach ($index as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id'].'-'.$val['value']}}" name="lensa_index_id">
                                            {{$val['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-add-item " id="jenisProdukLensa">
                                <div class="mb-3">
                                    <label for="InputBeliLensa" class="form-label">Jenis Produk Lensa</label>
                                    <input type="text" name="lensa_jenis_produk" class="form-control">
                                </div>
                            </div>

                            <div class="form-add-item " id="kategoriAksesoris">
                                <div class="mb-3">
                                    <label for="InputAksesoris" class="form-label">Kategori Aksesoris</label>
                                    <input type="text" name="aksesoris_kategori" class="form-control">
                                </div>
                            </div>

                            <div class="form-add-item " id="brandFrame">
                                <div class="mb-3">
                                    <label for="InputIndexBrand" class="form-label">Brand Frame</label>
                                    <select type="number" name="frame_brand_id" class="form-control" id="">
                                        @foreach ($brand as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id'].'-'.$val['nama_brand']}}" name="frame_brand_id">
                                            {{$val['nama_brand']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-add-item addItem ">
                                <div class="mb-3 ">
                                    <label for="InputDeskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control ">
                                </div>
                            </div>

                            <div class="form-add-item " id="brandLensa">
                                <div class="mb-3">
                                    <label for="InputIndexBrand" class="form-label">Brand Lensa</label>
                                    <select type="number" name="lensa_brand_id" class="form-control" id="">
                                        @foreach ($brand as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id'].'-'.$val['nama_brand']}}" name="lensa_brand_id">
                                            {{$val['nama_brand']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-add-item " id="frameSkuVendor">
                                <div class="mb-3">
                                    <label for="InputFrameSku" class="form-label">Frame SKU Vendor</label>
                                    <input type="text" name="frame_sku_vendor" class="form-control">
                                </div>
                            </div>

                            <div class="form-add-item " id="colorItem">
                                <div class="mb-3">
                                    <label for="InputColor" class="form-label">Warna</label>
                                    <select type="number" name="frame_color_id" id="" class="form-control">
                                        @foreach ($color as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id'].'-'.$val['color_name']}}" name="frame_color_id">
                                            {{$val['color_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-add-item " id="kodeFrame">
                                <div class="mb-3">
                                    <label for="InputKodeFrame" class="form-label">Kode Frame</label>
                                    <input type="text" name="frame_kode" class="form-control">
                                </div>
                            </div>

                            <div class="form-add-item " id="jenisLensa">
                                <div class="mb-3">
                                    <label for="InputJenisLensa" class="form-label">Jenis Lensa</label>
                                    <input type="text" name="lensa_jenis_lensa" class="form-control">
                                </div>
                            </div>

                            <div class="form-add-item " id="kategoriLensa">
                                <div class="mb-3">
                                    <label for="LensaCategory" class="form-label">Kategori Lensa</label>
                                    <select type="number" name="lensa_lens_category_id" id="" class="form-control">
                                        @foreach ($lensaCategory as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id']}}" name="lensa_lens_category_id">
                                            {{$val['nama_kategori']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-add-item " id="namaItemAksesoris">
                                <div class="mb-3">
                                    <label for="InputItemAksesoris" class="form-label">Nama Item Aksesoris</label>
                                    <input type="text" name="aksesoris_nama_item" class="form-control">
                                </div>
                            </div>

                            <div class="form-add-item " id="brandAksesoris">
                                <div class="mb-3">
                                    <label for="InputIndexBrand" class="form-label">Brand Aksesoris</label>
                                    <select type="number" name="aksesoris_brand_id" class="form-control" id="">
                                        @foreach ($brand as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id'].'-'.$val['nama_brand']}}" name="aksesoris_brand_id">
                                            {{$val['nama_brand']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-add-item " id="vendorItem">
                                <div class="mb-3">
                                    <label for="InputVendor" class="form-label">Vendor</label>
                                    <select type="number" name="frame_vendor_id" class="form-control" id="">
                                        @foreach ($vendor as $val)
                                        <option value="" disabled selected hidden>Choose...</option>
                                        <option value="{{$val['id']}}" name="frame_vendor_id">
                                            {{$val['nama_vendor']}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
