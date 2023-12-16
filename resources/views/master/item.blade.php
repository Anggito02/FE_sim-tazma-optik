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
        <form id="itemForm" action="/item" method="POST" class="col-md-12 form-horizontal">
            <div class="card-body">
                <div class="row align-items-end">
                <!-- Add the form inside the row -->
                @csrf
                @method("GET")
                <div class="form-group col-md-2">
                    <label for="jenis_item" class="form-label black-text">Jenis Item</label>
                    <select id="jenis_item" width="100%" name="jenis_item" class="form-control chosen-select">
                        <option value="0" {{ $jenis_item == '0' ? 'selected' : '' }}>-- Pilih Jenis Item --</option>
                        <option value="frame" {{ $jenis_item == 'frame' ? 'selected' : '' }}>Frame</option>
                        <option value="lensa" {{ $jenis_item == 'lensa' ? 'selected' : '' }}>Lensa</option>
                        <option value="aksesoris" {{ $jenis_item == 'aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="jenis_item" class="form-label black-text">Vendor</label>
                    <select name="vendor_id" class="form-control chosen-select">
                        <option value="0"selected>Choose...</option>
                        @foreach ($vendor as $val)
                            <option value="{{$val['id']}}">{{$val['nama_vendor']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="kode_item" class="form-label black-text">Kode Item (SKU)</label>
                    <input type="text" name="kode_item" id="kode_item" class="form-control" value="{{$kode_item}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="aksesoris_nama_item" class="form-label black-text">Nama Item</label>
                    <input type="text" name="aksesoris_nama_item" id="aksesoris_nama_item" class="form-control" value="{{$aksesoris_nama_item}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="harga_jual_from" class="form-label black-text">Harga Jual From</label>
                    <input type="number" name="harga_jual_from" id="harga_jual_from" class="form-control" value="{{$harga_jual_from}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="harga_jual_until" class="form-label black-text">Harga Jual Until</label>
                    <input type="number" name="harga_jual_until" id="harga_jual_until" class="form-control" value="{{$harga_jual_until}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="harga_beli_from" class="form-label black-text">Harga Beli From</label>
                    <input type="number" name="harga_beli_from" id="harga_beli_from" class="form-control" value="{{$harga_beli_from}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="harga_beli_until" class="form-label black-text">Harga Beli Until</label>
                    <input type="number" name="harga_beli_until" id="harga_beli_until" class="form-control" value="{{$harga_beli_until}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="diskon_from" class="form-label black-text">Diskon From</label>
                    <input type="number" name="diskon_from" id="diskon_from" class="form-control" value="{{$diskon_from}}">
                </div>
                <div class="form-group col-md-2">
                    <label for="diskon_until" class="form-label black-text">Diskon Until</label>
                    <input type="number" name="diskon_until" id="diskon_until" class="form-control" value="{{$diskon_until}}">
                </div>
                <div class="form-group col-md-3">
                    <br/>
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button type="button" class="btn btn-success btn-new-item" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i> New Item</button>
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
                            <th class="thead-text"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Item (SKU)</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Item</span></th>
                            <th class="thead-text"><span class="nowrap">Kategori (Kelas)</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Brand</span></th>
                            <th class="thead-text"><span class="nowrap">Vendor</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Beli</span></th>
                            <th class="thead-text"><span class="nowrap">Harga Jual</span></th>
                            <th class="thead-text"><span class="nowrap">Stok</span></th>
                            <th class="thead-text"><span class="nowrap">Frame Shape</span></th>
                            <th class="thead-text"><span class="nowrap">Warna Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Frame</span></th>
                            <th class="thead-text"><span class="nowrap">Jenis Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Indeks Lensa</span></th>
                            <th class="thead-text"><span class="nowrap">Deskripsi</span></th>
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
		    url   	: "{{ url('/item/delete') }}",
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
    function formChange() {
        var value_id=document.getElementById("jenis_item_id").value;
        console.log(value_id);
        if(value_id=="frame"){
            var frameKategoriElements = document.querySelectorAll('.frameKategori');
            frameKategoriElements.forEach(function(element) {
                element.style.display = 'block';
            });
            var frameKategoriElements = document.querySelectorAll('.lensaKategori');
            frameKategoriElements.forEach(function(element) {
                element.style.display = 'none';
            });
        }else if(value_id=="lensa"){
            var frameKategoriElements = document.querySelectorAll('.frameKategori');
            frameKategoriElements.forEach(function(element) {
                    element.style.display = 'none';
            });
            var frameKategoriElements = document.querySelectorAll('.lensaKategori');
            frameKategoriElements.forEach(function(element) {
                    element.style.display = 'block';
            });
        }else{
            var frameKategoriElements = document.querySelectorAll('.frameKategori');
            frameKategoriElements.forEach(function(element) {
                    element.style.display = 'none';
            });
            var frameKategoriElements = document.querySelectorAll('.lensaKategori');
            frameKategoriElements.forEach(function(element) {
                    element.style.display = 'none';
            });
        }
    }
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
		    url   	: "{{ url('/item/loadDataDetailOnly') }}",
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
                data  : { 'limit':settings.limit,'page':(settings.limit*settings.start_page),'_token':csrfToken,'jenis_item':settings.jenis_item,'kode_item':settings.kode_item,
                'aksesoris_nama_item':settings.aksesoris_nama_item,'harga_jual_from':settings.harga_jual_from,'harga_jual_until':settings.harga_jual_until,'harga_beli_from':settings.harga_beli_from,'harga_beli_until':settings.harga_beli_until,
                'diskon_from':settings.diskon_from,'diskon_until':settings.diskon_until},
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
                        rowData.push([
							offsetN0,
                            currentItem.jenis_item,
                            currentItem.kode_item,
                            currentItem.aksesoris_nama_item,
                            currentItem.nama_kategori,
                            currentItem.nama_brand,
                            currentItem.nama_vendor,
                            formatNumber(currentItem.harga_beli),
                            formatNumber(currentItem.harga_jual),
                            formatNumber(currentItem.stok),
                            currentItem.frame_sub_kategori,
                            currentItem.frame_nama_warna,
                            currentItem.frame_kode,
                            currentItem.lensa_jenis_lensa,
                            currentItem.lensa_nama_index,
                            currentItem.deskripsi,
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
            data_url: "{{ url('/item/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 50, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            jenis_item      : document.getElementById('jenis_item').value, //initial page
            kode_item      : document.getElementById('kode_item').value, //initial page
            aksesoris_nama_item      : document.getElementById('aksesoris_nama_item').value, //initial page
            harga_jual_from      : document.getElementById('harga_jual_from').value, //initial page
            harga_jual_until      : document.getElementById('harga_jual_until').value, //initial page
            harga_beli_from      : document.getElementById('harga_beli_from').value, //initial page
            harga_beli_until      : document.getElementById('harga_beli_until').value, //initial page
            diskon_from      : document.getElementById('diskon_from').value, //initial page
            diskon_until      : document.getElementById('diskon_until').value, //initial page
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
						columnDefs: [
                            {
								'targets': 7,
								'createdCell':  function (td, cellData, rowData, row, col) {
									var rowNumber = (table.page() * table.page.len()) + (row + 1);
									$(td).attr('align', 'right');
								}
							},
                            {
								'targets': 8,
								'createdCell':  function (td, cellData, rowData, row, col) {
									var rowNumber = (table.page() * table.page.len()) + (row + 1);
									$(td).attr('align', 'right');
								}
							},
                            {
								'targets': 9,
								'createdCell':  function (td, cellData, rowData, row, col) {
									var rowNumber = (table.page() * table.page.len()) + (row + 1);
									$(td).attr('align', 'right');
								}
							},
						]

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
            url   : "{{ url('/item/add') }}",
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
<!-- Modal ADD UPDATE DATA-->
<div class="modal fade" id="add-update-data" tabindex="-1"  data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	  <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
	    <div class="modal-body" id="panelUpdateData">


	    </div>
	  </div>
	</div>
</div>
<!-- Modal ADD UPDATE DATA -->
<!-- Modal Add Data -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Item</h5>
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
                                <label for="InputItem" class="form-label">Jenis Item</label>
                                <select id="jenis_item_id" name="jenis_item" width="100%" required  class="form-control chosen-select" onchange="formChange()" >
                                    <option value="">Choose...</option>
                                    <option value="frame" name="jenis_item">Frame</option>
                                    <option value="lensa" name="jenis_item">Lensa</option>
                                    <option value="aksesoris" name="jenis_item">Aksesoris</option>
                                </select>
                            </div>
                            <div class="form-add-item " id="namaItemAksesoris">
                                <div class="mb-3">
                                    <label for="InputItemAksesoris" class="form-label">Nama Item</label>
                                    <input type="text" name="aksesoris_nama_item" class="form-control">
                                </div>
                            </div>
                            <div class="form-add-item " id="category">
                                <div class="mb-3">
                                    <label for="InputIndexLensa" required class="form-label">Category</label>
                                    <select name="category_id" class="form-control chosen-select">
                                        <option value="" selected >Choose...</option>
                                        @foreach ($category as $val)
                                            <option value="{{$val['id'].'-'.$val['nama_kategori']}}">{{$val['nama_kategori']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-add-item " id="brand">
                                <div class="mb-3">
                                    <label for="InputIndexBrand" required class="form-label">Brand</label>
                                    <select name="brand_id" class="form-control chosen-select">
                                        <option value="" selected>Choose...</option>
                                        @foreach ($brand as $val)
                                            <option value="{{$val['id'].'-'.$val['nama_brand']}}">{{$val['nama_brand']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-add-item " id="vendor">
                                <div class="mb-3">
                                    <label for="InputVendor" class="form-label">Vendor</label>
                                    <select name="vendor_id" class="form-control chosen-select">
                                        <option value=""selected>Choose...</option>
                                        @foreach ($vendor as $val)
                                            <option value="{{$val['id']}}">{{$val['nama_vendor']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-add-item " id="frameSubKategori">
                                <div class="mb-3">
                                    <label for="frame_sku_vendor" class="form-label">SKU Vendor</label>
                                    <input type="text" name="frame_sku_vendor" class="form-control">
                                </div>
                            </div>
                            <div class="form-add-item " id="colorItem">
                                <div class="mb-3">
                                    <label for="InputColor" class="form-label">Warna</label>
                                    <select type="number" name="frame_color_id" class="form-control chosen-select">
                                        <option value="">Choose...</option>
                                        @foreach ($color as $val)
                                        <option value="{{$val['id'].'-'.$val['color_name']}}" name="frame_color_id">
                                            {{$val['color_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="frameKategori" style="display: none;"  id="frameSubKategori">
                                <div class="mb-3">
                                    <label for="InputFrameSub" class="form-label">Frame SUB Kategori</label>
                                    <input type="text" name="frame_sub_kategori" id="frame_sub_kategori"  class="form-control"  >
                                </div>
                            </div>
                            <div class="frameKategori" style="display: none;"  id="frameSubKategori">
                                <div class="mb-3">
                                    <label for="frame_kode" class="form-label">Frame Code</label>
                                    <input type="text" name="frame_kode" id="frame_kode" class="form-control" >
                                </div>
                            </div>
                            <div class="lensaKategori" style="display: none;"  id="indexLensa">
                                <div class="mb-3">
                                    <label for="InputIndexLensa" class="form-label">Index Lensa</label>
                                    <select  name="lensa_index_id" id="lensa_index_id"  class="form-control chosen-select">
                                        <option value="">Choose...</option>
                                        @foreach ($index as $val)
                                            <option value="{{$val['id'].'-'.$val['value']}}">{{$val['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="lensaKategori" style="display: none;"  id="jenisProdukLensa">
                                <div class="mb-3">
                                    <label for="InputBeliLensa" class="form-label">Jenis Produk Lensa</label>
                                    <input type="text" name="lensa_jenis_produk" id="lensa_jenis_produk" class="form-control">
                                </div>
                            </div>
                            <div class="lensaKategori" style="display: none;"  id="jenisLensa">
                                <div class="mb-3">
                                    <label for="InputJenisLensa"  class="form-label">Jenis Lensa</label>
                                    <select name="lensa_jenis_lensa" id="lensa_jenis_lensa" class="form-control">
                                        <option value="">Choose...</option>
                                        <option value="PR">PR</option>
                                        <option value="SV">SV</option>
                                        <option value="DT">DT</option>
                                        <option value="KT">KT</option>
                                        <option value="FT">FT</option>
                                        <option value="MMLS">MMLS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-add-item addItem ">
                                <div class="mb-3 ">
                                    <label for="InputDeskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control ">
                                </div>
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
