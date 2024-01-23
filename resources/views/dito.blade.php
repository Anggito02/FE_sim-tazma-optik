@extends('layout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <span id="tambah_info"></span>
        <form id="itemForm" action="/kas/all" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-3">
                    <label for="branches" class="form-label black-text">Branches</label>
                    <div class="d-flex">
                        @if (isset($kas_all))
                        <select type="text" name="branch_id" id="branches" class="form-control chosen-select" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                            <option value="" disabled selected hidden>{{$branch_all[(int)$idx_branch-1]['nama_branch']}}</option>
                            @foreach ($branch_all as $branch)
                            <option value="{{$branch['id']}}">{{$branch['nama_branch']}}</option>
                            @endforeach
                        </select>
                        @else
                        <select type="text" name="branch_id" id="branches" class="form-control chosen-select" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                            <option value="" disabled selected hidden>Choose...</option>
                            @foreach ($branch_all as $branch)
                            <option value="{{$branch['id']}}">{{$branch['nama_branch']}}</option>
                            @endforeach
                        </select>
                        @endif
                        <button type="submit" class="btn btn-primary shadow-0" style="border-radius: 0% 20% 20% 0%;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <br/>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                    <button type="button" class="btn btn-warning"><i class="fa-solid fa-eye"></i>Show All</button>
                    <button type="button" class="btn btn-success btn-new-item" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i> New Cash Out</button>
                </div>
            </div>
        </form>
    </div>
    @if(isset($kas_all))
    <div class="card shadow mb-4">

        <div class="card-body mb-3">
            <div class="table-responsive">
                <h3 class="text-center black-text bold-text">CASH OUT</h3>
                <table class="table table-bordered table-striped" id="data_cashout_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Open Kas Date</span></th>
                            <th class="thead-text"><span class="nowrap">Close Kas Date</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Additional Capital</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Initial Cash</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Final Cash</span></th>
                            <th class="thead-text"><span class="nowrap">Employee Name</span></th>
                            {{-- <th class="thead-text"><span class="nowrap">Adjust</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th> --}}
                        </tr>
                    </thead>
                    <tbody style="white-space: nowrap">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <h3 class="text-center black-text bold-text">CASH IN</h3>
                <table class="table table-bordered table-striped" id="data_cashin_table_2" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Open Kas Date</span></th>
                            <th class="thead-text"><span class="nowrap">Close Kas Date</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Additional Capital</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Initial Cash</span></th>
                            <th class="thead-text"><span class="nowrap">Daily Final Cash</span></th>
                            <th class="thead-text"><span class="nowrap">Employee Name</span></th>
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
    @endif
</div>

@if(isset($kas_all))
<script type="text/javascript">

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
                    'tanggal_buka_kas':settings.tanggal_buka_kas,
                    'tanggal_tutup_kas':settings.tanggal_tutup_kas,
                    'modal_tambahan_harian':settings.modal_tambahan_harian,
                    'kas_awal_harian':settings.kas_awal_harian,
                    'kas_akhir_harian':settings.kas_akhir_harian,
                    'employee_name':settings.employee_name,

                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    console.log(result.data);
					var table = $('#data_cashout_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;

                        // if(currentItem.adjustment_by != null) {
                        //     button_draft_1 = ' <button type="button" class="btn-sm btn-secondary btn-add-adjust-note disabled">Add Adjustment Note</button>';
                        // } else {
                        //     button_draft_1 = ' <button type="button" class="btn-sm btn-primary btn-add-adjust-note" onclick="handleButtonClickAdjustNote(\'' + currentItem.id + '\')">Add Adjustment Note</button>';
                        // }

                        // if(currentItem.adjustment_by === null) {
                        //     button_draft_2 = ' <button type="button" class="btn-sm btn-secondary btn-add-adjust disabled" >Adjust</button>';
                        // } else if(currentItem.adjustment_by) {
                        //     button_draft_2 = ' <button type="button" class="btn-sm btn-primary btn-add-adjust" onclick="handleButtonClickAdjust(\'' + currentItem.id + '\')">Adjust</button>';
                        // }
                        // button_draft_3 = ' <button type="button" class="btn-sm btn-primary btn-edit" onclick="handleButtonClickEdit(\'' + currentItem.id + '\')">Edit</button>';

                        rowData.push([
							offsetN0,
                            currentItem.tanggal_buka_kas,
                            currentItem.tanggal_tutup_kas,
                            formatNumber(currentItem.modal_tambahan_harian),
                            formatNumber(currentItem.kas_awal_harian),
                            formatNumber(currentItem.kas_akhir_harian),
                            currentItem.employee_name,
                            // button_draft_1,
                            // button_draft_2,
                            // button_draft_3
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
        var branch = "{{ (int)$idx_branch }}";
		var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('kas/') }}/" + branch-1 + "/loadDataMaster",
            // data_url: "{{ url('/stock-opname/detail/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            tanggal_buka_kas      : document.getElementById('tanggal_buka_kas').value, //initial page
            tanggal_tutup_kas      : document.getElementById('tanggal_tutup_kas').value, //initial page
            modal_tambahan_harian      : document.getElementById('modal_tambahan_harian').value, //initial page
            kas_awal_harian      : document.getElementById('kas_awal_harian').value, //initial page
            kas_akhir_harian      : document.getElementById('kas_akhir_harian').value, //initial page
            employee_name      : document.getElementById('employee_name').value, //initial page


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
        var table = $('#data_cashout_table_1').DataTable( {
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

    // function submitFormAdjustmentNote(event){
	// 	$('#btn_submit').hide();
	// 	$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	//     event.preventDefault();
    //     var form = document.getElementById('add_info_adjustnote');
    //     var formData = new FormData(form);
	//     $.ajax({
    //         url   : "{{ url('/stock-opname/detail/') }}/" + stock_opname_id + "/init-adjustment",
    //         type: 'POST',
    //         data: formData,
    //         async: false,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function (result) {
    //             console.log(result);
    //         if(result.message=="The data has been successfully updated"){
	// 			  	$('#tambah_info').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
	// 			  	setTimeout(function(){
	// 				 $('#tambah_info').hide();
    //                  location.reload();
	// 				},3500);
	// 		}else{
	// 			$('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
	// 			setTimeout(function(){
	// 				$('#tambah_info').hide();
    //                 location.reload();
	// 			},3000)
	// 		}
    //         $('#btn_submit').show();
	// 	}
	//   });
	//   return false;
    // }

    // function submitFormMakeAdjustment(event){
	// 	$('#btn_submit').hide();
	// 	$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	//     event.preventDefault();

    //     var form = document.getElementById('add_info_make_adjustment');
    //     var formData = new FormData(form);
	//     $.ajax({
    //         url   : "{{ url('/stock-opname/detail/') }}/" + stock_opname_id + "/make-adjustment",
    //         type: 'POST',
    //         data: formData,
    //         async: false,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function (result) {
    //             console.log(result);
    //         if(result.message=="The data has been successfully updated"){
	// 			  	$('#tambah_info').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
	// 			  	setTimeout(function(){
	// 				 $('#tambah_info').hide();
    //                  location.reload();
	// 				},3500);
	// 		}else{
	// 			$('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
	// 			setTimeout(function(){
	// 				$('#tambah_info').hide();
    //                 location.reload();
	// 			},3000)
	// 		}
    //         $('#btn_submit').show();
	// 	}
	//   });
	//   return false;
    // }

    // function submitForm(event){
	// 	$('#btn_submit').hide();
	// 	$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	//     event.preventDefault();
    //     var form = document.getElementById('add_info');

    //     var formData = new FormData(form);
	//     $.ajax({
    //         url   : "{{ url('/stock-opname/detail/add') }}",
    //         type: 'POST',
    //         data: formData,
    //         async: false,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function (result) {
    //             console.log(result);
    //         if(result.message=="The data has been successfully updated"){
	// 			  	$('#tambah_info').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
	// 			  	setTimeout(function(){
	// 				 $('#tambah_info').hide();
    //                  location.reload();
	// 				},3500);
	// 		}else{
	// 			$('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
	// 			setTimeout(function(){
	// 				$('#tambah_info').hide();
    //                 location.reload();
	// 			},3000)
	// 		}
    //         $('#btn_submit').show();
	// 	}
	//   });
	//   return false;
    // }

    $(document).ready(function() {
    function insertCurrentDate() {
      const currentDate = new Date();
      const formattedDate = currentDate.toISOString().substring(0, 10);
      $("#date-now").text(formattedDate);
    }

    insertCurrentDate();
    });
</script>
@endif

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
                {{-- <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    <!-- @method("POST") -->
                    <div class="row black-text">
                        <div class="col">
                            <input type="hidden" name="stock_opname_id" value="{{ $stock_opname_id }}">

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
                </form> --}}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Adjust-->
{{-- @foreach ($stock_opname_detail as $sod)
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
                        <input type="hidden" value="{{$data['id']}}" name="adjustment_by">
                    </div>
                    <div class="d-flex flex-row">
                        <p>Kode Item - jenis Item : </p>
                        <p style="margin-left:1%;" id="set_item">{{ $sod['kode_item'] }} - {{ $sod['jenis_item'] }}</p>
                        <input type="hidden" value="{{$sod['item_id']}}" name="item_id">
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
{{-- @foreach($stock_opname_detail as $sod)
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
                    <div class="d-flex flex-column">
                        <div class="mb-3">
                            <p>Employee name : {{$data['username']}}</p>
                            <input type="hidden" value="{{$data['id']}}" name="adjustment_by">
                        </div>
                        <div class="mb-3">
                            <label for="adjustment_date" class="form-label">Adjustment Date : </label>
                            <input type="datetime-local" id="datetime-local-adjustment" name="adjustment_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="m-0">Adjusment note :</label>
                            <input type="textarea" class="form-control" name="adjustment_followup_note">
                        </div>
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
