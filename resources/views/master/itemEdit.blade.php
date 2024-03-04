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
        <input type="hidden" readonly=true name="id" class="form-control" value="{{$vals['id']}}">
        <input type="hidden" readonly=true name="stok" class="form-control" value="{{$vals['stok']}}">
        <input type="hidden" readonly=true name="harga_beli" class="form-control" value="{{$vals['harga_beli']}}">
        <input type="hidden" readonly=true name="harga_jual" class="form-control" value="{{$vals['harga_jual']}}">
        <input type="hidden" readonly=true name="diskon" class="form-control" value="{{$vals['diskon']}}">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="InputItem" class="form-label">Jenis Item</label>
                    <input type="text" readonly=true name="jenis_item" id="jenis_item" class="form-control" value="{{$vals['jenis_item']}}">
                </div>
                <div class="form-add-item " id="namaItemAksesoris">
                    <div class="mb-3">
                        <label for="InputItemAksesoris" class="form-label">Nama Item</label>
                        <input type="text" name="aksesoris_nama_item" class="form-control" value="{{$vals['aksesoris_nama_item']}}">
                    </div>
                </div>
                <div class="form-add-item " id="namaItemAksesoris">
                    <div class="mb-3">
                        <label for="InputItemAksesoris" class="form-label">Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" value="{{$vals['harga_jual']}}">
                    </div>
                </div>
                <div class="form-add-item " id="namaItemAksesoris">
                    <div class="mb-3">
                        <label for="InputItemAksesoris" class="form-label">Diskon % </label>
                        <input type="number" name="diskon" class="form-control" value="{{$vals['diskon']}}">
                    </div>
                </div>
                <div class="form-add-item " id="category">
                    <div class="mb-3">
                        <label for="InputIndexLensa" required class="form-label">Category</label>
                        <select name="category_id" class="form-control chosen-select">
                            @foreach ($category as $val)
                                <option {{ $val['id'] == $vals['category_id'] ? 'selected' : '' }} value="{{$val['id'].'-'.$val['nama_kategori']}}">{{$val['nama_kategori']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-add-item " id="brand">
                    <div class="mb-3">
                        <label for="InputIndexBrand" required class="form-label">Brand</label>
                        <select name="brand_id" class="form-control chosen-select">
                            @foreach ($brand as $val)
                                <option {{ $val['id'] == $vals['brand_id'] ? 'selected' : '' }} value="{{$val['id'].'-'.$val['nama_brand']}}">{{$val['nama_brand']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-add-item " id="vendor">
                    <div class="mb-3">
                        <label for="InputVendor" class="form-label">Vendor</label>
                        <select name="vendor_id" class="form-control chosen-select">
                            @foreach ($vendor as $val)
                                <option {{ $val['id'] == $vals['vendor_id'] ? 'selected' : '' }} value="{{$val['id']}}">{{$val['nama_vendor']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-add-item " id="frameSubKategori">
                    <div class="mb-3">
                        <label for="frame_sku_vendor" class="form-label">SKU Vendor</label>
                        <input type="text" name="frame_sku_vendor" class="form-control" value="{{ $vals['frame_sku_vendor'] }}" >
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-add-item " id="colorItem">
                    <div class="mb-3">
                        <label for="InputColor" class="form-label">Warna</label>
                        <select type="number" name="frame_color_id" class="form-control chosen-select">
                            @foreach ($color as $val)
                            <option {{ $val['id'] == $vals['frame_color_id'] ? 'selected' : '' }} value="{{$val['id'].'-'.$val['color_name']}}" name="frame_color_id">
                                {{$val['color_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="frameKategori" style="display: none;"  id="frameSubKategori">
                    <div class="mb-3">
                        <label for="InputFrameSub" class="form-label">Frame SUB Kategori</label>
                        <input type="text" name="frame_sub_kategori" id="frame_sub_kategori" value="{{ $vals['frame_sub_kategori'] }}"  class="form-control"  >
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
                            @foreach ($index as $val)
                                <option {{ $val['id'] == $vals['lensa_index_id'] ? 'selected' : '' }} value="{{$val['id'].'-'.$val['value']}}">{{$val['value']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="lensaKategori" style="display: none;"  id="jenisProdukLensa">
                    <div class="mb-3">
                        <label for="InputBeliLensa" class="form-label">Jenis Produk Lensa</label>
                        <input type="text" name="lensa_jenis_produk" id="lensa_jenis_produk" value="{{ $vals['lensa_jenis_produk'] }}" class="form-control">
                    </div>
                </div>
                <div class="lensaKategori" style="display: none;"  id="jenisLensa">
                    <div class="mb-3">
                        <label for="InputJenisLensa"  class="form-label">Jenis Lensa</label>
                        <select name="lensa_jenis_lensa" id="lensa_jenis_lensa" class="form-control">
                            <option {{ $vals['lensa_jenis_lensa']=="PR" ? 'selected' : '' }} value="PR">PR</option>
                            <option {{ $vals['lensa_jenis_lensa']=="SV" ? 'selected' : '' }} value="SV">SV</option>
                            <option {{ $vals['lensa_jenis_lensa']=="DT" ? 'selected' : '' }} value="DT">DT</option>
                            <option {{ $vals['lensa_jenis_lensa']=="KT" ? 'selected' : '' }} value="KT">KT</option>
                            <option {{ $vals['lensa_jenis_lensa']=="FT" ? 'selected' : '' }} value="FT">FT</option>
                            <option {{ $vals['lensa_jenis_lensa']=="MMLS" ? 'selected' : '' }} value="MMLS">MMLS</option>
                        </select>
                    </div>
                </div>
                <div class="form-add-item addItem ">
                    <div class="mb-3 ">
                        <label for="InputDeskripsi" class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control " value="{{ $vals['deskripsi'] }}">
                    </div>
                </div>
                <div class="mt-5 float-right">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function formChange() {
        value_id="<?php echo $vals['jenis_item']; ?>"
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
    $(document).ready(function() {
        formChange();
        $(".chosen-select").chosen({width: "100%"}); // Contoh mengatur lebar
    });
    $("form#edit_info").submit(function(event){
        $('#btn_submit').hide();		
	    event.preventDefault();
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
                // console.log(result);
                if(result.message=="The data has been successfully updated"){ 
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
            } 
	    });
	  return false;
	});
</script>

