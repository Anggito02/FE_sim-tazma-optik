@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}
    
    <!-- Filter -->
    <div class="card shadow mb-4">
        <span id="tambah_info"></span>
        <form id="BranchItemForm" action="/branch-item" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row black-text">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-4">
                    <label for="jenis_item" class="form-label">Jenis Item</label>
                    <select id="jenis_item" width="100%" name="jenis_item" class="form-control chosen-select">
                        <option value="" {{ $jenis_item == '' ? 'selected' : '' }}>-- Pilih Jenis Item --</option>
                        <option value="frame" {{ $jenis_item == 'frame' ? 'selected' : '' }}>Frame</option>
                        <option value="lensa" {{ $jenis_item == 'lensa' ? 'selected' : '' }}>Lensa</option>
                        <option value="aksesoris" {{ $jenis_item == 'aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="branch_id" class="form-label">Cabang</label>
                    <select name="branch_id" id="branch_id" class="form-control chosen-select">
                        <option value="" {{ $branch_id == '' ? 'selected' : ''}}>-- Pilih Cabang --</option>
                        @foreach ($branch as $val)
                            <option value="{{$val['id']}}" {{ $branch_id == $val['id'] ? 'selected' : ''}}>{{$val['nama_branch']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <br/>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="table-layout: fixed; width: 100%; border-collapse: collapse;" id="data_branch_item_table_1" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr style="white-space: nowrap;">
                            <th class="thead-text" style="width: 5%"><span class="nowrap">No</span></th>
                            <th class="thead-text" style="width: 15%"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text" style="width: 15%"><span class="nowrap">Kode Item</span></th>
                            <th class="thead-text" style="width: auto"><span class="nowrap">Stok Global</span></th>
                            <th class="thead-text" style="width: 15%"><span class="nowrap">Stok Cabang</span></th>
                            <th class="thead-text" style="width: 15%"><span class="nowrap">Kode Cabang</span></th>
                            <th class="thead-text" style="width: auto"><span class="nowrap">Nama Cabang</span></th>
                        </tr>
                    </thead>
                    <tbody class="text-center" style="white-space: nowrap;">

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

    function formatNumber(number) {
		if(number!==null && number!=="null"){
			return new Intl.NumberFormat('de-DE').format(parseFloat(number));
		}else{
			return '0';
		}
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
                    'jenis_item':settings.jenis_item,
                    'branch_id':settings.branch_id,
                },
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refresh your browser");
			    },
                success : function(result){
                    console.log(result.data);
					var table = $('#data_branch_item_table_1').DataTable();
                    let rowData = [];
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
						offsetN0++;
                        rowData.push([
							offsetN0,
                            currentItem.jenis_item,
                            currentItem.kode_item,
                            currentItem.stok_global,
                            currentItem.stok_branch,
                            currentItem.kode_branch,
                            currentItem.nama_branch
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
            data_url: "{{ url('/branch-item/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            jenis_item           : document.getElementById('jenis_item').value,
            branch_id           : document.getElementById('branch_id').value,
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
        var table = $('#data_branch_item_table_1').DataTable( {
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
</script>
    
</div>
@endsection
