@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="mb-4">
        <a href="/stock-opname"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
    <!-- Filter -->
    <div class="card shadow mb-4">
        <span id="tambah_info"></span>
        <form id="itemForm" action="/stock-opname/detail/{{$stock_opname_id}}" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                    <!-- Add the form inside the row -->
                    @csrf
                    @method("GET")
                    <div class="form-group col-md-3">
                        <label for="tanggal_so_from" class="form-label black-text">Tanggal SO From</label>
                        <input type="date" name="tanggal_so_from" id="tanggal_so_from" class="form-control" value="{{$tanggal_so_from}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tanggal_so_until" class="form-label black-text">Tanggal SO Until</label>
                        <input type="date" name="tanggal_so_until" id="tanggal_so_until" class="form-control" value="{{$tanggal_so_until}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adjustment_date_from" class="form-label black-text">Adjustment Date From</label>
                        <input type="date" name="adjustment_date_from" id="adjustment_date_from" class="form-control" value="{{$adjustment_date_from}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adjustment_date_until" class="form-label black-text">Adjustment Date Until</label>
                        <input type="date" name="adjustment_date_until" id="adjustment_date_until" class="form-control" value="{{$adjustment_date_until}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adjustment_type" class="form-label black-text">Adjustment Type</label>
                        <select type="text" name="adjustment_type" id="adjustment_type" class="form-control chosen-select">
                            <option value="" {{ $adjustment_type == '' ? 'selected' : ''}}>Choose...</option>
                            <option value="IN" {{ $adjustment_type == 'IN' ? 'selected' : ''}}>IN</option>
                            <option value="OUT" {{ $adjustment_type == 'OUT' ? 'selected' : ''}}>OUT</option>
                            <option value="NONE" {{ $adjustment_type == 'NONE' ? 'selected' : ''}}>NONE</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adjustment_status" class="form-label black-text">Adjustment Status</label>
                        <select type="text" name="adjustment_status" id="adjustment_status" class="form-control chosen-select">
                            <option value="" {{ $adjustment_status == '' ? 'selected' : ''}}>Choose...</option>
                            <option value="OPEN" {{ $adjustment_status == 'OPEN' ? 'selected' : ''}}>OPEN</option>
                            <option value="CLOSED" {{ $adjustment_status == 'CLOSED' ? 'selected' : ''}}>CLOSED</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="jenis_item" class="form-label black-text">Jenis Item</label>
                        <select name="jenis_item" id="jenis_item" class="form-control chosen-select">
                            <option value="" {{ $jenis_item == '' ? 'selected' : ''}}>Choose...</option>
                            <option value="frame" {{ $jenis_item == 'frame' ? 'selected' : ''}}>Frame</option>
                            <option value="lensa" {{ $jenis_item == 'lensa' ? 'selected' : ''}}>Lensa</option>
                            <option value="aksesoris" {{ $jenis_item == 'aksesoris' ? 'selected' : ''}}>Aksesoris</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="open_by" class="form-label black-text">Open and Closed By</label>
                        <select name="open_by" id="open_by" class="form-control chosen-select" >
                            <option value="" {{ $open_by == null ? 'selected' : '' }}>Choose...</option>
                            @foreach($employee as $emp)
                                <option value="{{ $emp['id'] }}" {{ $open_by == $emp['id'] ? 'selected' : ''}}>{{ $emp['employee_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adjustment_by" class="form-label black-text">Adjustment By</label>
                        <select name="adjustment_by" id="adjustment_by" class="form-control chosen-select">
                            <option value="" {{ $adjustment_by == null ? 'selected' : '' }}>Choose...</option>
                            @foreach($employee as $emp)
                                <option value="{{ $emp['id'] }}" {{ $adjustment_by == $emp['id'] ? 'selected' : ''}}>{{ $emp['employee_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" name="closed_by" id="close_by" class="form-control" value="" hidden>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                        <a href="/stock-opname/detail/{{$stock_opname_id}}">
                            <button type="button" class="btn btn-warning"><i class="fa-solid fa-eraser"></i>Clear All</button>
                        </a>
                        <button type="button" class="btn btn-success btn-new-item" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i> New Stock</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_stockopDetail_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Item</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text"><span class="nowrap">Open by</span></th>
                            <th class="thead-text"><span class="nowrap">Close by</span></th>
                            <th class="thead-text"><span class="nowrap">SO Start</span></th>
                            <th class="thead-text"><span class="nowrap">SO End</span></th>
                            <th class="thead-text"><span class="nowrap">SO Duration</span></th>
                            <th class="thead-text"><span class="nowrap">Actual QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Inventory</span></th>
                            <th class="thead-text"><span class="nowrap">Diff QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Positif Diff QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Neg Diff QTY</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Type</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Status</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment by</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Date</span></th>
                            <th class="thead-text"><span class="nowrap">Adjustment Note</span></th>
                            <th class="thead-text"><span class="nowrap">Add Adjust Note</span></th>
                            <th class="thead-text"><span class="nowrap">Adjust</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                        </tr>
                    </thead>
                    <tbody style="white-space: nowrap">

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

<script type="text/javascript">
    
    $(document).ready(function() {
        $(".chosen-select").chosen({width: "100%"}); // Contoh mengatur lebar
    });
    $('#add-update-data').on('shown.bs.modal', function (e) {
        $(".select2").select2();
    });
    function formatNumber(number) {
		if(number!==null && number!=="null"){
			return new Intl.NumberFormat('de-DE').format(parseFloat(number));
		}else{
			return '0';
		}
	}
    
    function handleButtonClickAdjust(id) {
        var button = document.querySelector('button[class="btn-sm btn-primary btn-add-adjust"]');
        // console.log(button);
        button.setAttribute('data-toggle', 'modal');
        button.setAttribute('data-target', '#modalAdjust' + id );
        $('#modalAdjust' + id).modal('show');
    }

    function handleButtonClickEdit(detail_id) {
        // var stock_opname_id = "{{ $stock_opname_id }}";
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
		    url   : "{{ url('/stock-opname/detail/') }}/" + detail_id + "/loadDataDetailOnly",
		    data 	:{'so_id': <?php echo $stock_opname_id ?>,'so_detail_id':detail_id},
		    method	: "POST",
		    success : function(data){
		    	$('#panelUpdateData').html(data);
                $('#add-update-data').modal('show');
		    }
		});
        $('#spin_update').hide();
		$('#spin_update_table').show();
    }

    function closeModal() {
       $('.modal').modal('hide');
    }

    function addContent(settings) {
        var load_img = $('<img/>').attr('src',settings.loading_gif_url).addClass('loading-image');
        var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info');
        offsetN0=settings.start_page*settings.limit;
        if(loading == false && end_record == false){
            loading = true;
            $("#forLoad").append(load_img);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "POST",
                type  : 'ajax',
                url   : settings.data_url,
                data  : { 
                    'limit':settings.limit,
                    'page':(settings.limit*settings.start_page),
                    '_token':csrfToken,
                    'stock_opname_id':settings.stock_opname_id,
                    'tanggal_so_from':settings.tanggal_so_from,
                    'tanggal_so_until':settings.tanggal_so_until,
                    'adjustment_type':settings.adjustment_type,
                    'adjustment_date_from':settings.adjustment_date_from,
                    'adjustment_date_until':settings.adjustment_date_until,
                    'jenis_item':settings.jenis_item,
                    'open_by':settings.open_by,
                    'close_by':settings.close_by,
                    'adjustment_by':settings.adjustment_by,
                    'adjustment_status':settings.adjustment_status
                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    // console.log(result.data);
					var table = $('#data_stockopDetail_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        
                        if(currentItem.adjustment_followup_note != null) {
                            button_draft_1 = ' <button type="button" class="btn-sm btn-secondary btn-add-adjust-note disabled">Add Adjustment Note</button>';
                        } else if(currentItem.adjustment_followup_note == null){
                            button_draft_1 = ' <button type="button" class="btn-sm btn-primary btn-add-adjust-note" onclick="handleButtonAdjustmentNote(\'' + currentItem.id + '\')">Add Adjustment Note</button>';
                        }

                        if(currentItem.adjustment_followup_note == null || currentItem.adjustment_status === 'CLOSED') {
                            button_draft_2 = ' <button type="button" class="btn-sm btn-secondary btn-add-adjust disabled" >Adjust</button>';
                        } else if (currentItem.adjustment_followup_note != null ) {
                            button_draft_2 = ' <button type="button" class="btn-sm btn-primary btn-add-adjust" onclick="handleButtonMakeAdjustment(\'' + currentItem.id + '\')">Adjust</button>';
                        }

                        if(currentItem.adjustment_status === 'CLOSED') {
                            button_draft_3 = ' <button type="button" class="btn-sm btn-secondary btn-edit disabled">Edit</button>';
                        } else if(currentItem.adjustment_status === 'OPEN') {
                            button_draft_3 = ' <button type="button" class="btn-sm btn-primary btn-edit" onclick="handleButtonClickEdit(\'' + currentItem.id + '\')">Edit</button>';
                        }

                        rowData.push([
							offsetN0,
                            currentItem.kode_item,
                            currentItem.jenis_item,
                            currentItem.open_by_name,
                            currentItem.close_by_name,
                            currentItem.so_start,
                            currentItem.so_end,
                            currentItem.so_duration,
                            currentItem.actual_qty,
                            currentItem.system_qty,
                            currentItem.diff_qty,
                            currentItem.positive_diff_qty,
                            currentItem.negative_diff_qty,
                            currentItem.adjustment_type,
                            currentItem.adjustment_status,
                            currentItem.adjustment_by_name,
                            currentItem.adjustment_date,
                            currentItem.adjustment_followup_note,
                            button_draft_1,
                            button_draft_2,
                            button_draft_3
                        ]);
                    }
                    table.rows.add(rowData).draw();
                    if(result.data.length < settings.limit){
                    	$("#forNOmore").html(record_end_txt);
                        load_img.remove();
                        end_record = true;
                    }else{
                    	load_img.remove();
                        loading = false;
                        settings.start_page++; //page increment
                    }
                    $('.dataTables_scrollBody').scrollTop(settings.lastScroll+25);
			        $('div.dataTables_scrollBody').scroll( function(el){
					    if($(this).scrollTop() + $(this).height() >= ($(this)[0] .scrollHeight+ $('.odd').height()/2)-40) {
					      settings.lastScroll=$(this).scrollTop();
					      addContent(settings);
					  	}
					});
                }
            });
        }
    }
    function masterContent() {
        var stock_opname_id = "{{ $stock_opname_id }}";
		var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/stock-opname/detail/') }}/" + stock_opname_id + "/loadDataMaster",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            stock_opname_id      : stock_opname_id, //initial page
            tanggal_so_from      : document.getElementById('tanggal_so_from').value, //initial page
            tanggal_so_until      : document.getElementById('tanggal_so_until').value, //initial page
            adjustment_type      : document.getElementById('adjustment_type').value, //initial page
            adjustment_date_from      : document.getElementById('adjustment_date_from').value, //initial page
            adjustment_date_until      : document.getElementById('adjustment_date_until').value, //initial page
            adjustment_status      : document.getElementById('adjustment_status').value, //initial page
            jenis_item      : document.getElementById('jenis_item').value, //initial page
            open_by      : document.getElementById('open_by').value, //initial page
            close_by      : document.getElementById('open_by').value, //initial page
            adjustment_by      : document.getElementById('adjustment_by').value, //initial page
            kode_qr_po_detail      : document.getElementById('kode_qr_po_detail').value, //initial page
        });
        loading  = false;
	    end_record = false;
	    addContent(settings);
        checkQrCode(settings);
	}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        var table = $('#data_stockopDetail_table_1').DataTable( {
				        fixedHeader: {
				            header: true
				        },
				        scrollY			:$(window).height()-350,
				        scrollX			:true,
				        scrollCollapse	:true,
				        paging			:false,
						searching		:false,
						info 			:false,
						ordering		: false,
				        // fixedColumns:   {
				        //     leftColumns:4},
		// 				// dom: 'Bfrtip',
		// 				// buttons: [
		// 				// 	// 'copy', 'csv', 'excel', 'pdf', 'print'
		// 				// 	'csv', 'excel', 'print'
		// 				// ],

		});
        masterContent();
    });

    function handleButtonAdjustmentNote(id) {
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelAdjustmentNote").html(load_img);
        $.ajax({
            url: "{{ url('/stock-opname/detail/loadAdjustmentNote') }}",
            data: {'sod_id':id, 'so_id': <?php echo $stock_opname_id; ?> },
            method: "POST",
            success: function(data){
                $("#panelAdjustmentNote").html(data);
                $('#add-adjustment-note').modal('show');
            }
        });
        $('#spin_update').hide();
		$('#spin_update_table').show();
    }

    function handleButtonMakeAdjustment(id) {
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelMakeAdjustment").html(load_img);
        $.ajax({
            url: "{{ url('/stock-opname/detail/loadMakeAdjustment') }}",
            data: {'sod_id':id, 'so_id': <?php echo $stock_opname_id; ?>},
            method: "POST",
            success: function(data){
                $("#panelMakeAdjustment").html(data);
                $('#make-adjustment').modal('show');
            }
        });
        $('#spin_update').hide();
		$('#spin_update_table').show();
    }

    function submitFormMakeAdjustment(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var stock_opname_id = "{{ $stock_opname_id }}";
        var form = document.getElementById('add_info_make_adjustment');
        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/stock-opname/detail/') }}/" + stock_opname_id + "/make-adjustment",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                if(result.message=="The data has been successfully updated"){
				  	$('#tambah_info').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				  	setTimeout(function(){
					 $('#tambah_info').hide();
                     location.reload();
					},1000);
			    }else{
				    $('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				    setTimeout(function(){
					$('#tambah_info').hide();
                    location.reload();
				    },1000)
			    }
                $('#btn_submit').show();
		    }
	    });
	return false;
    }

    function submitForm(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var form = document.getElementById('add_info');

        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/stock-opname/detail/add') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                // console.log(result);
            if(result.message=="The data has been successfully updated"){
				  	$('#tambah_info').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				  	setTimeout(function(){
					 $('#tambah_info').hide();
                     location.reload();
					},3500);
			}else{
				$('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				setTimeout(function(){
					$('#tambah_info').hide();
                    location.reload();
				},3000)
			}
            $('#btn_submit').show();
		}
	  });
	  return false;
    }

    function checkQrCode(settings) {
        var csrftoken = $('meta[name="csrf-token"]').attr('content');
        //if event.target is undefined, then it will be null
        // var inputValue = '';
        if(event && event.target){
            var inputValue = event.target.value;
            // console.log(inputValue);
        }
        $.ajax({
            method: 'POST',
            type: 'ajax',
            url: "{{ url('/stock-opname/detail/check-qr-code') }}",
            data: {
                'limit' :settings.limit,
                'page' : (settings.limit*settings.start_page),
                '_token' : csrftoken,
                'kode_qr_po_detail' : inputValue

            },
            async: true,
            dataType: 'json',
            error: function (request, error) {
	      		alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			},
            success: function (result) {
                if(result.status != 'error'){
                    // console.log(result.data);
                    document.getElementById('item_id_onchange').value=result.data.id;
                    document.getElementById('kode_item_onchange').value=result.data.kode_item;
                    document.getElementById('jenis_item_onchange').value=result.data.jenis_item;
                    document.getElementById('stok_item_onchange').value=result.data.stok;
                }
            }
        })
    }

    //prevent form submit on pressing enter in keyboard 
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });
    });

    $(document).ready(function() {
    function insertCurrentDate() {
      const currentDate = new Date();
      const formattedDate = currentDate.toISOString().substring(0, 10);
      $("#date-now").text(formattedDate);
    }

    insertCurrentDate();
    });
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Stock Opname Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>
            <div class="modal-body">
                <form id="add_info_item" class="form-horizontal">
                    @csrf
                    <input type="text" name="kode_qr_po_detail" id="kode_qr_po_detail" autofocus=true class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" onchange="checkQrCode(event)"/>
                    <button type="button" class="btn btn-primary shadow-0" style="border-radius: 0% 20% 20% 0%;"><i class="fas fa-search"></i></button>
                </form>
                <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    <!-- @method("POST") -->
                    <div class="row black-text">
                        <div class="col">
                            <input type="hidden" name="stock_opname_id" value="{{ $stock_opname_id }}">

                            <div class="mb-3">
                                <label for="InputSoStart" class="form-label">SO Start</label>
                                <input type="datetime-local" value="{{Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString()}}" name="so_start" class="form-control" readonly>
                            </div>

                            <!-- <div class="mb-3">
                                <label for="InputSoEnd" class="form-label">SO End</label>
                                <input type="datetime-local" name="so_end" class="form-control">
                            </div> -->
                            
                            <div class="mb-3">
                                <input type="hidden" id="item_id_onchange" name="item_id">

                                <label for="InputItem" class="form-label">Item</label>
                                <input type="text" id="kode_item_onchange" class="form-control" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="InputJenis" class="form-label">Jenis Item</label>
                                <input type="text" id="jenis_item_onchange" class="form-control" readonly>
                            </div>

                        </div>
                        <div class="col">

                            <div class="mb-3">
                                <label for="InputStok" class="form-label">Stok</label>
                                <input type="text" id="stok_item_onchange" class="form-control" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="InputActualQty" class="form-label">Actual Quantity</label>
                                <input type="number" name="actual_qty" class="form-control">
                            </div>


                            <div class="mb-3">
                                <input type="hidden" name="open_by" value="{{$data['id']}}">
                            </div>

                            <div class="mb-3">
                                <input type="hidden" name="close_by" value="{{$data['id']}}">
                            </div>

                            <div class="mt-5 float-right">
                                <button type="submit" class="btn btn-success">Submit</button>
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

<!-- Modal Adjust-->
<div class="modal fade" id="make-adjustment" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Buat Adjustment</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="panelMakeAdjustment">
                
            </div>
            <div class="modal-footer justify-content-center alert alert-danger rounded-0" role="alert">
                <p>Anda tidak bisa kembali setelah melakukan Adjust</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Adjustment Note -->
<div class="modal fade" id="add-adjustment-note" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Buat Adjustment Note</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="panelAdjustmentNote">
                
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="add-update-data" tabindex="-1" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="panelUpdateData">
                
            </div>
        </div>
    </div>
</div>

@endsection
