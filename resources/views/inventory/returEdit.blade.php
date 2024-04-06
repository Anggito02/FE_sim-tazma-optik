<style>
    .chosen-container .chosen-results {
        font-size: 14px; /* Sesuaikan ukuran font */
    }

</style>
<span id="tambah_info"></span> 
<div class="modal-body">
    <form id="edit_info" class="form-horizontal">
        @csrf
        <!-- @method("PUT") -->
        <div class="row">
            <div class="col">
                <input type="hidden" name="id" value="{{$data['id']}}">
                <div class="mb-3">
                    <label class="form-label">Tanggal Pengiriman</label>
                    <input type="datetime-local" value="{{Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString()}}" name="tanggal_pengiriman" class="form-control" readonly>
                    {{-- <input type="datetime-local" name="tanggal_pengiriman" class="form-control" value="{{ $data['tanggal_pengiriman']}}"> --}}
                    
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Cabang</label>
                    <select class="form-control" name="branch_id">
                        <option value="{{$data['branch_id']}}" selected>{{$data['nama_branch']}}</option>
                        @foreach ($branch as $branchVal)
                        <option value="{{$branchVal['id']}}">{{$branchVal['nama_branch']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col">
                
                <div class="mb-3">
                    <label class="form-label">Checked By</label>
                    <select class="form-control" name="checked_by">
                        <option value="{{$data['checked_by']}}" selected>{{$data['checked_by_name']}}</option>
                        @foreach ($employee as $employeeVal)
                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Approved By</label>
                    <select class="form-control" name="approved_by">
                        <option value="{{$data['approved_by']}}" selected>{{$data['approved_by_name']}}</option>
                        @foreach ($employee as $employeeVal)
                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Delivered By</label>
                    <select class="form-control" name="delivered_by">
                        <option value="{{$data['delivered_by']}}" selected>{{$data['delivered_by_name']}}</option>
                        @foreach ($employee as $employeeVal)
                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Received By</label>
                    <select class="form-control" name="received_by">
                        <option value="{{$data['received_by']}}" selected>{{$data['received_by_name']}}</option>
                        @foreach ($employee as $employeeVal)
                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mt-5 float-right">
                    <button type="submit"
                        class="btn-sm btn-success bold-text mb-3">
                        Update
                    </button>
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
            url   	: "{{ url('/retur/edit') }}",
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
                    },1000);
                }
            } 
	    });
	  return false;
	});
</script>

