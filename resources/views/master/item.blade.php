@extends('layout')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- <div class="card shadow">
        <div class="row"> -->
    <!-- <form action="/item" method="POST" class="form-horizontal"> -->
    <!-- @csrf
                @method("GET")
                <div class="col-md-4">
                    <select name="jenis_item" class="form-control">
                        <option value="{{$jenis_item}}" disabled selected hidden>{{$jenis_item}}</option>
                        <option value="frame">Frame</option>
                        <option value="lensa">Lensa</option>
                        <option value="aksesoris">Aksesoris</option>
                    </select>
                </div>
                <div class="col">Column</div>
                <div class="w-100"></div>
                <div class="col">Column</div>
                <div class="col">Column</div> -->
    <!-- </form> -->
    <!-- </div>
    </div> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form id="itemForm" action="/item" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">

                <div class="row">
                    <!-- Add the form inside the row -->
                    @csrf
                    @method("GET")
                    <div class="form-group col-md-3">
                        <label for="jenis_item" class="form-label">Jenis Item</label>
                        <select id="jenis_item" name="jenis_item" class="form-control select2">
                            <option value="0" {{ $jenis_item == '0' ? 'selected' : '' }}>-- Pilih Jenis Item --</option>
                            <option value="frame" {{ $jenis_item == 'frame' ? 'selected' : '' }}>Frame</option>
                            <option value="lensa" {{ $jenis_item == 'lensa' ? 'selected' : '' }}>Lensa</option>
                            <option value="aksesoris" {{ $jenis_item == 'aksesoris' ? 'selected' : '' }}>Aksesoris
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="kode_item" class="form-label">Kode Item (SKU)</label>
                        <input type="text" name="kode_item" id="kode_item" class="form-control" value="{{$kode_item}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="aksesoris_nama_item" class="form-label">Nama Item</label>
                        <input type="text" name="aksesoris_nama_item" id="aksesoris_nama_item" class="form-control"
                            value="{{$aksesoris_nama_item}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="frame_sub_kategori" class="form-label">Frame Shape</label>
                        <input type="text" name="frame_sub_kategori" id="frame_sub_kategori" class="form-control"
                            value="{{$frame_sub_kategori}}">
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-auto">
                        <label for="frame_kode" class="form-label">Frame Code</label>
                        <input type="text" name="frame_kode" id="frame_kode" class="form-control"
                            value="{{$frame_kode}}">
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="lensa_jenis_lensa" class="form-label">Jenis Lensa</label>
                        <input type="text" name="lensa_jenis_lensa" id="lensa_jenis_lensa" class="form-control"
                            value="{{$lensa_jenis_lensa}}">
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="aksesoris_kategori" class="form-label">Kategori Aksesoris</label>
                        <input type="text" name="aksesoris_kategori" id="aksesoris_kategori" class="form-control"
                            value="{{$aksesoris_kategori}}">
                    </div>

                    <!-- <div class="form-group col-md-2">
                        <select name="jenis_item" class="form-control">
                            <option value="{{$jenis_item}}" disabled selected hidden>{{$jenis_item}}</option>
                            <option value="frame">Frame</option>
                            <option value="lensa">Lensa</option>
                            <option value="aksesoris">Aksesoris</option>
                        </select>
                    </div> -->
                    <div class="form-group col-md-auto">
                        <br />
                        <button type="submit" class="btn-sm btn-primary">Submit</button>
                    </div>

                    <div class="form-group col-md-auto">
                        <br />
                        <button type="button" class="btn-sm btn-warning btn-new-item" href="/item">
                            <i class="fa-solid fa-eye"></i> Show All
                        </button>
                    </div>


                </div>
            </div>
        </form>
    </div>

    <div class="card shadow mb-4">
        <div class="px-3">
            <br />
            <button type="submit" class="float-right btn-sm btn-success btn-new-item" data-toggle="modal"
                data-target="#exampleModalCenter">
                <i class="fa-solid fa-pencil"></i> New Item
            </button>

        </div>
        <!-- <div class="box"> -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_item_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Item (SKU)</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Item</span></th>
                            <th class="thead-text"><span class="nowrap">Kategori (Kelas)</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Brand</span></th>
                            <th class="thead-text"><span class="nowrap">Vendor</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Jual</span></th>
                            <th class="thead-text"><span class="nowrap">Stok</span></th>
                            <th class="thead-text"><span class="nowrap">Frame Shape</span></th>
                            <th class="thead-text"><span class="nowrap">Warna Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Indeks Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Kategori Aksesoris</span></th>
                            <th class="thead-text"><span class="nowrap">Deskripsi</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>
                        </tr>
                    </thead>
                    <tbody style="white-space: nowrap;">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-body">
            <div id="forLoad"></div>
            <div id="forNOmore"></div>
        </div>
    </div>
</div>




