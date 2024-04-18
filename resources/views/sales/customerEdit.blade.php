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
        <input type="hidden" name="id" class="form-control" value="{{$vals['id']}}">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="namaDepan" class="form-label">Nama Depan</label>
                    <input type="text" name="nama_depan" class="form-control" value="{{$vals['nama_depan']}}">
                </div>
                <div class="mb-3">
                    <label for="namaBelakang" class="form-label">Nama Belakang</label>
                    <input type="text" name="nama_belakang" class="form-control" value="{{$vals['nama_belakang']}}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$vals['email']}}">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="nomorHp" class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" value="{{$vals['nomor_telepon']}}">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{$vals['alamat']}}">
                </div>
                <div class="mt-5 float-right">
                    <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Update</button>
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
        $('#btn_submit').hide();		
	    event.preventDefault();
        var formData = new FormData($(this)[0]);
	    console.log(formData);
        $.ajax({ 
            url   	: "{{ url('/customer/edit') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                // console.log(result);
                if(result.status=="success"){ 
                        $('#tambah_info').html(' <div class="alert alert-success alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
                        setTimeout(function(){  
                        $('#tambah_info').hide(); 
                        location.reload();
                        },1000);
                }else{
                    $('#tambah_info').html(' <div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show(); 
                    
                }
            } 
	    });
	  return false;
	});
</script>

