<style>
    .chosen-container .chosen-results {
        font-size: 14px; /* Sesuaikan ukuran font */
    }

</style>
<span id="tambah_info"></span>
<div class="modal-body">
    <form id="add_info_adjustnote" class="form-horizontal">
        @csrf
        <!-- @method("POST") -->
        <div class="d-flex flex-column">
            <div class="mb-3">
                <p>Employee name : {{$data['username']}}</p>
                <input type="hidden" value="{{$data['id']}}" name="adjustment_by">
                <input type="hidden" value="{{$sob_detail_id}}" name="stock_opname_branch_detail_id">

            </div>

            <div class="mb-3">
                <label for="adjustment_date" class="form-label">Adjustment Date : </label>
                <input type="datetime" class="form-control" name="adjustment_date" value="{{Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString()}}" readonly>
            </div>

            <div class="mb-3">
                <label class="m-0">Adjusment note :</label>
                <input type="text" class="form-control" name="adjustment_followup_note">
            </div>
        </div>
        <div class="mt-3 float-right">
            <button type="submit" class="btn btn-primary px-4" data-dismiss="">Add</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $("form#add_info_adjustnote").submit(function(event){
        $('btn_submit').hide();
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(formData);
	    $.ajax({
            url   : "{{ url('/stock-opname-branch/detail/') }}/ <?php echo $sob_id; ?> /init-adjustment",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                // console.log(result);
                if(result.message=="Success"){
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
