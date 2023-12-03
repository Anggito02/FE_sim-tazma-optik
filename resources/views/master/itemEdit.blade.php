<style>
    .chosen-container .chosen-results {
        font-size: 14px; /* Sesuaikan ukuran font */
    }

</style>
<span id="tambah_info"></span> 
<div class="modal-body">
    <!-- <form method="post" action="/item/edit"> -->
    <form id="edit_info" class="form-horizontal"> 
        @csrf
        <!-- @method("PUT") -->
        <div class="row">
            <input type="hidden" id="id" name="item_id" class="form-control" value="{{$vals['id']}}">
            @if ($vals['jenis_item'] == 'lensa')
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="InputItem" class="form-label">Jenis Item</label> //
                        <input type="text" name="jenis_item" class="form-control" value="{{$vals['jenis_item']}}">
                    </div>
                   
                    <div class="mb-3">
                        <label for="" class="form-label">Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" value="{{$vals['harga_beli']}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{$vals['stok']}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" value="{{$vals['harga_jual']}}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi</label> //
                        <input type="text" name="deskripsi" class="form-control" value="{{$vals['deskripsi']}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Brand</label>
                        <select type="text" name="lensa_brand_id" class="form-control chosen-select">
                            @foreach ($brand as $val)
                                <option value="{{ $val['id'].'-'.$val['nama_brand'] }}" {{ $val['id'] == $vals['lensa_brand_id'] ? 'selected' : '' }}>{{ $val['nama_brand'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lens_category_id" class="form-label">Kategori</label>
                        <select type="text" style="width: 100%" name="lensa_lens_category_id" class="form-control chosen-select">
                            @foreach ($lensaCategory as $val)
                                <option value="{{ $val['id'].'-'.$val['nama_kategori'] }}" {{ $val['id'] == $vals['lensa_lens_category_id'] ? 'selected' : ''}}> {{$val['nama_kategori']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Vendor</label>
                        <select name="frame_vendor_id" class="form-control"
                            value="frame_vendor_id">
                            @foreach ($vendor as $val)
                                <option value="{{ $val['id'].'-'.$val['nama_vendor'] }}"{{ $val['id'] == $vals['frame_vendor_id'] ? 'selected' : '' }}>{{ $val['nama_vendor'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="mb-3">
                        <label for="lensa_jenis_lensa" class="form-label">Jenis Lensa</label>
                        <input type="text" name="lensa_jenis_lensa" class="form-control" value="{{$vals['lensa_jenis_lensa']}}">
                    </div>
                    <div class="mb-3 ">
                        <label for="lensa_jenis_produk" class="form-label">Jenis Produk Lensa</label>
                        <input type="text" name="lensa_jenis_produk" class="form-control" value="{{$vals['lensa_jenis_produk']}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Index Lensa</label>
                        <select name="lensa_index_id" class="form-control chosen-select" id="">
                            @foreach ($index as $val)
                            <option value="{{ $val['id'].'-'.$val['value'] }}" {{ $val['id'] == $vals['lensa_index_id'] ? 'selected' : '' }}>{{ $val['value'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-5 float-right">
                        <button type="submit" class="btn btn-success">Edit Item</button>
                    </div>
                </div>
            @elseif ($vals['jenis_item'] == 'frame')
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Kode Frame</label>
                            <input type="text" name="frame_kode"class="form-control" value="{{$vals['frame_kode']}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Frame SKU Vendor</label>
                            <input type="text" name="frame_sku_vendor" class="form-control" value="{{$vals['frame_sku_vendor']}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Warna</label>
                            <select type="text" name="frame_color_id" class="form-control">
                                @foreach ($color as $val)
                                <option value="{{ $val['id'].'-'.$val['color_name'] }}" {{ $val['id'] == $vals['frame_color_id'] ? 'selected': '' }}>{{ $val['color_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Frame SUB Kategori</label>
                            <input type="text" name="frame_sub_kategori" class="form-control" value="{{$vals['frame_sub_kategori']}}">
                        </div>
                        <div class="mt-5 float-right">
                            <button type="submit" class="btn btn-success">Edit Item</button>
                        </div>
                    </div>
                </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
     $(".chosen-select").chosen({width: "100%"}); // Contoh mengatur lebar
    });
    $("form#edit_info").submit(function(event){
		// $('#spin_edit').show();
		// $('#btn_submit').hide();
		// $('#cancel-row_edit').hide();
		
	  //disable the default form submission
	  event.preventDefault();
	  //grab all form data  
	  var formData = new FormData($(this)[0]);
	 console.log(formData);
	  $.ajax({ 
		url   	: "{{ url('/item/edit') }}",
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
				  	$('#tambah_info').html(' <div class="alert alert-success alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				  	// document.getElementById("add_personal_ni").reset();
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
			// $('#spin_edit').hide();
			// $('#btn_submit').show();
			// $('#cancel-row_edit').show();
			// masterContent();
			// show_data_input();
		} //success
	  });//ajax
	 // loadDataForAdd();
	  return false;
	});// form submit END
</script>

