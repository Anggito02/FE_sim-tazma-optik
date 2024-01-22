@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <span id="tambah_info"></span>
        <form id="itemForm" action="/stock_opname_branch/detail/" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-3">
                    <label for="tanggal_so_from" class="form-label black-text">Tanggal SO From</label>
                    <input type="date" name="tanggal_so_from" id="tanggal_so_from" class="form-control" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="tanggal_so_until" class="form-label black-text">Tanggal SO Until</label>
                    <input type="date" name="tanggal_so_until" id="tanggal_so_until" class="form-control" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="adjustment_type" class="form-label black-text">Adjustment Type</label>
                    <select type="text" name="adjustment_type" id="adjustment_type" class="form-control chosen-select">
                        <option value="" selected>Choose...</option>
                        <option value="IN">IN</option>
                        <option value="OUT">OUT</option>
                        <option value="NONE">NONE</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="adjustment_date_from" class="form-label black-text">Adjustment Date From</label>
                    <input type="date" name="adjustment_date_from" id="adjustment_date_from" class="form-control" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="adjustment_date_until" class="form-label black-text">Adjustment Date Until</label>
                    <input type="date" name="adjustment_date_until" id="adjustment_date_until" class="form-control" value="">
                </div>
                <div class="form-group col-md-3">
                    <label for="adjustment_status" class="form-label black-text">Adjustment Status</label>
                    <select type="text" name="adjustment_status" id="adjustment_status" class="form-control chosen-select">
                        <option value="" selected>Choose...</option>
                        <option value="OPEN">OPEN</option>
                        <option value="CLOSE">CLOSE</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="jenis_item" class="form-label black-text">Jenis Item</label>
                    <select name="jenis_item" id="jenis_item" class="form-control chosen-select">
                        <option value="" selected>Choose...</option>
                        <option value="frame">Frame</option>
                        <option value="lensa">Lensa</option>
                        <option value="aksesoris">Aksesoris</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="open_by" class="form-label black-text">Open By</label>
                    <select name="open_by" id="open_by" class="form-control chosen-select">
                        <option value="" selected>Choose...</option>
                        {{-- @foreach($employee as $emp)
                            <option value="{{ $emp['id'] }}">{{ $emp['employee_name'] }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="close_by" class="form-label black-text">Closed By</label>
                    <select name="close_by" id="close_by" class="form-control chosen-select">
                        <option value="" selected>Choose...</option>
                        {{-- @foreach($employee as $emp)
                            <option value="{{ $emp['id'] }}">{{ $emp['employee_name'] }}</option>
                        @endforeach --}}
                    </select>
                </div>  
                <div class="form-group col-md-3">
                    <label for="adjustment_by" class="form-label black-text">Adjustment By</label>
                    <select name="adjustment_by" id="adjustment_by" class="form-control chosen-select">
                        <option value="" selected>Choose...</option>
                        {{-- @foreach($employee as $emp)
                        <option value="{{ $emp['id'] }}">{{ $emp['employee_name'] }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <br/>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                    <button type="button" class="btn btn-warning"><i class="fa-solid fa-eye"></i>Show All</button>
                    <a href="{{ route('test2') }}">
                        <button type="button" class="btn btn-success btn-new-item"><i class="fa-solid fa-pencil"></i> New Stock</button>
                    </a>
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
                            <th class="thead-text"><span class="nowrap">SYS QTY</span></th>
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

{{-- <script type="text/javascript">
    
    $(document).ready(function() {
        $(".chosen-select").chosen({width: "100%"}); // Contoh mengatur lebar
        $('#datetime-local-adjustment').val(new Date().toISOString().slice(0, 16));
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
    function handleButtonClickAdjustNote(id) {
        var button = document.querySelector('button[class="btn-sm btn-primary btn-add-adjust-note"]');
        console.log(button);
        button.setAttribute('data-toggle', 'modal');
        button.setAttribute('data-target', '#modalAddAdjustment' + id );
        $('#modalAddAdjustment' + id).modal('show');
    }

    function handleButtonClickAdjust(id) {
        var button = document.querySelector('button[class="btn-sm btn-primary btn-add-adjust"]');
        console.log(button);
        button.setAttribute('data-toggle', 'modal');
        button.setAttribute('data-target', '#modalAdjust' + id );
        $('#modalAdjust' + id).modal('show');
    }

    function handleButtonClickEdit(id) {
        var stock_opname_branch_id = "{{ $stock_opname_branch_id }}";
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
		    url   : "{{ url('/stock-opname-branch/detail/') }}/" + stock_opname_branch_id + "/loadDataDetailOnly",
		    data 	:{'id':id},
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
                    'tanggal_so_from':settings.tanggal_so_from,
                    'tanggal_so_until':settings.tanggal_so_until,
                    'adjustment_type':settings.adjustment_type,
                    'adjustment_date_from':settings.adjustment_date_from,
                    'adjustment_date_until':settings.adjustment_date_until,
                    'jenis_item':settings.jenis_item,
                    'open_by':settings.open_by,
                    'close_by':settings.close_by,
                    'adjustment_by':settings.adjustment_by
                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    console.log(result.data);
					var table = $('#data_stockopDetail_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        
                        if(currentItem.adjustment_by != null) {
                            button_draft_1 = ' <button type="button" class="btn-sm btn-secondary btn-add-adjust-note disabled">Add Adjustment Note</button>';
                        } else {
                            button_draft_1 = ' <button type="button" class="btn-sm btn-primary btn-add-adjust-note" onclick="handleButtonClickAdjustNote(\'' + currentItem.id + '\')">Add Adjustment Note</button>';
                        }

                        if(currentItem.adjustment_by === null) {
                            button_draft_2 = ' <button type="button" class="btn-sm btn-secondary btn-add-adjust disabled" >Adjust</button>';
                        } else if(currentItem.adjustment_by) {
                            button_draft_2 = ' <button type="button" class="btn-sm btn-primary btn-add-adjust" onclick="handleButtonClickAdjust(\'' + currentItem.id + '\')">Adjust</button>';
                        }
                        button_draft_3 = ' <button type="button" class="btn-sm btn-primary btn-edit" onclick="handleButtonClickEdit(\'' + currentItem.id + '\')">Edit</button>';

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
        var stock_opname_branch_id = "{{ $stock_opname_branch_id }}";
		var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/stock-opname-branch/detail/') }}/" + stock_opname_branch_id + "/loadDataMaster",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            tanggal_so_from      : document.getElementById('tanggal_so_from').value, //initial page
            tanggal_so_until      : document.getElementById('tanggal_so_until').value, //initial page
            adjustment_type      : document.getElementById('adjustment_type').value, //initial page
            adjustment_date_from      : document.getElementById('adjustment_date_from').value, //initial page
            adjustment_date_until      : document.getElementById('adjustment_date_until').value, //initial page
            adjustment_status      : document.getElementById('adjustment_status').value, //initial page
            jenis_item      : document.getElementById('jenis_item').value, //initial page
            open_by      : document.getElementById('open_by').value, //initial page
            close_by      : document.getElementById('close_by').value, //initial page
            adjustment_by      : document.getElementById('adjustment_by').value, //initial page

        });
        loading  = false;
	    end_record = false;
	    addContent(settings);
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

    function submitFormAdjustmentNote(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var stock_opname_branch_id = "{{ $stock_opname_branch_id }}";
        var form = document.getElementById('add_info_adjustnote');
        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/stock_opname_branch/detail/') }}/" + stock_opname_branch_id + "/init-adjustment",
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

    function submitFormMakeAdjustment(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var stock_opname_branch_id = "{{ $stock_opname_branch_id }}";
        var form = document.getElementById('add_info_make_adjustment');
        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/stock_opname_branch/detail/') }}/" + stock_opname_branch_id + "/make-adjustment",
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

    function submitForm(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var form = document.getElementById('add_info');

        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/stock-opname-branch/detail/add') }}",
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

    $(document).ready(function() {
    function insertCurrentDate() {
      const currentDate = new Date();
      const formattedDate = currentDate.toISOString().substring(0, 10);
      $("#date-now").text(formattedDate);
    }

    insertCurrentDate();
    });
</script> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                <form id="add_info" method="post" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    <!-- @method("POST") -->
                    <div class="row black-text">
                        <div class="col">
                            <input type="hidden" name="stock_opname_branch_id" value="{{ $stock_opname_branch_id }}">

                            <div class="mb-3">
                                <label for="InputSoStart" class="form-label">SO Start</label>
                                <input type="datetime-local" name="so_start" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="InputSoEnd" class="form-label">SO End</label>
                                <input type="datetime-local" name="so_end" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label for="InputGender" class="form-label">Item</label>
                                <select name="item_id" class="form-control chosen-select">
                                    <option value="" selected disabled>Choose...</option>
                                    @foreach ($item as $items)
                                    <option value="{{ $items['id'] }}">{{ $items['kode_item'] }} - {{ $items['jenis_item'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="InputActualQty" class="form-label">Actual Quantity</label>
                                <input type="number" name="actual_qty" class="form-control">
                            </div>


                            <div class="mb-3">
                                <label for="InputOpenBy" class="form-label">Open By</label>
                                <select name="open_by" class="form-control chosen-select">
                                    <option value="" selected disabled>Choose...</option>
                                    @foreach ($employee as $emp)
                                    <option value="{{ $emp['id'] }}">{{ $emp['employee_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="InputCloseBy" class="form-label">Close By</label>
                                <select name="close_by" class="form-control chosen-select"><
                                    <option value="" selected disabled>Choose...</option>
                                    @foreach ($employee as $emp)
                                    <option value="{{ $emp['id'] }}">{{ $emp['employee_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 float-right">
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
</div> --}}

<!-- Modal Adjust-->
{{-- @foreach ($stock_opname_branch_detail as $sod)
<div class="modal fade" id="modalAdjust{{ $sod['id'] }}" tabindex="-1" role="dialog"
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
            <div class="modal-body">
                <form id="add_info_make_adjustment" method="post" onsubmit="submitFormMakeAdjustment(event)">
                    @csrf
                    <!-- @method("POST") -->
                    <div class="d-flex flex-row">
                        <p>Adjust Type : </p>
                        <p style="margin-left:1%;" id="set_adjust_type">{{ $sod['adjustment_type'] }}</p>
                        <input type="hidden" value="{{$sod['adjustment_type']}}" name="adjustment_type">
                    </div>
                    <div class="d-flex flex-row">
                        <p>Adjustment by : </p>
                        <p style="margin-left:1%;" id="set_adjust_by">{{ $data['username'] }}</p>
                        <input type="hidden" value="{{$data['username']}}" name="adjustment_by">
                    </div>
                    <div class="d-flex flex-row">
                        <p>Kode Item - jenis Item : </p>
                        <p style="margin-left:1%;" id="set_item">{{ $sod['kode_item'] }} - {{ $sod['jenis_item'] }}</p>
                        <input type="hidden" value="{{$sod['id']}}" name="item_id">
                    </div>
                    <div class="d-flex flex-row">
                        <p>Adjustment QTY : </p>
                        <p style="margin-left:1%;" id="set_adjust_qty">{{ $sod['diff_qty'] }}</p>
                        <input type="hidden" value="{{$sod['diff_qty']}}" name="in_out_qty">
                    </div>
                    <div class="float-right">
                        <button type="button right" class="btn btn-primary px-4" data-dismiss="">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center alert alert-danger rounded-0" role="alert">
                <p>Can't be undone</p>
            </div>
        </div>
    </div>
</div>
@endforeach --}}

<!-- Modal Adjustment Note -->
{{-- @foreach($stock_opname_branch_detail as $sod)
<div class="modal fade" id="modalAddAdjustment{{ $sod['id'] }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Buat Adjustment Note</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_info_adjustnote" class="form-horizontal" onsubmit="submitFormAdjustmentNote(event)">
                    @csrf
                    <!-- @method("POST") -->
                    <div class="d-flex flex-row">
                        <p>Employee name : </p>
                        <p style="margin-left:1%;">{{$data['username']}}</p>
                        <input type="hidden" value="{{$data['id']}}" name="adjustment_by">
                    </div>
                    <div class="d-flex flex-row">
                        <p>Adjustment date : </p>
                        <p style="margin-left:1%;" id="date-now"></p>
                        <input type="hidden" id="datetime-local-adjustment" name="adjustment_date" value="">
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <label class="m-0">Adjusment note :</label>
                        <input type="textarea" class="form-control" name="adjustment_note">
                    </div>
                    <div class="mt-3 float-right">
                        <button type="submit" class="btn btn-primary px-4" data-dismiss="">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach --}}

@endsection
