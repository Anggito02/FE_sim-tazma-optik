@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <span id="tambah_info"></span>
            <div class="card-body">
                <div class="row align-items-end">
                    <!-- Add the form inside the row -->
                    <div class="form-group col-md-3">
                        <label for="branches" class="form-label black-text">Branches</label>
                        <form id="itemForm" action="/kas/all" method="POST" class=" form-horizontal">
                            @csrf
                            @method("GET")
                            <div class="d-flex">

                                @if (isset($kas_all))
                                <select type="text" name="branch_id" id="branches" class="form-control chosen-select"
                                    style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                    @foreach ($branch_all as $branch)
                                    <option value="{{$branch['id']}}"
                                        <?php if($idx_branch==$branch['id']){ echo "selected"; } ?>>
                                        {{$branch['nama_branch']}}</option>
                                    @endforeach
                                </select>
                                @else
                                <select type="text" name="branch_id" id="branches" class="form-control chosen-select"
                                    style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    @foreach ($branch_all as $branch)
                                    <option value="{{$branch['id']}}">{{$branch['nama_branch']}}</option>
                                    @endforeach
                                </select>
                                @endif

                                <button type="submit" class="btn btn-primary shadow-0"
                                    style="border-radius: 0% 20% 20% 0%;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    @if (isset($kas_all))
                    <div class="form-group col-md-12">
                        <br/>
                        <button type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-magnifying-glass"></i> Search</button>
                        <button type="button" class="btn btn-warning"><i class="fa-solid fa-eye"></i> Show All</button>
                        <button type="button" class="btn btn-success btn-new-item" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i> New Cash Out</button>
                        <button type="button" class="btn btn-secondary btn-new-item" data-toggle="modal"
                        data-target="#exampleModalCenterDailyCash"><i class="fa-solid fa-file"></i> New Daily Cash</button>
                        {{-- <form action="/kas/exist" method="POST">
                            @csrf
                            @method("POST")
                            <input hidden name="branch_id" class="form-control" value="{{$idx_branch}}">
                            <button type="submit" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Check Cash Opened</button>
                        </form> --}}
                    </div>
                    @endif

                </div>
            </div>

    </div>
    @if(isset($kas_all))
    <div class="card shadow mb-4">

        <div class="card-body mb-3" style="width:100%">
            <div class="table-responsive">
                <h3 class="text-center black-text bold-text">CASH OUT</h3>
                <table class="table table-bordered table-striped" width="100%" style="table-layout:fixed; width:100%; border-collapse:collapse;" id="data_cashout_table_1"
                    cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text" style="width:10%;"><span class="nowrap">No</span></th>
                            <th class="thead-text" style="width:100%;"><span class="nowrap">Date of Cost Expenditure</span></th>
                            <th class="thead-text" style="width:80%;"><span class="nowrap">Total Cost Expenditure</span></th>
                            <th class="thead-text" style="width:50%;"><span class="nowrap">COA Code</span></th>
                            <th class="thead-text" style="width:50%;"><span class="nowrap">Branch Code</span></th>
                            <th class="thead-text" style="width:80%;"><span class="nowrap">Branch Name</span></th>
                            <th class="thead-text" style="width:50%;"><span class="nowrap">Made By</span></th>
                            <th class="thead-text" style="width:100%;"><span class="nowrap">Description</span></th>
                        </tr>
                    </thead>
                    <tbody style="white-space: normal">

                    </tbody>
                </table>
            </div>
            <div class="box-body">
                <div id="forLoad"></div>
                <div id="forNOmore"></div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <h3 class="text-center black-text bold-text">KAS</h3>
                <table class="table table-bordered table-striped" id="data_cashin_table_2" width="100%" style="table-layout: fixed; width:100%;" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Open Kas Date</span></th>
                            <th class="thead-text"><span class="nowrap">Close Kas Date</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Additional Capital</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Initial Cash</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Final Cash</span></th>
                            <th class="thead-text"><span class="nowrap">Employee Name</span></th>
                        </tr>
                    </thead>
                    <tbody style="white-space: nowrap">
                    </tbody>
                </table>
            </div>
            <div class="box-body1">
                <div id="forLoad1"></div>
                <div id="forNOmore1"></div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <h3 class="text-center black-text bold-text">CASH IN</h3>
                <table class="table table-bordered table-striped" id="data_cashin_table_2" style="table-layout: fixed; width:100%;" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                        </tr>
                    </thead>
                    <tbody style="white-space: nowrap">
                    </tbody>
                </table>
            </div>
            <div class="box-body2">
                <div id="forLoad2"></div>
                <div id="forNOmore2"></div>
            </div>
        </div>



    </div>
    @endif
