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
        <input type="hidden" readonly=true name="id" class="form-control" value="{{$stock_opname_detail['id']}}">
        <input type="hidden" readonly=true name="stock_opname_id" class="form-control" value="{{$stock_opname_detail['stock_opname_id']}}">
        <div class="row">
            <div class="col">
                <div class="form-add-item">
                    <div class="mb-3">
                        <label for="InputSoStart" class="form-label">SO Start</label>
                        <input type="datetime-local" name="so_start" class="form-control" value="{{$stock_opname_detail['so_start']}}">
                    </div>
                </div>
                <div class="form-add-item ">
                    <div class="mb-3">
                        <label for="InputSoEnd" class="form-label">SO End</label>
                        <input type="datetime-local" name="so_end" class="form-control" value="{{$stock_opname_detail['so_end']}}">
                    </div>
                </div>
                <div class="form-add-item ">
                    <div class="mb-3">
                        <label for="InputActualQty" class="form-label">Actual Qty</label>
                        <input type="number" name="actual_qty" class="form-control" value="{{$stock_opname_detail['actual_qty']}}">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-add-item ">
                    <div class="mb-3">
                        <label for="InputItem" class="form-label">Item </label>
                        <select name="item_id" class="form-control chosen-select">
                            @foreach ($item as $val)
                                <option {{ $val['id'] == $stock_opname_detail['item_id'] ? 'selected' : '' }} value="{{$val['id']}}">{{$val['kode_item']}}-{{$val['jenis_item']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-add-item ">
                    <div class="mb-3">
                        <label for="InputOpenBy" class="form-label">Open By</label>
                        <select name="open_by" class="form-control chosen-select">
                            @foreach ($employee as $emp)
                                <option {{ $emp['id'] == $stock_opname_detail['open_by'] ? 'selected' : '' }} value="{{$emp['id']}}">{{ $emp['employee_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-add-item ">
                    <div class="mb-3">
                        <label for="InputCloseBy" class="form-label">Close By</label>
                        <select name="close_by" class="form-control chosen-select">
                            @foreach ($employee as $emp)
                                <option {{ $emp['id'] == $stock_opname_detail['close_by'] ? 'selected' : '' }} value="{{$emp['id']}}">{{ $emp['employee_name'] }}</option>
                            @endforeach
                        </select>
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
            url   	: "{{ url('/stock-opname/detail/edit') }}",
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

