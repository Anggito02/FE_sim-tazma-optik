@extends('layout')
@section('content')
<div class="container-fluid">

    {{-- new branch item outgoing --}}
    <div class="card shadow mb-4">
        <div class="card-body black-text">
            <button type="button" class="btn-sm btn-success float-right bold-text" data-toggle="modal"
                data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                New Item Branch Outgoing
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_branch_outgoing_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Nomor Branch Outgoing</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Outgoing</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Pengiriman</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Cabang Asal</span></th>
                            <th class="thead-text"><span class="nowrap">Cabang Asal</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Cabang Tujuan</span></th>
                            <th class="thead-text"><span class="nowrap">Cabang Tujuan</span></th>
                            <th class="thead-text"><span class="nowrap">Known by</span></th>
                            <th class="thead-text"><span class="nowrap">Checked by</span></th>
                            <th class="thead-text"><span class="nowrap">Approved by</span></th>
                            <th class="thead-text"><span class="nowrap">Delivered by</span></th>
                            <th class="thead-text"><span class="nowrap">Received by</span></th>
                            <th class="thead-text"><span class="nowrap">Details</span></th>
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

<script type="text/javascript">

    $(document).ready(function() {
        $(".chosen-select").chosen({width: "100%"}); // Contoh mengatur lebar
    });

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
					var table = $('#data_branch_outgoing_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        button_draft_1 = ' <button type="button" class="btn-sm btn-info" onclick="handleButtonClick(\'' + currentItem.id + '\')"><i class="fa fa-eye"></i></button>';
                        if (currentItem.received_by == null) {
                            button_draft_2 = ' <button type="button" class="btn-sm btn-primary" onclick="handleButtonEditClick(\'' + currentItem.id + '\')"><i class="fa fa-edit"></i></button>';
                            button_draft_3 = ' <button type="button" class="btn-sm btn-danger" onclick="handleButtonDeleteClick(\'' + currentItem.id + '\')"><i class="fa fa-trash"></i></button>';
                        } else if (currentItem.received_by != null) {
                            button_draft_2 = ' <button type="button" class="btn-sm btn-secondary" disabled ><i class="fa fa-edit"></i></button>';
                            button_draft_3 = ' <button type="button" class="btn-sm btn-secondary" disabled ><i class="fa fa-trash"></i></button>';
                        }
                        rowData.push([
							offsetN0,
                            currentItem.nomor_outgoing,
                            currentItem.tanggal_outgoing,
                            currentItem.tanggal_pengiriman,
                            currentItem.kode_branch_from,
                            currentItem.nama_branch_from,
                            currentItem.kode_branch_to,
                            currentItem.nama_branch_to,
                            currentItem.known_by_name,
                            currentItem.checked_by_name,
                            currentItem.approved_by_name,
                            currentItem.delivered_by_name,
                            currentItem.received_by_name,
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
		var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/branch-outgoing/loadDataMaster') }}",
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
        var table = $('#data_branch_outgoing_table_1').DataTable( {
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

    function handleButtonClick(id) {
        window.location.href = "/branch-outgoing/detail/"+id;
    }

    function handleButtonDeleteClick(id) {
        var confirmation = confirm("Are you sure you want to delete this item?");
        if (confirmation) {
            deleteItem(id);
        }
    }
    function deleteItem(id) {
    $.ajax({
		    url   	: "{{ url('/branch-outgoing/delete') }}",
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
                    },1000);
            }else{
                $('#tambah_info').html(' <div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
                setTimeout(function(){
                    $('#tambah_info').hide();
                    location.reload();
                },1000)
                }
            },
        });
    }

    function handleButtonEditClick(id) {
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
		    url   : "{{ url('/branch-outgoing/loadDataDetailOnly')}}",
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

    function submitForm(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var form = document.getElementById('add_info');

        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/branch-outgoing/add') }}",
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

</script>

<!-- Modal Add Data -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Branch Outgoing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>
            <div class="modal-body">
                <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    @method("POST")
                    <div class="row black-text">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal Pengiriman</label>
                                <input type="datetime-local" value="{{Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString()}}" name="tanggal_pengiriman" class="form-control" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Cabang Asal</label>
                                <select name="branch_from_id" id="" class="form-control chosen-select">
                                    <option value="" selected disabled>-- Pilih Cabang --</option>
                                    @foreach ($branch as $branchVal)
                                        <option value="{{$branchVal['id']}}">{{$branchVal['nama_branch']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Cabang Tujuan</label>
                                <select name="branch_to_id" id="" class="form-control chosen-select">
                                    <option value="" selected disabled>-- Pilih Cabang --</option>
                                    @foreach ($branch as $branchVal)
                                        <option value="{{$branchVal['id']}}">{{$branchVal['nama_branch']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Known by</label>
                                <select name="known_by" id="" class="form-control chosen-select">
                                    <option value="" selected disabled>-- Pilih Karyawan --</option>
                                    @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col">

                            <div class="mb-3">
                                <label for="" class="form-label">Approved by</label>
                                <select name="approved_by" id="" class="form-control chosen-select">
                                    <option value="" selected disabled>-- Pilih Karyawan --</option>
                                    @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Delivered by</label>
                                <select name="delivered_by" id="" class="form-control chosen-select">
                                    <option value="" selected disabled>-- Pilih Karyawan --</option>
                                    @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Checked by</label>
                                <select name="checked_by" id="" class="form-control chosen-select">
                                    <option value="" selected disabled>-- Pilih Karyawan --</option>
                                    @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary float-right" id="btn_submit">Submit</button>
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

</div>
@endsection