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
        <form id="itemForm" action="/stock-opname" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-6">
                    <label for="bulan" class="form-label black-text">Bulan</label>
                    <select id="bulan" name="bulan" class="form-control chosen-select">
                        <option value="" {{ $bulan == '' ? 'selected' : '' }}>--Pilih Bulan--</option>
                        <option value="1" {{ $bulan == '1' ? 'selected' : '' }}  >Januari</option>
                        <option value="2" {{ $bulan == '2' ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ $bulan == '3' ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ $bulan == '4' ? 'selected' : '' }}>April</option>
                        <option value="5" {{ $bulan == '5' ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ $bulan == '6' ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ $bulan == '7' ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ $bulan == '8' ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ $bulan == '9' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="tahun" class="form-label black-text">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" value="{{$tahun}}">
                </div>
                <div class="form-group col-md-12">
                    <br/>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                    <a href="/stock-opname">
                        <button type="button" class="btn btn-warning"><i class="fa-solid fa-eraser"></i>Clear All</button>
                    </a>
                    <button type="button" class="btn btn-success btn-new-item" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i> New Stock</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="table-layout:fixed; width:100%; border-collapse:collapse;" id="data_opname_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text" style="width: 10%;"><span class="nowrap">No</span></th>
                            <th class="thead-text" style="width: auto;"><span class="nowrap">Tahun</span></th>
                            <th class="thead-text" style="width: auto;"><span class="nowrap">Bulan</span></th>
                            <th class="thead-text" style="width: auto;"><span class="nowrap">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody class="txt-center" style="white-space: nowrap;">

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
    function formatNumber(number) {
		if(number!==null && number!=="null"){
			return new Intl.NumberFormat('de-DE').format(parseFloat(number));
		}else{
			return '0';
		}
	}
    function handleButtonClick(id) {
        window.location.href = "/stock-opname/detail/"+id;
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
                    'bulan':settings.bulan,
                    'tahun':settings.tahun,
                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    console.log(result.data);
					var table = $('#data_opname_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        button_draft = ' <button type="button" class="btn-sm btn-warning" onclick="handleButtonClick(\'' + currentItem.id + '\')">Detail</button>';
                        if(currentItem.bulan == 1) {
                            currentItem.bulan = 'Januari';
                        } else if(currentItem.bulan == 2) {
                            currentItem.bulan = 'Februari';
                        } else if(currentItem.bulan == 3) {
                            currentItem.bulan = 'Maret';
                        } else if(currentItem.bulan == 4) {
                            currentItem.bulan = 'April';
                        } else if(currentItem.bulan == 5) {
                            currentItem.bulan = 'Mei';
                        } else if(currentItem.bulan == 6) {
                            currentItem.bulan = 'Juni';
                        } else if(currentItem.bulan == 7) {
                            currentItem.bulan = 'Juli';
                        } else if(currentItem.bulan == 8) {
                            currentItem.bulan = 'Agustus';
                        } else if(currentItem.bulan == 9) {
                            currentItem.bulan = 'September';
                        } else if(currentItem.bulan == 10) {
                            currentItem.bulan = 'Oktober';
                        } else if(currentItem.bulan == 11) {
                            currentItem.bulan = 'November';
                        } else if(currentItem.bulan == 12) {
                            currentItem.bulan = 'Desember';
                        }
                        
                        rowData.push([
							offsetN0,
                            currentItem.tahun,
                            currentItem.bulan,
                            button_draft
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
            data_url: "{{ url('/stock-opname/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            tahun      : document.getElementById('tahun').value, //initial page
            bulan      : document.getElementById('bulan').value, //initial page
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
        var table = $('#data_opname_table_1').DataTable( {
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
            url   : "{{ url('/stock-opname/add') }}",
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
<!-- Modal Add Data -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Stock Opname</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="tambah_info"></span>
            </div>
            <div class="modal-body">
                <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                    @csrf
                    <!-- @method("POST") -->
                        <p>Apakah anda yakin ingin menambahkan stock untuk hari ini?</p>
                        <button type="submit" class="btn btn-success float-right">Add new</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection