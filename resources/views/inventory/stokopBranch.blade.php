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
        <form id="itemForm" action="/stock-opname-branch" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-4">
                    <label for="bulan" class="form-label black-text">Bulan</label>
                    <select id="bulan" name="bulan" class="form-control chosen-select">
                        <option value=""selected>--Pilih Bulan--</option>
                        <option value="januari"  >Januari</option>
                        <option value="februari"  >Februari</option>
                        <option value="maret"  >Maret</option>
                        <option value="april"  >April</option>
                        <option value="mei" >Mei</option>
                        <option value="juni"  >Juni</option>
                        <option value="juli"  >Juli</option>
                        <option value="agustus"  >Agustus</option>
                        <option value="september" >September</option>
                        <option value="oktober"  >Oktober</option>
                        <option value="november"  >November</option>
                        <option value="desember"  >Desember</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="cabang" class="form-label black-text">Cabang</label>
                    <select name="branch_id" id="branch_id" class="form-control chosen-select">
                        <option value=""selected>--Pilih Cabang--</option>
                        @foreach ($branch as $branches)
                            <option value="{{ $branches['id'] }}">{{ $branches['nama_branch'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="tahun" class="form-label black-text">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" value="">
                </div>
                <div class="form-group col-md-12">
                    <br/>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                    <button type="button" class="btn btn-warning"><i class="fa-solid fa-eye"></i>Show All</button>
                    <button type="button" class="btn btn-success btn-new-item" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i> New Stock</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="table-layout:fixed; width:100%; border-collapse:collapse;" id="data_opname_branch_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text" style="width: 5%;"><span class="nowrap">No</span></th>
                            <th class="thead-text" style="width: auto;"><span class="nowrap">Tahun</span></th>
                            <th class="thead-text" style="width: auto;"><span class="nowrap">Bulan</span></th>
                            <th class="thead-text" style="width: auto;"><span class="nowrap">Cabang</span></th>
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
    function handleButtonClick(id, branch_id) {
        console.log(id, branch_id);
        window.location.href = "/stock-opname-branch/detail/"+id;
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
                    'branch_id':settings.branch_id
                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    console.log(result.data);
					var table = $('#data_opname_branch_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        button_draft = ' <button type="button" class="btn-sm btn-warning" onclick="handleButtonClick(\'' + currentItem.id + '\',\'' + currentItem.branch_id + '\')">Detail</button>';
                        rowData.push([
							offsetN0,
                            currentItem.tahun,
                            currentItem.bulan,
                            currentItem.nama_branch,
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
            data_url: "{{ url('/stock-opname-branch/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            tahun      : document.getElementById('tahun').value, //initial page
            bulan      : document.getElementById('bulan').value, //initial page
            branch_id      : document.getElementById('branch_id').value, //initial page
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
        var table = $('#data_opname_branch_table_1').DataTable( {
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
            url   : "{{ url('/stock-opname-branch/add') }}",
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
                    <div class="form-group">
                        <label for="input_branch" class="form-label">Pilih Cabang</label>
                        <select name="branch_id" class="form-control chosen-select">
                            <option value="">Pilih Cabang</option>
                            @foreach ($branch as $branches)
                            <option value="{{ $branches['id'] }}">{{ $branches['nama_branch'] }}</option>
                        @endforeach
                        </select>
                    </div>
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