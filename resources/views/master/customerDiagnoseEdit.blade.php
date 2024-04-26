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
        <input type="hidden" readonly=true name="customer_diagnose_id" class="form-control" value="{{$vals['id']}}">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="InputCustomer" class="form-label">Customer</label>
                    <select name="customer_id" id="" class="form-control chosen-select">
                        <option value="" hidden disabled>-- Pilih Customer --</option>
                        @foreach ($customer as $val)
                            <option {{ $val['id'] == $vals['customer_id'] ? 'selected' : '' }} value="{{$val['id']}}">{{$val['nama_depan'] . ' ' . $val['nama_belakang']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="InputCabang" class="form-label">Cabang</label>
                    <select name="branch_check_location_id" id="" class="form-control chosen-select">
                        <option value="" hidden disabled>-- Pilih Cabang --</option>
                        @foreach ($branch as $val)
                            <option {{ $val['id'] == $vals['branch_check_location_id'] ? 'selected' : '' }} value="{{$val['id']}}">{{$val['kode_branch'] . ' - ' . $val['nama_branch']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Keluhan</label>
                    <input type="text" name="keluhan" class="form-control" value="{{$vals['keluhan']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Visus Tanpa Koreksi R</label>
                    <input type="text" name="visus_tanpa_koreksi_R" class="form-control" value="{{$vals['visus_tanpa_koreksi_R']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Visus Tanpa Koreksi L</label>
                    <input type="text" name="visus_tanpa_koreksi_L" class="form-control" value="{{$vals['visus_tanpa_koreksi_L']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Oculus Dextra Sph R</label>
                    <input type="text" name="oculus_dextra_sph_R" class="form-control" value="{{$vals['oculus_dextra_sph_R']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Oculus Dextra Cyl R</label>
                    <input type="text" name="oculus_dextra_cyl_R" class="form-control" value="{{$vals['oculus_dextra_cyl_R']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Axis R</label>
                    <input type="text" name="axis_R" class="form-control" value="{{$vals['axis_R']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Oculus Dextra Add R</label>
                    <input type="text" name="oculus_dextra_add_R" class="form-control" value="{{$vals['oculus_dextra_add_R']}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Oculus Dextra Visus R</label>
                    <input type="text" name="oculus_dextra_visus_R" class="form-control" value="{{$vals['oculus_dextra_visus_R']}}">
                </div>

            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Oculus Sinistra Sph L</label>
                    <input type="text" name="oculus_sinistra_sph_L" class="form-control" value="{{$vals['oculus_sinistra_sph_L']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Oculus Sinistra Cyl L</label>
                    <input type="text" name="oculus_sinistra_cyl_L" class="form-control" value="{{$vals['oculus_sinistra_cyl_L']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Axis L</label>
                    <input type="text" name="axis_L" class="form-control" value="{{$vals['axis_L']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Oculus Sinistra Add L</label>
                    <input type="text" name="oculus_sinistra_add_L" class="form-control" value="{{$vals['oculus_sinistra_add_L']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Oculus Sinistra Visus L</label>
                    <input type="text" name="oculus_sinistra_visus_L" class="form-control" value="{{$vals['oculus_sinistra_visus_L']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">PD</label>
                    <input type="text" name="PD" class="form-control" value="{{$vals['PD']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Diagnosa</label>
                    <input type="text" name="diagnosa" class="form-control" value="{{$vals['diagnosa']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Catatan</label>
                    <input type="text" name="catatan" class="form-control" value="{{$vals['catatan']}}">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Diagnosed By</label>
                    <input type="text" readonly name="diagnosed_by" class="form-control" value="{{ $vals['diagnosed_by_nama']}}">
                </div>
                <div class="mt-3 float-right">
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
            url   	: "{{ url('/customer-diagnose/edit') }}",
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
                }
            } 
	    });
	  return false;
	});
</script>

