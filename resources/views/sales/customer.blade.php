@extends('layout')
@section('content')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <span id="tambah_info"></span>
        <form id="itemForm" action="/customer" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-3">
                    <label for="nama_depan" class="form-label black-text">First Name</label>
                    <input type="text" name="nama_depan" id="nama_depan" class="form-control" value="{{$nama_depan}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="nama_belakang" class="form-label black-text">Last Name</label>
                    <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" value="{{$nama_belakang}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="usia_from" class="form-label black-text">Age From</label>
                    <input type="number" name="usia_from" id="usia_from" class="form-control" value="{{$usia_from}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="usia_until" class="form-label black-text">Age Until</label>
                    <input type="number" name="usia_until" id="usia_until" class="form-control" value="{{$usia_until}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="jenis_item" class="form-label black-text">Gender</label>
                    <select name="gender" id="gender" class="form-control chosen-select">
                        <option value=""selected>Choose...</option>
                        <option name="gender" value="laki-laki">Laki-laki</option>
                        <option name="gender" value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="jenis_item" class="form-label black-text">Branch</label>
                    <select name="branch_id" id="branch_id" class="form-control chosen-select">
                        <option value=""selected>Choose...</option>
                        @foreach ($branch as $cabang)
                        <option name="branch_id" value="{{$cabang['id']}}">{{$cabang['nama_branch']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="jenis_item" class="form-label black-text">Kab. Kota</label>
                    <select name="kabkota_id" id="kabkota_id" class="form-control chosen-select">
                        <option value=""selected>Choose...</option>
                        @foreach ($kabkota as $kakot)
                        <option name="kabkota_id" value="{{$kakot['ID_KK']}}">{{$kakot['nama_kabkota']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <br/>
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button type="button" class="btn btn-success btn-new-item" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i> New Customer</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_customer_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Depan</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Belakang</span></th>
                            <th class="thead-text"><span class="nowrap">Email</span></th>
                            <th class="thead-text"><span class="nowrap">No Telepon</span></th>
                            <th class="thead-text"><span class="nowrap">Alamat</span></th>
                            <th class="thead-text"><span class="nowrap">Usia</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Lahir</span></th>
                            <th class="thead-text"><span class="nowrap">Gender</span></th>
                            <th class="thead-text"><span class="nowrap">Branch</span></th>
                            <th class="thead-text"><span class="nowrap">Kota</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
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
    // function confirmDelete(itemId) {
    //     var confirmation = confirm("Are you sure you want to delete this item?");
    //     if (confirmation) {
    //         deleteItem(itemId);
    //     }
    // }
    // function deleteItem(id) {
    // $.ajax({
	// 	    url   	: "{{ url('/item/delete') }}",
	// 	    data 	:{'id':id},
	// 	    method	: "POST",
    //     error: function (request, error) {
    //             console.log(error);
    //             alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
    //     },
    //     success: function(result) {
    //         // console.log(result);
    //         if(result.message=="The data has been successfully deleted"){
    //                 $('#tambah_info').html(' <div class="alert alert-success alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
    //                 setTimeout(function(){
    //                 $('#tambah_info').hide();
    //                 location.reload();
    //                 },3500);
    //         }else{
    //             $('#tambah_info').html(' <div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
    //             setTimeout(function(){
    //                 $('#tambah_info').hide();
    //                 location.reload();
    //             },3000)
    //             }
    //         },
    //     });
    // }
    $(document).ready(function() {
        $(".chosen-select").chosen({width: "100%"}); // Contoh mengatur lebar
    });
    
    $('#add-update-data').on('shown.bs.modal', function (e) {
        $(".select2").select2();
    });
    
    function handleButtonClick(nomor_telepon) {
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
		    url   	: "{{ url('/customer/loadDataDetailOnly') }}",
		    data 	:{'nomor_telepon':nomor_telepon},
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
                    '_token':csrfToken,
                    'nama_depan':settings.nama_depan,
                    'nama_belakang':settings.nama_belakang,
                    'usia_from':settings.usia_from,
                    'usia_until':settings.usia_until,
                    'gender':settings.gender,
                    'branch_id':settings.branch_id,
                    'kabkota_id':settings.kabkota_id
                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    console.log(result.data);
					var table = $('#data_customer_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        button_draft_1 = ' <button type="button" class="btn-sm btn-primary" onclick="handleButtonClick(\'' + currentItem.nomor_telepon + '\')"><i class="fa fa-edit"></i></button>';
                        rowData.push([
							offsetN0,
                            currentItem.nama_depan,
                            currentItem.nama_belakang,
                            currentItem.email,
                            currentItem.nomor_telepon,
                            currentItem.alamat,
                            currentItem.usia,
                            currentItem.tanggal_lahir,
                            currentItem.gender,
                            currentItem.branch_nama,
                            currentItem.nama_kabkota,
                            button_draft_1,
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
            data_url: "{{ url('/customer/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            nama_depan      : document.getElementById('nama_depan').value, //initial page
            nama_belakang      : document.getElementById('nama_belakang').value, //initial page
            usia_from      : document.getElementById('usia_from').value, //initial page
            usia_until      : document.getElementById('usia_until').value, //initial page
            gender      : document.getElementById('gender').value, //initial page
            branch_id      : document.getElementById('branch_id').value, //initial page
            kabkota_id      : document.getElementById('kabkota_id').value //initial page
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
        var table = $('#data_customer_table_1').DataTable( {
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
            url   : "{{ url('/customer/add') }}",
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
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
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
                <h5 class="modal-title black-text bold-text" id="exampleModalLongTitle">New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>
            <div class="modal-body">
                <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    @method("POST")
                    <div class="row">
                        <div class="col">

                            <div class="form-add-item">
                                <div class="mb-3 black-text">
                                    <label for="InputItemAksesoris" class="form-label">Nama Depan</label>
                                    <input type="text" name="nama_depan" class="form-control">
                                </div>
                            </div>
                            <div class="form-add-item ">
                                <div class="mb-3 black-text">
                                    <label for="InputItemAksesoris" class="form-label">Nama Belakang</label>
                                    <input type="text" name="nama_belakang" class="form-control">
                                </div>
                            </div>
                            <div class="form-add-item ">
                                <div class="mb-3 black-text">
                                    <label for="InputItemAksesoris" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="form-add-item ">
                                <div class="mb-3 black-text">
                                    <label for="InputItemAksesoris" class="form-label">No Telepon</label>
                                    <input type="text" name="nomor_telepon" class="form-control">
                                </div>
                            </div>
                            <div class="form-add-item ">
                                <div class="mb-3 black-text">
                                    <label for="InputItemAksesoris" class="form-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-add-item ">
                                <div class="mb-3 black-text">
                                    <label for="InputItemAksesoris" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-3 black-text">
                                <label for="jenis_item" class="form-label black-text">Gender</label>
                                <select name="gender" class="form-control chosen-select">
                                    <option value="0"selected>Choose...</option>
                                    <option name="gender" value="laki-laki">laki-laki</option>
                                    <option name="gender" value="perempuan">perempuan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 black-text">
                                <label for="jenis_item" class="form-label black-text">Branch</label>
                                <select name="branch_id" class="form-control chosen-select">
                                    <option value="0"selected>Choose...</option>
                                    @foreach ($branch as $cabang)
                                    <option name="branch_id" value="{{$cabang['id']}}">{{$cabang['nama_branch']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 black-text">
                                <label for="jenis_item" class="form-label black-text">Kab. Kota</label>
                                <select name="kabkota_id" class="form-control chosen-select">
                                    <option value="0"selected>Choose...</option>
                                    @foreach ($kabkota as $kakot)
                                    <option name="kabkota_id" value="{{$kakot['ID_KK']}}">{{$kakot['nama_kabkota']}}</option>
                                    @endforeach
                                </select>
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

@endsection
