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
        <form id="salesForm" action="/sales" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                @csrf
                @method("GET")
                <div class="row">

                    <div class="form-group col-md-3">
                        <label for="branch_id" class="form-label">Cabang</label>
                        <select id="branch_id" name="branch_id" class="form-control select2">
                            <option value="" >-- Pilih Cabang --</option>
                            <option value="" >branch</option>
                        </select>
    
                    </div>
                    <div class="form-group col-md-6">
                        <br />
                        <button type="submit" class="btn-sm btn-primary">Submit</button>
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
                <i class="fa-solid fa-pencil"></i> New Sales
            </button>

        </div>
        <!-- <div class="box"> -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_item_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Nomor Transaksi</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Transaksi</span></th>
                            <th class="thead-text"><span class="nowrap">Sistem Pembayaran</span></th>
                            <th class="thead-text"><span class="nowrap">Nomor Kartu</span></th>
                            <th class="thead-text"><span class="nowrap">Nomor Referensi</span></th>
                            <th class="thead-text"><span class="nowrap">Down Payment</span></th>
                            <th class="thead-text"><span class="nowrap">Total Tagihan</span></th>
                            <th class="thead-text"><span class="nowrap">Status</span></th>
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
            url: "{{ url('/sales/loadDataDetailOnly') }}",
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
                <h5 class="modal-title" id="exampleModalLongTitle">New Sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/sales/add">
                    @csrf
                    @method("POST")
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
