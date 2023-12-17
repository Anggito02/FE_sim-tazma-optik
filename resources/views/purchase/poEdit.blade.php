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
            <div class="col">
                <input type="hidden" name="id" value="{{$vals['id']}}">
                <input type="hidden" name="status_penerimaan" value="{{$vals['status_penerimaan']}}">

                <div class="mb-3">
                    <label for="UpdateVendor" class="form-label">Vendor</label>
                    <select name="vendor_id" class="form-control chosen-select">
                        @foreach ($vendor as $valvendor)
                            <option {{ $valvendor['id'] == $vals['vendor_id'] ? 'selected' : '' }} value="{{$valvendor['id']}}" name="vendor_id">{{$valvendor['nama_vendor']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status PO</label>
                    <select type="text" name="status_po" class="form-control">
                        <option value="@if ($vals['status_po'] === true) OPEN @elseif ($vals['status_po'] === false) CLOSED @endif" selected hidden >@if ($vals['status_po'] === true) OPEN @elseif ($vals['status_po'] === false) CLOSED @endif</option>
                        <option value=true>OPEN</option>
                        <option value=false>CLOSED</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Checked By</label>
                    <select type="text" name="checked_by" class="form-control chosen-select" >
                        @foreach ($employee as $valemployee)
                            <option {{ $valemployee['id'] == $vals['checked_by_id'] ? 'selected' : '' }} value="{{$valemployee['id']}}" name="checked_by">{{$valemployee['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="col">

                <div class="mb-3">
                    <label class="form-label">Status Pembayaran</label>
                    <select name="status_pembayaran" class="form-control">
                        <option value="@if ($vals['status_pembayaran'] === true) Sudah Dibayar @elseif ($vals['status_pembayaran'] === false) Belum Dibayar @endif" selected hidden >@if ($vals['status_pembayaran'] === true) Sudah Dibayar @elseif ($vals['status_pembayaran'] === false) Belum Dibayar @endif</option>
                        <option value=true>Sudah Dibayar</option>
                        <option value=false>Belum Dibayar</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Made By</label>
                    <select type="text" name="made_by" class="form-control chosen-select">
                        @foreach ($employee as $valemployee)
                            <option {{ $valemployee['id'] == $vals['made_by_id'] ? 'selected' : '' }} value="{{$valemployee['id']}}" name="made_by"> {{$valemployee['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Approved By</label>
                    <select type="text" name="approved_by" class="form-control chosen-select">
                        @foreach ($employee as $valemployee)
                            <option {{ $valemployee['id'] == $vals['approved_by_id'] ? 'selected' : '' }} value="{{$valemployee['id']}}" name="approved_by">{{$valemployee['employee_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-5 float-right">
                    <button type="button"
                        class="btn-sm btn-success bold-text mb-3"
                        data-toggle="modal"
                        data-target="#exampleModalCenterConfirm{{$vals['id']}}">
                        Update
                    </button>
                    <div class="modal fade"
                        id="exampleModalCenterConfirm{{$vals['id']}}"
                        tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="exampleModalLongTitle">Are You
                                        Sure?</h5>
                                    <button type="button" class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                        <span
                                            aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Once you change Status PO to "CLOSED" it cannot be
                                    undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="submit"
                                        class="btn btn-primary">Yes</button>
                                    <button type="button"
                                        class="btn btn-secondary"
                                        data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
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
            url   	: "{{ url('/PO/edit') }}",
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
                        },3500);
                }else{
                    $('#tambah_info').html(' <div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show(); 
                    setTimeout(function(){
                        $('#tambah_info').hide(); 
                        location.reload();
                    },3000)
                }
            } 
	    });
	  return false;
	});
</script>

