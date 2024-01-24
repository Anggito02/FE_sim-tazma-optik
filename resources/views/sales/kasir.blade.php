@extends('layout')
@section('content')
<div class="d-flex flex-row" style="height: 85vh">
    <div class="d-flex flex-column align-items-center bg-white m-2 shadow p-3" style="width:60%">
        <div style="width: 100%; margin-bottom:5%">
            <span>Scan Barang</span>
            <span id="tambah_info_scan"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>
            <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                @csrf
                <input type="text"  name="qrcode" autofocus=true class="form-control" <?php if(isset($response_sales['data'])){ echo ""; }else{echo "disabled"; } ?> />
                @if(isset($response_sales['data']))
                <input type="hidden" name="sales_master_id" value="{{$response_sales['data']['id']}}" >
                <input type="hidden" name="branch_id" value="{{$response_sales['data']['branch_id']}}" >
                @endif
            </form>
            @if(empty($kas))
                <span><font color="red" >Silahkan Generate Kas Tanggal {{date("d-m-Y")}} Terlebih Dahulu Pada Cabang {{$response_employee_one[0]['nama_branch']}} </font></span>
            @endif
        </div>
        <div style="width: 100%; margin-bottom:5%">
            <span id="tambah_info_sales_detail"></span>
            <hr/>
        </div>
        <div style="max-height: 75%; width:100%">
            <div class="black-text bold-text">
                <span>Transaksi Penjualan</span>
            </div>
            <form id="find_sales_master" class="form-horizontal" onsubmit="submitFormMasterSales(event)">
                @csrf
                    <input type="text" class="form-control" name="nomor_transaksi" id="nomor_transaksi" placeholder="Search Sales By Transaction Number " aria-label="nomor_transaksi" aria-describedby="basic-addon1"><button type="submit" class="btn btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> Cari </button>
            </form>
        </div>
        <div class="table-responsive" style="max-height: 75%; width:100%">
            <table class="table" id="data_sales_master" width="100%" cellspacing="0">
                <thead style="position: sticky; top: 0; background-color: #fff;">
                    <tr>
                        <th scope="col" style="width: 1%;">No</th>
                        <th scope="col" style="width: 20%;">No Transaksi</th>
                        <th scope="col" style="width: 20%;">Tanggal Transaksi</th>
                        <th scope="col" style="width: 20%;">Nama Customer</th>
                        <th scope="col" style="width: 20%;">DP</th>
                        <th scope="col" style="width: 20%;">Branch</th>
                        <th scope="col" style="width: 20%;">Pilih</th>
                        <!-- <th scope="col" style="width: 10%;">Kas Akhir</th> -->
                    </tr>
                </thead>
                <tbody id="bodySalesMaster">
                </tbody>
            </table>
        </div>
    </div>
    <div class="m-2 shadow d-flex flex-column justify-content-between" style="width:40%">
        <div>
            <button href="" class="btn btn-primary btn-lg w-100 border-bottom-0 rounded-0" type="button" role="button" aria-pressed="true" data-toggle="modal" data-target="#addMasterSales">
                + New Sales
            </button>
            <div class="d-flex flex-column black-text" style="height:30%;">
                @if(isset($response_sales['data']))
                <table>
                    <tr>
                        <td>No Transaction</td>
                        <td>:</td>
                        <td id="id_transaction_number" >{{$response_sales['data']['nomor_transaksi']}}</td>
                    </tr>
                    <tr>
                        <td>Transaction Date</td>
                        <td>:</td>
                        <td id="id_transaction_date" ><?php echo date("d-m-Y H:i:s",strtotime($response_sales['data']['tanggal_transaksi'])); ?></td>
                    </tr>
                    <tr>
                        <td>Term Payment</td>
                        <td>:</td>
                        <td id="id_transaction_payment" ><?php if($response_sales['data']['status']!=null){ echo $response_sales['data']['dp']; }else{ echo "-"; } ?></td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>:</td>
                        <td id="id_transaction_method" ><?php if($response_sales['data']['status']!=null){ echo $response_sales['data']['status']; }else{ echo "-"; } ?></td>
                    </tr>
                    <tr>
                        <td>Verified</td>
                        <td>:</td>
                        <td id="id_transaction_verified" ><?php if($response_sales['data']['verified']!=null){ echo "Verified"; }else{ echo "-"; } ?></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td>:</td>
                        <td id="id_transaction_name" >{{$response_sales['data']['customer_nama_depan'].$response_sales['data']['customer_nama_belakang']}}</td>
                    </tr>
                    <tr>
                        <td>Branch</td>
                        <td>:</td>
                        <td id="id_transaction_branch" >{{$response_sales['data']['nama_branch']}}</td>
                    </tr>
                </table>
                @else
                <table>
                    <tr>
                        <td>No Transaction</td>
                        <td>:</td>
                        <td id="id_transaction_number" >-</td>
                    </tr>
                    <tr>
                        <td>Transaction Date</td>
                        <td>:</td>
                        <td id="id_transaction_date" ></td>
                    </tr>
                    <tr>
                        <td>term Payment</td>
                        <td>:</td>
                        <td id="id_transaction_payment" ></td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>:</td>
                        <td id="id_transaction_method" ></td>
                    </tr>
                    <tr>
                        <td>Verified</td>
                        <td>:</td>
                        <td id="id_transaction_verified" ></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td>:</td>
                        <td id="id_transaction_name" ></td>
                    </tr>
                    <tr>
                        <td>Branch</td>
                        <td>:</td>
                        <td id="id_transaction_branch" ></td>
                    </tr>
                </table>
                @endif
            </div>
            <br/>
            <br/>
            <div class="d-flex flex-column align-items-center" style="height:70%; background-color:white; ">
                <div class="border-top border-secondary overflow-auto" style="width:98%; min-height:75%; background-color:white;">
                    <table class="table">
                        <thead>
                            <th>Item Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Discount</th>
                            <th class="text-right">After Discount</th>
                            <th class="text-right">QTY</th>
                            <th class="text-right">Amount</th>
                            <th class='forDelete text-right' >Void</th>
                        </thead>
                        <tbody  id="data_barang">

                        </tbody>
                    </table>
                </div>
                <br/>
                <br/>
                <div class="border-top border-secondary" style="width:98%">
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0"><b>Total</b></p>
                        <p class="m-0" id="subtotal_item">Rp. Loading ...</p>
                    </div>
                </div>
                @if(isset($response_sales['data']))
                <a href="#" onclick="hideElementsByClass('forDelete','show');" class="btn btn-outline-secondary btn-outline-top btn-outline-bottom mx-2 <?php if($response_sales['data']['verified']=='true' || $response_sales['data']['dp'] >0){ echo 'disabled'; } ?>" style="width:98%" role="button" aria-pressed="true">
                    Clear Sale
                </a>
                @endif
            </div>
        </div>
        <div class="d-flex flex-column">
            @if(isset($response_sales['data']))
                <div class="d-flex flex-row w-100 justify-content-center align-items-between">
                    <a href="" class="btn btn-secondary btn-lg w-50 rounded-0 <?php if($response_sales['data']['verified']=='true' || $response_sales['data']['dp'] >0 ){ echo 'disabled'; } ?>" role="button" style="margin:3px" aria-pressed="true" data-toggle="modal" data-target="#payment">
                        Save Bill
                    </a>
                    <form method="post" action="/sales/print_invoice" target="_blank" >
                        @csrf
                        @method("POST")
                        <input type="hidden" name="sales_master_id" value="{{$response_sales['data']['id']}}">
                        <button type="submit" class="btn btn-secondary btn-lg w-50 rounded-0 <?php if($response_sales['data']['verified']=='true'){ echo ''; }else{ echo 'disabled'; } ?>" role="button" style="margin:3px" aria-pressed="true" >Print Bill</button>
                    </form>
                    <!-- <a href="{{ url('/sales/print_invoice') }}" target="_blank" class="btn btn-secondary btn-lg w-50 rounded-0 <?php // if($response_sales['data']['verified']=='true'){ echo ''; }else{ echo 'disabled'; } ?>" role="button" style="margin:3px" aria-pressed="true"> -->
                        <!-- Print Bill -->
                    <!-- </a> -->
                </div>
                <a href="javascript:void(0);" onclick="submitVeirfy()" class="btn btn-primary btn-lg w-95 rounded-0  <?php if($response_sales['data']['verified']=='true'){ echo 'disabled'; } ?>" style="margin-right:3px; margin-left:3px;" type="button" id="subtotal_item_button" role="button" aria-pressed="true" >
                    Charge Rp Loading ...
                </a>
            @endif
        </div>
    </div>
