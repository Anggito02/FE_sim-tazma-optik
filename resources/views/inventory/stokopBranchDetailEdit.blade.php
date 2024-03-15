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
        <input type="hidden" value="{{$sob_detail_id}}" name="sob_detail_id">
        <input type="hidden" value="{{$branch_id}}" name="branch_id">
        <input type="hidden" value="{{$stock_opname_branch_detail['so_start']}}" name="so_start">
        <input type="hidden" value="{{$stock_opname_branch_detail['so_end']}}" name="so_end">
        <div class="d-flex flex-column">
            <div class="mb-3">
                <label for="inputItem" class="form-label">Item</label>
                <select name="item_id" id="inputItem" class="form-control chosen-select">
                    <option value="" disabled>Choose</option>
                    @foreach ($items as $item)
                        <option value="{{$item['id']}}" {{$item['id'] == $stock_opname_branch_detail['item_id'] ? 'selected' : ''}} selected>{{$item['kode_item']}} - {{$item['jenis_item']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="inputQuantity" class="form-label">Actual Quantity</label>
                <input type="text" name="actual_qty" value="{{$stock_opname_branch_detail['actual_qty']}}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="inputOpenBy" class="form-label">Open By</label>
                <input type="hidden" name="open_by" value="{{$stock_opname_branch_detail['open_by']}}">
                <input type="text" value="{{$stock_opname_branch_detail['open_by_name']}}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="inputCloseBy" class="form-label">Close By</label>
                <input type="hidden" name="close_by" value="{{$stock_opname_branch_detail['close_by']}}">
                <input type="text" value="{{$stock_opname_branch_detail['close_by_name']}}" class="form-control" readonly>
            </div>
        </div>
        <div class="mt-3 float-right">
            <button type="submit" class="btn btn-primary px-4" data-dismiss="">Edit</button>
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
            url   	: "{{ url('/stock-opname-branch/detail/edit') }}",
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