</div>

@if(isset($kas_all))
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
            width: "100%"
        }); // Contoh mengatur lebar
        $('#datetime-local-adjustment').val(new Date().toISOString().slice(0, 16));
    });
    $('#add-update-data').on('shown.bs.modal', function (e) {
        $(".select2").select2();
    });

    function formatNumber(number) {
        if (number !== null && number !== "null") {
            return new Intl.NumberFormat('de-DE').format(parseFloat(number));
        } else {
            return '0';
        }
    }
    // function handleButtonClickAdjustNote(id) {
    //     var button = document.querySelector('button[class="btn-sm btn-primary btn-add-adjust-note"]');
    //     console.log(button);
    //     button.setAttribute('data-toggle', 'modal');
    //     button.setAttribute('data-target', '#modalAddAdjustment' + id );
    //     $('#modalAddAdjustment' + id).modal('show');
    // }

    // function handleButtonClickAdjust(id) {
    //     var button = document.querySelector('button[class="btn-sm btn-primary btn-add-adjust"]');
    //     console.log(button);
    //     button.setAttribute('data-toggle', 'modal');
    //     button.setAttribute('data-target', '#modalAdjust' + id );
    //     $('#modalAdjust' + id).modal('show');
    // }

    // function handleButtonClickEdit(detail_id) {
    //     $("#panelUpdateData").html(load_img);
    //     $.ajax({
    // 	    url   : "{{ url('/stock-opname/detail/') }}/" + stock_opname_id + "/loadDataDetailOnly",
    // 	    data 	:{'id':detail_id},
    // 	    method	: "POST",
    // 	    success : function(data){
    // 	    	$('#panelUpdateData').html(data);
    //             $('#add-update-data').modal('show');
    // 	    }
    // 	});
    //     $('#spin_update').hide();
    // 	$('#spin_update_table').show();
    // }

    function closeModal() {
        $('.modal').modal('hide');
    }

    function addContent(settings) {
        console.log(settings.idx_branch);
        var load_img = $('<img/>').attr('src', settings.loading_gif_url).addClass('loading-image');
        var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info');
        offsetN0 = settings.start_page * settings.limit;
        if (loading == false && end_record == false) {
            loading = true;
            $("#forLoad1").append(load_img);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "POST",
                type: 'ajax',
                url: settings.data_url,
                data: {
                    'limit': settings.limit,
                    'page': (settings.limit * settings.start_page),
                    '_token': csrfToken,
                    'branch_id': settings.idx_branch
                },
                async: true,
                dataType: 'json',
                error: function (request, error) {
                    alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
                },
                success: function (result) {
                    console.log(result);
                    var table = $('#data_cashin_table_2').DataTable();
                    let rowData = [];
                    for (let i = 0; i < result.data.length; i++) {
                        let currentItem = result.data[i];
                        offsetN0++;
                        rowData.push([
                            offsetN0,
                            currentItem.tanggal_buka_kas,
                            currentItem.tanggal_tutup_kas,
                            formatNumber(currentItem.modal_tambahan_harian),
                            formatNumber(currentItem.kas_awal_harian),
                            formatNumber(currentItem.kas_akhir_harian),
                            currentItem.employee_name,
                        ]);
                    }
                    table.rows.add(rowData).draw();
                    if (result.data.length < settings.limit) {
                        $("#forNOmore1").html(record_end_txt);
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

    function addContentCashOut(settings) {
        console.log(settings.idx_branch);
        var load_img = $('<img/>').attr('src', settings.loading_gif_url).addClass('loading-image');
        var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info');
        offsetN1 = settings.start_page * settings.limit;
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
                    'branch_id': settings.idx_branch
                },
                async: true,
                dataType: 'json',
                error: function (request, error) {
                    alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
                },
                success: function (result) {
                    console.log(result);
                    var table1 = $('#data_cashout_table_1').DataTable();
                    let rowData = [];
                    for (let i = 0; i < result.data.length; i++) {
                        let currentItem = result.data[i];
                        offsetN1++;
                        rowData.push([
                            offsetN1,
                            currentItem.tanggal_pengeluaran,
                            formatNumber(currentItem.jumlah_pengeluaran),
                            currentItem.kode_coa,
                            currentItem.kode_branch,
                            currentItem.nama_branch,
                            currentItem.made_by_name,
                            currentItem.deskripsi,
                        ]);
                    }
                    table1.rows.add(rowData).draw();
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
                            addContentCashOut(settings);
                        }
                    });
                }
            });
        }
    }

    function masterContent() {
        var branch = "<?php echo $idx_branch; ?>";
        branch = parseFloat(branch);
        console.log(branch);
        var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/kas/loadDataMaster/') }}",
            // data_url: "{{ url('/stock-opname/detail/loadDataMaster') }}",
            end_record_text: 'No more records found!', //no more records to load
            start_page: 0, //initial page
            limit: 50, //initial page
            htmldata: '', //initial page
            lastScroll: 0, //initial page
            idx_branch: <?php echo $idx_branch; ?> , //initial page

        });
        loading = false;
        end_record = false;
        addContent(settings);
    }

    function masterContentCashOut() {
        var branch = "<?php echo $idx_branch; ?>";
        branch = parseFloat(branch);
        console.log(branch);
        var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/kas/loadDataMasterCashOut/') }}",
            // data_url: "{{ url('/stock-opname/detail/loadDataMaster') }}",
            end_record_text: 'No more records found!', //no more records to load
            start_page: 0, //initial page
            limit: 50, //initial page
            htmldata: '', //initial page
            lastScroll: 0, //initial page
            idx_branch: <?php echo $idx_branch; ?> , //initial page

        });
        loading = false;
        end_record = false;
        addContentCashOut(settings);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        var table = $('#data_cashout_table_1').DataTable({
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

        });

        var tableCashOut = $('#data_cashin_table_2').DataTable({
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

        });
        masterContent();
        masterContentCashOut();
    });

    $(document).ready(function () {
        function insertCurrentDate() {
            const currentDate = new Date();
            const formattedDate = currentDate.toISOString().substring(0, 10);
            $("#date-now").text(formattedDate);
        }

        insertCurrentDate();
    });

