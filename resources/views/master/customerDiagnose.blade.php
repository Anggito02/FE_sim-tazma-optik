@extends('layout')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <div class="card shadow mb-4">
        <span id="tambah_info"></span>
        <form id="itemForm" action="/customer-diagnose" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-3">
                    <label for="customer_nama" class="form-label black-text">Nama</label>
                    <input type="text" name="customer_nama" id="customer_nama" class="form-control" value="{{ $customer_nama }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="form-label black-text">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $tahun }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="form-label black-text">Nomor Telepon</label>
                    <input type="text" name="customer_nomor_telepon" id="customer_nomor_telepon" class="form-control" value="{{ $customer_nomor_telepon }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="form-label black-text">Cabang</label>
                    <select name="branch_id" id="" class="form-control chosen-select">
                        <option value="" {{ $branch_id == '' ? 'selected' : '' }}>-- Pilih Cabang --</option>
                        @foreach ($branch as $val)
                            <option value="{{$val['id']}}" {{ $val['id'] == $branch_id ? 'selected' : '' }}>{{$val['kode_branch']}} - {{$val['nama_branch']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="" class="form-label black-text">Diagnosa Oleh</label>
                    <select name="diagnosed_by" id="" class="form-control chosen-select">
                        <option value="" {{ $diagnosed_by == '' ? 'selected' : '' }}>-- Pilih Diagnosa Oleh --</option>
                        @foreach ($employee as $val)
                            <option value="{{$val['id']}}" {{ $val['id'] == $diagnosed_by ? 'selected' : '' }}>{{$val['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="" class="form-label black-text">Bulan</label>
                    <select name="bulan" id="" class="form-control chosen-select">
                        <option value="" {{ $bulan == '' ? 'selected' : '' }}>-- Pilih Bulan --</option>
                        <option value="1"{{ $bulan == '1' ? 'selected' : ''}}>Januari</option>
                        <option value="2"{{ $bulan == '2' ? 'selected' : ''}}>Februari</option>
                        <option value="3"{{ $bulan == '3' ? 'selected' : ''}}>Maret</option>
                        <option value="4"{{ $bulan == '4' ? 'selected' : ''}}>April</option>
                        <option value="5"{{ $bulan == '5' ? 'selected' : ''}}>Mei</option>
                        <option value="6"{{ $bulan == '6' ? 'selected' : ''}}>Juni</option>
                        <option value="7"{{ $bulan == '7' ? 'selected' : ''}}>Juli</option>
                        <option value="8"{{ $bulan == '8' ? 'selected' : ''}}>Agustus</option>
                        <option value="9"{{ $bulan == '9' ? 'selected' : ''}}>September</option>
                        <option value="10"{{ $bulan == '10' ? 'selected' : ''}}>Oktober</option>
                        <option value="11"{{ $bulan == '11' ? 'selected' : ''}}>November</option>
                        <option value="12"{{ $bulan == '12' ? 'selected' : ''}}>Desember</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="/customer-diagnose">
                        <button type="button" class="btn btn-warning"><i class="fa-solid fa-eraser"></i>Clear All</button>
                    </a>
                    <button type="button" class="btn btn-success btn-new-item" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>New Diagnose</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_item_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Customer</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Diagnosa</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Cabang</span></th>
                            <th class="thead-text"><span class="nowrap">Cabang</span></th>
                            <th class="thead-text"><span class="nowrap">Keluhan</span></th>
                            <th class="thead-text"><span class="nowrap">Visus Tanpa Koreksi R</span></th>
                            <th class="thead-text"><span class="nowrap">Visus Tanpa Koreksi L</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Dextra Sph R</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Dextra Cyl R</span></th>
                            <th class="thead-text"><span class="nowrap">Axis R</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Dextra Add R</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Dextra Visus R</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Sinistra Sph L</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Sinistra Cyl L</span></th>
                            <th class="thead-text"><span class="nowrap">Axis L</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Sinistra Add L</span></th>
                            <th class="thead-text"><span class="nowrap">Oculus Sinistra Visus L</span></th>
                            <th class="thead-text"><span class="nowrap">PD</span></th>
                            <th class="thead-text"><span class="nowrap">Diagnosa</span></th>
                            <th class="thead-text"><span class="nowrap">Catatan</span></th>
                            <th class="thead-text"><span class="nowrap">Diagnosed By</span></th>
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
    
    $(document).ready(function() {
        $(".chosen-select").chosen({width: "100%"}); // Contoh mengatur lebar
    });
    
    $('#add-update-data').on('shown.bs.modal', function (e) {
        $(".select2").select2();
    });
    
    function handleButtonClick(id) {
        var load_img = $('<img/>').attr('src','{{ asset("img/ajax-loader.gif") }}').addClass('loading-image');
        $("#panelUpdateData").html(load_img);
        $.ajax({
		    url   	: "{{ url('/customer-diagnose/loadDataDetailOnly') }}",
		    data 	:{'customer_diagnose_id':id},
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
                    'customer_nama':settings.customer_nama,
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
                        rowData.push([
							offsetN0,
                            currentItem.customer_nama_depan + ' ' + currentItem.customer_nama_belakang,
                            currentItem.tanggal_diagnosa,
                            currentItem.branch_check_location_kode,
                            currentItem.branch_check_location_nama,
                            currentItem.keluhan,
                            currentItem.visus_tanpa_koreksi_R,
                            currentItem.visus_tanpa_koreksi_L,
                            currentItem.oculus_dextra_sph_R,
                            currentItem.oculus_dextra_cyl_R,
                            currentItem.axis_R,
                            currentItem.oculus_dextra_add_R,
                            currentItem.oculus_dextra_visus_R,
                            currentItem.oculus_sinistra_sph_L,
                            currentItem.oculus_sinistra_cyl_L,
                            currentItem.axis_L,
                            currentItem.oculus_sinistra_add_L,
                            currentItem.oculus_sinistra_visus_L,
                            currentItem.PD,
                            currentItem.diagnosa,
                            currentItem.catatan,
                            currentItem.diagnosed_by_nama,
                            button_draft_1
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
            data_url: "{{ url('/customer-diagnose/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            customer_nama      : document.getElementById('customer_nama').value, //initial page
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
            url   : "{{ url('/customer-diagnose/add') }}",
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
                    //  location.reload();
					},1000);
			}else{
				$('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				setTimeout(function(){
					$('#tambah_info').hide();
                    // location.reload();
				},1000)
			}
            $('#btn_submit').show();
		}
	  });
	  return false;
    }
</script>
<!-- Modal UPDATE DATA-->
<div class="modal fade" id="add-update-data" tabindex="-1"  data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	  <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
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
                <h5 class="modal-title" id="exampleModalLongTitle">New Diagnose</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>
            <div class="modal-body">
                <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    <!-- @method("POST") -->
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="InputCustomer" class="form-label">Customer</label>
                                <select id="" name="customer_id" width="100%" required class="form-control chosen-select">
                                    <option value="" selected hidden disabled>Choose...</option>
                                    @foreach ($customer as $val)
                                        <option value="{{$val['id']}}">{{$val['nama_depan'] . ' ' . $val['nama_belakang']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="InputBranch" class="form-label">Cabang</label>
                                <select id="" name="branch_check_location_id" width="100%" required class="form-control chosen-select">
                                    <option value="" selected hidden disabled>Choose...</option>
                                    @foreach ($branch as $val)
                                        <option value="{{$val['id']}}">{{$val['nama_branch']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="InputKeluhan" class="form-label">Keluhan</label>
                                <input type="text" name="keluhan" id="keluhan"  class="form-control">
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

@push('scripts')
    <script src="{{ asset('js/item.js') }}"></script>
@endpush
