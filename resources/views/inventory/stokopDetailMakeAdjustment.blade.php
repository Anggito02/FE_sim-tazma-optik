<style>
    .chosen-container .chosen-results {
        font-size: 14px; /* Sesuaikan ukuran font */
    }

</style>
<span id="tambah_info"></span>
<div class="modal-body">
    <form id="add_info_make_adjustment" class="form-horizontal">
        @csrf
        <!-- @method("POST") -->
        <input type="hidden" value="{{ $sod['id'] }}" name="stock_opname_detail_id">
        <div class="d-flex flex-row">
            <p>Adjust Type : </p>
            <p style="margin-left:1%;" id="set_adjust_type">{{ $sod['adjustment_type'] }}</p>
            <input type="hidden" value="{{$sod['adjustment_type']}}" name="adjustment_type">
        </div>
        <div class="d-flex flex-row">
            <p>Adjustment by : </p>
            <p style="margin-left:1%;" id="set_adjust_by">{{ $data['username'] }}</p>
            <input type="hidden" value="{{$data['id']}}" name="adjustment_by">
        </div>
        <div class="d-flex flex-row">
            <p>Kode Item - jenis Item : </p>
            <p style="margin-left:1%;" id="set_item">{{ $sod['kode_item'] }} - {{ $sod['jenis_item'] }}</p>
            <input type="hidden" value="{{$sod['item_id']}}" name="item_id">
        </div>
        <div class="d-flex flex-row">
            <p>Adjustment QTY : </p>
            <p style="margin-left:1%;" id="set_adjust_qty">{{ $sod['diff_qty'] }}</p>
            <input type="hidden" value="{{$sod['diff_qty']}}" name="in_out_qty">
        </div>
        <div class="float-right">
            <button type="button right" class="btn btn-primary px-4" data-dismiss="">Add</button>
        </div>
    </form>
</div>

<script>
    $("form#add_info_make_adjustment").submit(function(event){
        $('btn_submit').hide();
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(formData);
        $.ajax({
            url   : "{{ url('/stock-opname/detail/') }}/ <?php echo $so_id; ?> /make-adjustment",
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
                        $('#tambah_info').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
                        setTimeout(function(){
                        $('#tambah_info').hide();
                         location.reload();
                        },1000);
                }else{
                    $('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
                    setTimeout(function(){
                        $('#tambah_info').hide();
                        location.reload();
                    },1000)
                }
                $('#btn_submit').show();
            }
        });
        return false;
    });
</script>