</div>
<script>
    function formatNumber(number) {
		if(number!==null && number!=="null"){
			return new Intl.NumberFormat('de-DE').format(parseFloat(number));
		}else{
			return '0';
		}
	}
    function changeText(newText) {
        document.getElementById('targetDiv').innerText = newText;
    }
    function getSalesDetail(setting){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            method: "POST",
            type  : 'ajax',
            url   : "{{ url('/sales/detail') }}",
            data  : { 'limit':setting.limit,'page':(setting.limit*setting.start_page),'_token':csrfToken,'sales_master_id':setting.sales_master_id},
            async : true,
            dataType : 'json',
            error: function (request, error) {
                alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
            },
            success : function(result){
                // console.log(status);
                // var table = $('#data_sales_master').DataTable();
                // offsetN0=0;
                html_view="";
                if(result.status!="error"){
                    let subtotalItem=0;
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
                        subtotalItem=parseFloat(currentItem.qty)*parseFloat(currentItem.harga);

                        html_view+="<tr>"+
                                    "<td>"+currentItem.kode_item+"</td>"+
                                    "<td align='right' >"+formatNumber(parseFloat(currentItem.harga)/(100-parseFloat(currentItem.diskon))*100)+"</td>"+
                                    "<td align='right' >"+formatNumber(currentItem.diskon)+" %</td>"+
                                    "<td align='right' >"+formatNumber(currentItem.harga)+"</td>"+
                                    "<td align='right' >"+formatNumber(currentItem.qty)+"</td>"+
                                    "<td align='right' >"+formatNumber(parseFloat(currentItem.qty)*parseFloat(currentItem.harga))+"</td>"+
                                    "<td align='right' class='forDelete' ><a href='javascript:void(0);' onclick='delete_detail("+currentItem.id+","+currentItem.sales_master_id+")'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                    }
                    $("#data_barang").html(html_view);
                    $("#subtotal_item").html("Rp. "+formatNumber(subtotalItem));
                    document.getElementById('subtotal_item_button').textContent = 'Charge Rp. '+formatNumber(subtotalItem);
                    hideElementsByClass('forDelete','hide');
                    
                }
            }
        });
    }
    function getSalesMasterAll(settings){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                method: "POST",
                type  : 'ajax',
                url   : "{{ url('/sales/findSalesMaster') }}",
                data  : { 'limit':settings.limit,'page':(settings.limit*settings.start_page),'_token':csrfToken,'nomor_transaksi':settings.nomor_transaksi},
                async : true,
                dataType : 'json',
                error: function (request, error) {
	      		  alert("Bad Connection, Cannot Reload the data!!, Please Refersh your browser");
			    },
                success : function(result){
                    var table = $('#data_sales_master').DataTable();
                    offsetN0=0;
                    html_view="";
                    for(let i=0; i<result.data.length; i++){
                        let currentItem = result.data[i];
                        offsetN0++;
                        button_pilih = ' <button type="button" class="btn-sm btn-primary" onclick="confirmDelete(\'' + currentItem.id + '\')"><i class="fa fa-check"></i></button>';
                        customer_nama_depan="-";
                        if(currentItem.customer_nama_depan!='null' && currentItem.customer_nama_depan!=null){
                            customer_nama_depan=currentItem.customer_nama_depan;
                        }
                        customer_nama_belakang="-";
                        if(currentItem.customer_nama_belakang!='null' && currentItem.customer_nama_depan!=null){
                            customer_nama_belakang=currentItem.customer_nama_belakang;
                        }
                        dp="-";
                        if(currentItem.dp!='null' && currentItem.dp!=null){
                            dp=currentItem.dp;
                        }
                        html_view+="<tr>"+
                                    "<td>"+offsetN0+"</td>"+
                                    "<td>"+currentItem.nomor_transaksi+"</td>"+
                                    "<td>"+currentItem.tanggal_transaksi+"</td>"+
                                    "<td>"+customer_nama_depan+customer_nama_belakang+"</td>"+
                                    "<td>"+dp+"</td>"+
                                    "<td>"+currentItem.nama_branch+"</td>"+
                                    "<td>"+button_pilih+"</td>";
                    }
                    $("#bodySalesMaster").html(html_view);
                }

        });
    }
    function submitFormSeacrhCustomer(event){
        event.preventDefault();
        var form = document.getElementById('find_customer');

        var formData = new FormData(form);
        $.ajax({
            url   : "{{ url('/sales/findCustomer') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                if(result.message=="Success get customer"){
                    // $('#tambah_info_find_customer').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.status+' || Nama Customer : '+result.data.nama_depan+'</b></div>').show();
                    document.getElementById("nama_customer").value=result.data.nama_depan+" "+result.data.nama_belakang;
                    document.getElementById("email").value=result.data.email;
                    document.getElementById("gender").value=result.data.gender;
                    document.getElementById("alamat").value=result.data.alamat;
                    document.getElementById("customer_id").value=result.data.id;
                }else{
                    $('#tambah_info_find_customer').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+' || '+result.data+'</b></div>').show();
                }
            }
        });

    }
    function delete_detail(id,sales_master_id){
        $.ajax({
            url   : "{{ url('/sales/delete_detail') }}",
            method: "POST",
            type  : 'ajax',
            data: {"id":id, "sales_master_id":sales_master_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async : true,   
            dataType : 'json',
            success: function (result) {
                location.reload();
		    }
	    });
	    return false;
    }
    function submitVeirfy(){
        $('#tambah_info_scan').show();
        var id=<?php  echo $response_sales['data']['id'] ?> ;
        var branch_id=<?php  echo $response_sales['data']['branch_id'] ?> ;
        $.ajax({
            url   : "{{ url('/sales/verifyMaster') }}",
            method: "POST",
            type  : 'ajax',
            data: {"id":id, "branch_id":branch_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async : true,
            dataType : 'json',
            success: function (result) {
                if(result.message=="Data has been successfully inserted"){
                        $('#tambah_info_scan').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.status+'</b></div>').show();
                        setTimeout(function(){
                            $('#tambah_info_scan').hide();
                        },2500);
                        masterContentDetail();
                }else{
                    $('#tambah_info_scan').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.status+'</b></div>').show();
                    setTimeout(function(){
                        $('#tambah_info_scan').hide();
                    },5000)
                }
		    }
	    });
	    return false;
    }
    function submitFormPayment(event){
        $('#tambah_info_payment').show();
        event.preventDefault();
        var form = document.getElementById('add_data_payment');
        var formData = new FormData(form);
        $.ajax({
            url   : "{{ url('/sales/addPayment') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
            console.log(result);
            if(result.message=="Data has been successfully inserted"){
				  	$('#tambah_info_payment').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.status+'</b></div>').show();
				  	setTimeout(function(){
					 $('#tambah_info_payment').hide();
					},2500);
                    masterContentDetail();
			}else{
				$('#tambah_info_payment').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.status+'</b></div>').show();
				setTimeout(function(){
					$('#tambah_info_payment').hide();
				},5000)
			}
            $('#btn_submit').show();
		    }
	    });
	    return false;
    }
    function submitForm(event){
        $('#tambah_info_scan').show();
        event.preventDefault();
        var form = document.getElementById('add_info');
        var formData = new FormData(form);
        $.ajax({
            url   : "{{ url('/sales/addScanItem') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
            console.log(result);
            if(result.message=="Data has been successfully inserted"){
				  	$('#tambah_info_scan').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				  	setTimeout(function(){
					 $('#tambah_info_scan').hide();
					},2500);
                    masterContentDetail();
			}else{
				$('#tambah_info_scan').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				setTimeout(function(){
					$('#tambah_info_scan').hide();
				},5000)
			}
            $('#btn_submit').show();
		    }
	    });
	    return false;
    }
    function submitFormCustomer(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var form = document.getElementById('add_customer');

        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/sales/addCustomer') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
            if(result.message=="Data has been successfully inserted"){
				  	$('#tambah_info').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				  	setTimeout(function(){
					 $('#tambah_info').hide();
                     location.reload();
					},2500);
			}else{
				$('#tambah_info').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.message+'</b></div>').show();
				setTimeout(function(){
					$('#tambah_info').hide();
                    // location.reload();
				},5000)
			}
            $('#btn_submit').show();
		    }
	    });
	  return false;
    }
    function confirmDelete(sales_master_id){
        window.location.href = "{{ url('/sales/?sales_master_id=') }}"+sales_master_id;
    }
    function submitFormSalesMaster(event){
		$('#btn_submit').hide();
		$('#tambah_info').html('<i class="fa fa-spinner fa-spin"></i>').show();
	    event.preventDefault();
        var form = document.getElementById('add_sales_master');

        var formData = new FormData(form);
	    $.ajax({
            url   : "{{ url('/sales/addSalesMaster') }}",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                console.log(result);
                console.log(result.data.id);
            if(result.status=="success"){
				  	$('#tambah_info_master').html(' <div class="alert alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.status+'</b></div>').show();
				  	setTimeout(function(){
					    $('#tambah_info').hide();
                    //  location.reload();
                        // window.location.href = 'http://yourdomain.com/tujuan?paramKey=paramValue';
                        // sales_master_id=result.data.id;
                        window.location.href = "{{ url('/sales/?sales_master_id=') }}"+result.data.id;
					},2500);
			}else{
				$('#tambah_info_master').html(' <div class="alert alert-warning alert-dismissible fade show" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>'+result.status+'</b></div>').show();
				setTimeout(function(){
					$('#tambah_info').hide();
                    // location.reload();
				},5000)
			}
            $('#btn_submit').show();
		    }
	    });
	  return false;
    }
    function submitFormMasterSales(event){
        event.preventDefault();
        var form = document.getElementById('add_customer');
        var formData = new FormData(form);
        masterContent();
    }
    function masterContent() {
		var settings = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            data_url: "{{ url('/item/loadDataMaster') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 10, //initial page
            htmldata        : '', //initial page
            lastScroll      : 0, //initial page
            nomor_transaksi      : document.getElementById('nomor_transaksi').value, //initial page
        });
        loading  = false;
	    end_record = false;
	    getSalesMasterAll(settings);
	}
    function masterContentDetail() {
        var sales_master_id = <?php echo isset($response_sales['data']) ? $response_sales['data']['id'] : 0; ?>;
		var setting = $.extend({
            loading_gif_url: "{{ asset('img/ajax-loader.gif') }}",
            end_record_text : 'No more records found!', //no more records to load
            start_page      : 0, //initial page
            limit		    : 1000, //initial page
            lastScroll      : 0, //initial page
            sales_master_id :sales_master_id, //initial page
        });
        loading  = false;
	    end_record = false;
	    getSalesDetail(setting);
	}
    $(document).ready(function(){
        var table = $('#data_sales_master').DataTable( {
        //     fixedHeader: {
        //         header: true
        //     },
        //     // scrollY			:$(window).height()-300,
        //     // // scrollY			:true,
        //     // // scrollX			:true,
            scrollCollapse	:false,
            paging			:false,
            searching		:false,
            info 			:false,
            ordering		: false,
        });
        masterContent();
        masterContentDetail();
        $('#tambah_info_scan').hide();
        $('#tambah_info_payment').hide();
    });
    function hideElementsByClass(className,action) {
        var elements = document.querySelectorAll('.' + className);
        var displayStyle = (action === 'show') ? 'table-cell' : 'none'; // 'table-cell' untuk <td>, 'block' untuk elemen lain
        elements.forEach(function(element) {
            element.style.display = displayStyle;
        });
    }
    function togglePaymentMethod(paymentType) {
        var cardNumberInput = document.getElementById('nomor_kartu');
        var referenceNumberInput = document.getElementById('nomor_referensi');
        
        if (paymentType === 'TUNAI') {
            cardNumberInput.style.display = 'none';
            referenceNumberInput.style.display = 'none';
            cardNumberInput.value = 'null';
            referenceNumberInput.value = 'null';
        } else {
            cardNumberInput.value = '';
            referenceNumberInput.value = '';
            cardNumberInput.style.display = 'block';
            referenceNumberInput.style.display = 'block';
        }
    }
    // Inisialisasi pada saat pertama kali load
    // document.addEventListener('DOMContentLoaded', function () {
    //     togglePaymentMethod(document.getElementById('sistem_pembayaran').value);
    // });
