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
                data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                New Purchase Order
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">WARNA SHEET</h6>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_item_table_1" width="100%" cellspacing="0">
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
                    <tbody style="white-space: nowrap;">

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
                            <td class="text-white text-success">Sudah Dibayar</td>
                            @elseif ($val['status_pembayaran'] == '0')
                            <td class="text-white text-danger">Belum Dibayar</td>
                            @endif

                            @if ($val['status_penerimaan'] == '1')
                            <td class="text-white text-success">Sudah diterima</td>
                            @elseif ($val['status_penerimaan'] == '0')
                            <td class="text-white text-danger">Belum diterima</td>
                            @endif
                            <td>
                                <a href="/PO/detail/{{ $val['id'] }}">
                                    <button type="button" class="btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                @if ($val['status_po'] == '0')
                                <button type="button" class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-edit"></i>
                                </button>
                                @else
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                @endif

                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Edit Data
                                                    PO</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <form method="post" action="/PO/edit">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" name="id" value="{{$val['id']}}">
                                                            <input type="hidden" name="status_penerimaan" value="{{$val['status_penerimaan']}}">

                                                            <div class="mb-3">
                                                                <label for="UpdateVendor" class="form-label">Vendor</label>
                                                                <select name="vendor_id" class="form-control">
                                                                    <option value="{{$val['vendor_id']}}" selected hidden>{{$val['nama_vendor']}}</option>
                                                                    @foreach ($vendor as $valvendor)
                                                                        <option value="{{$valvendor['id']}}" name="vendor_id">{{$valvendor['nama_vendor']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Status PO</label>
                                                                <select type="text" name="status_po" class="form-control">
                                                                    <option value="@if ($val['status_po'] == 1) OPEN @elseif ($val['status_po'] == 0) CLOSED @endif" selected hidden >@if ($val['status_po'] == 1) OPEN @elseif ($val['status_po'] == 0) CLOSED @endif</option>
                                                                    <option value="1">OPEN</option>
                                                                    <option value="0">CLOSED</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Checked By</label>
                                                                <select type="text" name="checked_by" class="form-control" value="">
                                                                <option value="{{$val['checked_by_id']}}" selected hidden>{{$val['checked_by_name']}}</option>
                                                                    @foreach ($employee as $valemployee)
                                                                        <option value="{{$valemployee['id']}}" name="checked_by">{{$valemployee['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col">

                                                            <div class="mb-3">
                                                                <label class="form-label">Status Pembayaran</label>
                                                                <select name="status_pembayaran" class="form-control">
                                                                    <option value="@if ($val['status_pembayaran'] == 1) Sudah Dibayar @elseif ($val['status_pembayaran'] == 0) Belum Dibayar @endif" selected hidden >@if ($val['status_pembayaran'] == 1) Sudah Dibayar @elseif ($val['status_pembayaran'] == 0) Belum Dibayar @endif</option>
                                                                    <option value="1">Sudah Dibayar</option>
                                                                    <option value="0">Belum Dibayar</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Made By</label>
                                                                <select type="text" name="made_by" class="form-control" value="">
                                                                <option value="{{$val['made_by_id']}}"selected hidden>{{$val['made_by_name']}}</option>
                                                                    @foreach ($employee as $valemployee)
                                                                        <option value="{{$valemployee['id']}}" name="made_by">{{$valemployee['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Approved By</label>
                                                                <select type="text" name="approved_by" class="form-control">
                                                                    <option value="{{$val['approved_by_id']}}"selected hidden>{{$val['approved_by_name']}}</option>
                                                                    @foreach ($employee as $valemployee)
                                                                        <option value="{{$valemployee['id']}}" name="approved_by">{{$valemployee['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mt-5 float-right">
                                                                <button type="button"
                                                                    class="btn-sm btn-success bold-text mb-3"
                                                                    data-toggle="modal"
                                                                    data-target="#exampleModalCenterConfirm{{$val['id']}}">
                                                                    Update
                                                                </button>
                                                                <div class="modal fade"
                                                                    id="exampleModalCenterConfirm{{$val['id']}}"
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
                                                                                Once you change Status PO to "CLOSED" it cannot be
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
                                @if ($val['status_po'] == 0)
                                <button type="button" class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-trash"></i>
                                </button>
                                @else
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                    data-target="#exampleModalCenterDelete{{$id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif

                                <!-- Modal Delete Data -->
                                <div class="modal fade" id="exampleModalCenterDelete{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Delete
                                                    Data PO</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <p>Are you sure you want to delete?</p>
                                            </div>
                                            <div class="modal-footer black-text">

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <form method="post" action="/PO/delete">
                                                    @csrf
                                                    @method("DELETE")

                                                    <input type="hidden" id="id" name="po_id" class="form-control"
                                                        value="{{ $id }}">
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>

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
        <div class="box-body">
            <div id="forLoad"></div>
            <div id="forNOmore"></div>
        </div>
    </div>
</div>

<!-- Your script using jQuery -->
<script>
    function handleButtonClick(id) {
        var load_img = $('<img/>').attr('src', '{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
            url: "{{ url('/po/loadDataDetailOnly') }}",
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
                    'nomor_po': settings.nomor_po,
                    'tanggal_dibuat': settings.tanggal_dibuat,
                    'status_po': settings.status_po,
                    'status_pembayaran': settings.status_pembayaran,
                    'status_penerimaan': settings.status_penerimaan
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
                        button_draft_3 = 
                            ' <button type="button" class="btn-sm btn-info" onclick="handleButtonClick(\'' +
                            currentItem.id + '\')"><i class="fa fa-eye"></i></button>';
                        rowData.push([
                            offsetN0,
                            currentItem.nomor_po,
                            currentItem.tanggal_dibuat,
                            currentItem.status_po,
                            currentItem.status_pembayaran,
                            currentItem.status_penerimaan,
                            button_draft_3,
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
            data_url: "{{ url('/po/loadDataMaster') }}",
            end_record_text: 'No more records found!', //no more records to load
            start_page: 0, //initial page
            limit: 50, //initial page
            htmldata: '', //initial page
            lastScroll: 0, //initial page
            nomor_po: document.getElementById('nomor_po').value, //initial page
            tanggal_dibuat: document.getElementById('tanggal_dibuat').value, //initial page
            status_po: document.getElementById('status_po').value, //initial page
            status_pembayaran: document.getElementById('status_pembayaran').value, //initial page
            status_penerimaan: document.getElementById('status_penerimaan').value, //initial page
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


<!-- Modal Add Data -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Purchase Order</h5>
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
                                    <option value="{{$val['id']}}" name="approved_by">{{$val['employee_name']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="InputVendor" class="form-label">Status Penerimaan</label>
                                <input type="text" name="status_penerimaan" class="form-control" value="Belum Diterima" readonly="readonly">
                            </div>

                        </div>

                        <div class="col">
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
                                <label for="InputStatus" class="form-label">StatusPO</label>
                                <input type="text" name="status_po" class="form-control" value="OPEN" readonly="readonly">
                            </div>

                            <div class="mb-3">
                                <label for="InputStatus" class="form-label">Status Pembayaran</label>
                                <select type="status-pembayaran" name="status_pembayaran" class="form-control"
                                    id="">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    <option value="Sudah Dibayar">Sudah Dibayar</option>
                                    <option value="Belum Dibayar">Belum Dibayar</option>
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
@endsection