</script>
@endif

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Cash Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>
            <div class="modal-body">
                <form method="POST" action="/kas/addCashOut">
                    @csrf
                    @method("POST")
                    <div class="row">
                        <div class="col">
                            <div class="form-add-item " id="namaItemAksesoris">
                                <div class="mb-3">
                                    <label for="jumlah_pengeluaran" class="form-label black-text">Amount of
                                        Expenditure</label>
                                    <input type="number" name="jumlah_pengeluaran" class="form-control">
                                    @if (isset($kas_all))
                                    <input hidden name="made_by" class="form-control" value="{{$data['id']}}">
                                    <input hidden name="branch_id" class="form-control" value="{{$idx_branch}}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-add-item " id="namaItemAksesorisclass=">
                                <div class="mb-3">
                                    <label for="bentuk_pengeluaranr" class="form-label black-text">Form of Expenditure</label>
                                    <select type="employee_name" class="form-control chosen-select" name="bentuk_pengeluaran">
                                        <option value="" disabled selected hidden>Choosee..</option>
                                        <option value="TARIK_MODAL">TARIK MODAL</option>
                                        <option value="LAINNYA">LAINNYA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-add-item " id="namaItemAksesoris">
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label black-text">Description</label>
                                    <textarea type="text" name="deskripsi" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenterDailyCash" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Daily Cash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>

            <div class="modal-body">
                <form method="post" action="/kas/newDaily">
                    @csrf
                    @method("POST")
                    <div class="row">
                        <div class="col">
                            <div class="form-add-item " id="namaItemAksesoris">
                                <div class="mb-3">
                                    <label for="modal_tambahan_harian" class="form-label black-text">Additional Daily Capital</label>
                                    <input type="number" name="modal_tambahan_harian" class="form-control">
                                    @if (isset($kas_all))
                                    <input hidden name="branch_id" class="form-control" value="{{$idx_branch}}">
                                    <input hidden name="employee_id" class="form-control" value="{{$data['id']}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