</script>
<!-- Modal New Customer-->
<div class="modal fade" id="addMasterSales" tabindex="-1" role="dialog" aria-labelledby="addCustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:70%; max-height:60%">
        <div class="modal-content">
            <div class="modal-header d-flex-column">
                <h5 class="modal-title" id="addCustomerLabel"><b>Transaction</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Customer
                <button type="button" class="btn btn-primary" style="width: 100%; margin-bottom: 3%;" type="button" role="button" aria-pressed="true" data-toggle="modal" data-target="#createNewCustomer">+ Create New Customer</button>
                <span id="tambah_info_find_customer"></span>
                <form id="find_customer" class="form-horizontal" onsubmit="submitFormSeacrhCustomer(event)">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="tel" class="form-control" name="nomor_telepon" placeholder="Search Customer by Phone " aria-label="Username" aria-describedby="basic-addon1"><button type="submit" class="btn btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> Cari </button>
                    </div>
                </form>
                <hr/>
                Sales
                <span id="tambah_info_master"></span>
                <form id="add_sales_master" class="form-horizontal" onsubmit="submitFormSalesMaster(event)">
                    @csrf
                    <input type="hidden" id="branch_id" name="branch_id" value="{{$user_info['data']['branch_id']}}">
                    <input type="hidden" id="employee_id" name="employee_id" value="{{$user_info['data']['id']}}">
                    <input type="hidden" id="ref_sales_id" name="ref_sales_id" value="0">
                    <input type="hidden" id="customer_id" name="customer_id" value="0">
                    <div class="mb-3">
                        <label for="nama_customer" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_customer" aria-describedby="basic-addon1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" aria-describedby="basic-addon1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" aria-describedby="basic-addon1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" aria-describedby="basic-addon1" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
 <!-- Nested Modal New Customer-->
 <div class="modal fade" id="createNewCustomer">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>New Customer</b></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="tambah_info"></span>
                <form id="add_customer" class="form-horizontal" onsubmit="submitFormCustomer(event)">
                    <div class="form-row">
                        <!-- Kolom Kiri -->
                        @csrf
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_depan">Nama Depan</label>
                                <input type="text" class="form-control" id="nama_depan" name="nama_depan" placeholder="Nama Depan">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                            <div class="form-group">
                                <label for="kabkota_id">Kota</label>
                                <select id="kabkota_id" name="kabkota_id" id="ID_KK" width="100%" required  class="form-control chosen-select">
                                    <option value="108">Bandung</option>
                                </select>
                            </div>
                        </div>
                        <!-- Kolom Kanan -->
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_belakang">Nama Belakang</label>
                                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" placeholder="Nama Belakang">
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Telepon</label>
                                <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Telepon">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" id="gender" width="100%" required  class="form-control chosen-select">
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="perempuan" name="jenis_item">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control w-100" ></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-secondary">Close</button> -->
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Nested Modal New Customer-->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-hidden="true">
    <form id="add_data_payment" class="form-horizontal" onsubmit="submitFormPayment(event)">
        <div class="modal-dialog" role="document" style="max-width:70%; max-height:60%">
            <div class="modal-content">
                <div class="modal-header d-flex-column">
                    <h5 class="modal-title" id="addCustomerLabel"><b>Payment</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-bottom:23vh; margin:3%;">
                    @csrf
                    @if(isset($response_sales['data']))
                        <span id="tambah_info_payment">Processs <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>
                        <input type="hidden" name="id" value="{{$response_sales['data']['id']}}" >
                        <input type="hidden" name="ref_sales_id" value="{{$response_sales['data']['ref_sales_id']}}">
                        <input type="hidden" name="branch_id" value="{{$response_sales['data']['branch_id']}}" >
                        <input type="hidden" id="employee_id" name="employee_id" value="{{$user_info['data']['id']}}">
                        <input type="hidden" name="customer_id" value="{{$response_sales['data']['customer_id']}}" >

                        <div class="d-flex flex-row align-items-center" style="margin-bottom: 2%">
                            <div for="inputCash" class="form-label text-center" style="width:30%"><b>Payment Method</b></div>
                            <div style="width:70%;">
                                <select id="sistem_pembayaran" name="sistem_pembayaran" width="100%" required  class="form-control chosen-select" onchange="togglePaymentMethod(this.value)" >
                                    <option value="NON TUNAI">Non Tunai</option>
                                    <option value="TUNAI">Tunai</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="margin-bottom: 2%" id="forCardNumber">
                            <div for="inputCash" class="form-label text-center" style="width:30%"><b>Card Number</b></div>
                            <div style="width:70%;">
                                <input id="nomor_kartu" name="nomor_kartu" type="text" class="form-control w-100 rounded" placeholder="001-234-8491" aria-describedby="basic-addon1" style="width:70%;">
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="margin-bottom: 2%" id="forCardReference">
                            <div for="inputCash"  class="form-label text-center" style="width:30%"><b>Reference Number</b></div>
                            <div style="width:70%;">
                                <input id="nomor_referensi" name="nomor_referensi" type="text" class="form-control w-100 rounded" placeholder="9830136537" aria-describedby="basic-addon1" style="width:70%;">
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="margin-bottom: 2%">
                            <div for="inputCash" class="form-label text-center" style="width:30%"><b>Payment Term(%)</b></div>
                            <div style="width:70%;">
                                <input type="number" id="dp" name="dp" require class="form-control w-100 rounded" placeholder="100" max="100" min="10"  value="100" aria-describedby="basic-addon1" style="width:70%;">
                            </div>
                        </div>
                    @else 
                        <span style="color: red;">No Transaction Number Chosen</span>
                    @endif
                </div>
                <div class="modal-footer">
                    @if(isset($response_sales['data']))
                    <button type="submit" class="btn btn-primary">Charge</button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
