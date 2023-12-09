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
        <span id="tambah_info"></span>
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
                        <tr style="white-space: nowrap;">
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
<script type="text/javascript">
    function confirmDelete(itemId) {
        var confirmation = confirm("Are you sure you want to delete this item?");
        if (confirmation) {
            deleteItem(itemId);
        }
    }
    function deleteItem(id) {
    $.ajax({
		    url   	: "{{ url('/PO/delete') }}",
		    data 	:{'id':id},
		    method	: "POST",
        error: function (request, error) {
                console.log(error);
                alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
        },
        success: function(result) {
            // console.log(result);
            if(result.message=="The data has been successfully deleted"){
                    $('#tambah_info').html(' <div class="alert alert-success alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
                    setTimeout(function(){
                    $('#tambah_info').hide();
                    location.reload();
                    },3500);
            }else{
                $('#tambah_info').html(' <div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
                setTimeout(function(){
                    $('#tambah_info').hide();
                    location.reload();
                },3000)
                }
            },
        });
    }
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
    function handleButtonClick(id) {
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
		    url   	: "{{ url('/PO/loadDataDetailOnly') }}",
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
                    '_token':csrfToken
                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    console.log(result.data);
					var table = $('#data_item_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        button_draft_1 = ' <button type="button" class="btn-sm btn-primary" onclick="handleButtonClick(\'' + currentItem.id + '\')"><i class="fa fa-edit"></i></button>';
                        button_draft_2 = ' <button type="button" class="btn-sm btn-danger" onclick="confirmDelete(\'' + currentItem.id + '\')"><i class="fa fa-trash"></i></button>';
                        button_draft_3 = ' <button type="button" class="btn-sm btn-primary"><i class="fa fa-eye"></i></button>';
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
		var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/PO/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
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
        var table = $('#data_item_table_1').DataTable( {
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
    function submitForm(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var form = document.getElementById('add_info');

        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/PO/add') }}",
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
</script>

<!-- Modal Update Data -->
<div class="modal fade" id="add-update-data" tabindex="-1"  data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	  <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data PO</h5>
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title black-text" id="exampleModalLongTitle">New Purchase Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>
            <div class="modal-body black-text">
                <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    <!-- @method("POST") -->
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="InputVendor" class="form-label">Vendor</label>
                                <select type="vendor" name="vendor_id" required  class="form-control chosen-select">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    @foreach ($vendor as $val)
                                    <option value="{{$val['id']}}" name="vendor_id">{{$val['nama_vendor']}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="InputMade" class="form-label">Made by</label>
                                <select type="made-by" name="made_by" required class="form-control chosen-select" name="made_by" id="">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    @foreach ($employee as $val)
                                    <option value="{{$val['id']}}" name="made_by">{{$val['employee_name']}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="InputApprove" class="form-label">Approved by</label>
                                <select type="approved-by" name="approved_by" required class="form-control chosen-select" id="">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    @foreach ($employee as $val)
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

                                <select type="check-by" name="checked_by" required class="form-control chosen-select" id="">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    @foreach ($employee as $val)
                                    <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
                                    @endforeach
                                </select>

                            </div>

                            
                            <div class="mb-3">
                                <label for="InputStatus" class="form-label">Status Pembayaran</label>
                                <select type="status-pembayaran" name="status_pembayaran" required class="form-control chosen-select"
                                id="">
                                    <option value="" disabled selected hidden>Choose...</option>
                                    <option value="Sudah Dibayar">Sudah Dibayar</option>
                                    <option value="Belum Dibayar">Belum Dibayar</option>
                                </select>
                            </div>
                        
                            <div class="mb-3">
                                <label for="InputStatus" class="form-label">StatusPO</label>
                                <input type="text" name="status_po" class="form-control" value="OPEN" readonly="readonly">
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