<!-- Your script using jQuery -->
<script>
    function formatNumber(number) {
        if (number !== null && number !== "null") {
            return new Intl.NumberFormat('de-DE').format(parseFloat(number));
        } else {
            return '0';
        }
    }

    function handleButtonClick(id) {
        var load_img = $('<img/>').attr('src', '{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
            url: "{{ url('/item/loadDataDetailOnly') }}",
            data: {
                'id': id
            },
            method: "POST",
            success: function (data) {
                console.log(data);
                $('#panelUpdateData').html(data);
                $('#add-update-data').modal('show');
            }
        });
        // Lakukan sesuatu dengan nomor draft (draftNumber)
        // alert('Button clicked for draft number: ' + draftNumber);
        // Anda dapat menambahkan logika atau tindakan lain yang diperlukan di sini
        $('#spin_update').hide();
        $('#spin_update_table').show();
    }

    function addContent(settings) {
        var load_img = $('<img/>').attr('src', settings.loading_gif_url).addClass('loading-image');
        var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info');
        offsetN0 = settings.start_page * settings.limit;
        if (loading == false && end_record == false) {
            loading = true;
            $("#forLoad").append(load_img);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "POST",
                type: 'ajax',
                url: settings.data_url,
                data: {
                    'limit': settings.limit,
                    'page': (settings.limit * settings.start_page),
                    '_token': csrfToken,
                    'jenis_item': settings.jenis_item,
                    'kode_item': settings.kode_item,
                    'aksesoris_nama_item': settings.aksesoris_nama_item,
                    'frame_sub_kategori': settings.frame_sub_kategori,
                    'frame_kode': settings.frame_kode,
                    'lensa_jenis_lensa': settings.lensa_jenis_lensa,
                    'aksesoris_kategori': settings.aksesoris_kategori
                },
                async: true,
                dataType: 'json',
                error: function (request, error) {
                    alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
                },
                success: function (result) {
                    console.log(result.data);
                    var table = $('#data_item_table_1').DataTable();
                    let rowData = [];
                    for (let i = 0; i < result.data.length; i++) {
                        let currentItem = result.data[i];
                        offsetN0++;
                        button_draft_1 =
                            ' <button type="button" class="btn-sm btn-primary" onclick="handleButtonClick(\'' +
                            currentItem.id + '\')"><i class="fa fa-edit"></i></button>';
                        button_draft_2 =
                            ' <button type="button" class="btn-sm btn-danger" onclick="handleButtonClick(\'' +
                            currentItem.id + '\')"><i class="fa fa-trash"></i></button>';
                        rowData.push([
                            offsetN0,
                            currentItem.jenis_item,
                            currentItem.kode_item,
                            currentItem.aksesoris_nama_item,
                            "high low dll",
                            "nama Brand",
                            "nama Vendor",
                            formatNumber(currentItem.harga_beli),
                            formatNumber(currentItem.harga_jual),
                            formatNumber(currentItem.stok),
                            currentItem.frame_sub_kategori,
                            "Frame Color",
                            currentItem.frame_kode,
                            currentItem.lensa_jenis_lensa,
                            "Index Lensa",
                            currentItem.aksesoris_kategori,
                            currentItem.deskripsi,
                            button_draft_1,
                            button_draft_2,
                        ]);
                    }
                    table.rows.add(rowData).draw();
                    if (result.data.length < settings.limit) {
                        $("#forNOmore").html(record_end_txt);
                        load_img.remove();
                        end_record = true;
                    } else {
                        load_img.remove();
                        loading = false;
                        settings.start_page++; //page increment
                    }
                    $('.dataTables_scrollBody').scrollTop(settings.lastScroll + 25);
                    $('div.dataTables_scrollBody').scroll(function (el) {
                        if ($(this).scrollTop() + $(this).height() >= ($(this)[0].scrollHeight + $(
                                '.odd').height() / 2) - 40) {
                            settings.lastScroll = $(this).scrollTop();
                            addContent(settings);
                        }
                    });
                }
            });
        }
    }

    function masterContent() {
        var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/item/loadDataMaster') }}",
            end_record_text: 'No more records found!', //no more records to load
            start_page: 0, //initial page
            limit: 50, //initial page
            htmldata: '', //initial page
            lastScroll: 0, //initial page
            jenis_item: document.getElementById('jenis_item').value, //initial page
            kode_item: document.getElementById('kode_item').value, //initial page
            aksesoris_nama_item: document.getElementById('aksesoris_nama_item').value, //initial page
            frame_sub_kategori: document.getElementById('frame_sub_kategori').value, //initial page
            frame_kode: document.getElementById('frame_kode').value, //initial page
            lensa_jenis_lensa: document.getElementById('lensa_jenis_lensa').value, //initial page
            aksesoris_kategori: document.getElementById('aksesoris_kategori').value, //initial page
        });
        loading = false;
        end_record = false;
        addContent(settings);
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        var table = $('#data_item_table_1').DataTable({
            fixedHeader: {
                header: true
            },
            scrollY: $(window).height() - 350,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            searching: false,
            info: false,
            ordering: false,
            // fixedColumns:   {
            //     leftColumns:4},
            // 				// dom: 'Bfrtip',
            // 				// buttons: [
            // 				// 	// 'copy', 'csv', 'excel', 'pdf', 'print'
            // 				// 	'csv', 'excel', 'print'
            // 				// ],
            columnDefs: [{
                    'targets': 7,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        var rowNumber = (table.page() * table.page.len()) + (row + 1);
                        $(td).attr('align', 'right');
                    }
                },
                {
                    'targets': 8,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        var rowNumber = (table.page() * table.page.len()) + (row + 1);
                        $(td).attr('align', 'right');
                    }
                },
                {
                    'targets': 9,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        var rowNumber = (table.page() * table.page.len()) + (row + 1);
                        $(td).attr('align', 'right');
                    }
                },
            ]

        });
        masterContent();
    });

</script>
<!-- Modal UPDATE DATA-->
<div class="modal fade" id="add-update-data" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="panelUpdateData">


            </div>
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

@endsection
