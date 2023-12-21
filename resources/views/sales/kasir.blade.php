@extends('layout')
@section('content')
<div class="d-flex flex-row" style="height: 85vh">
    <div class="d-flex flex-column align-items-center bg-white m-2 shadow p-3" style="width:70%">
        <div style="width: 100%; margin-bottom:5%">
            <span>Scan Barang</span>
            <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                <input type="text"  name="qrcode" autofocus=true class="form-control" />
            </form>
            @if(empty($kas))
                <span><font color="red" >Silahkan Generate Kas Tanggal {{date("d-m-Y")}} Terlebih Dahulu Pada Cabang {{$response_employee_one[0]['nama_branch']}} </font></span>
            @endif
        </div>
        <div style="width: 100%; margin-bottom:5%">
            <hr/>
        </div>
        <div style="max-height: 75%; width:100%">
            <span>Transaksi Penjualan</span>
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
    <div class="m-2 shadow d-flex flex-column justify-content-between" style="width:30%">
        <div>
            <button href="" class="btn btn-primary btn-lg w-100 border-bottom-0 rounded-0" type="button" role="button" aria-pressed="true" data-toggle="modal" data-target="#addMasterSales">
                + New Sales
            </button>
            <div class="d-flex flex-column" style="height:25%;">
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
            <div class="d-flex flex-column align-items-center" style="height:75%;">
                <div class="border-top border-secondary overflow-auto" style="width:98%; min-height:90%;">
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0">Lensa</p>
                        <p class="m-0">Rp 300.000</p>
                    </div>
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0">Frame</p>
                        <p class="m-0">Rp 900.000</p>
                    </div>
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0">Lensa</p>
                        <p class="m-0">Rp 300.000</p>
                    </div>
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0">Frame</p>
                        <p class="m-0">Rp 900.000</p>
                    </div>
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0">Lensa</p>
                        <p class="m-0">Rp 300.000</p>
                    </div>
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0">Frame</p>
                        <p class="m-0">Rp 900.000</p>
                    </div>

                </div>
                <div class="border-top border-secondary" style="width:98%">
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0"><b>Subtotal</b></p>
                        <p class="m-0">Rp 1.200.000</p>
                    </div>
                    <div class="d-flex justify-content-between mx-4 my-2 text-dark">
                        <p class="m-0"><b>Total</b></p>
                        <p class="m-0">Rp 1.200.000</p>
                    </div>
                </div>
                <a href="" class="btn btn-outline-secondary btn-outline-top btn-outline-bottom mx-2" style="width:98%" role="button" aria-pressed="true">
                    Clear Sale
                </a>
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="d-flex flex-row w-100 justify-content-center align-items-between">
                <a href="" class="btn btn-secondary btn-lg w-50 rounded-0" role="button" style="margin:3px" aria-pressed="true">
                    Save Bill
                </a>
                <a href="" class="btn btn-secondary btn-lg w-50 rounded-0" role="button" style="margin:3px" aria-pressed="true">
                    Print Bill
                </a>
            </div>
            <a href="" class="btn btn-primary btn-lg w-95 rounded-0" style="margin-right:3px; margin-left:3px;" type="button" role="button" aria-pressed="true" data-toggle="modal" data-target="#payment">
                Charge Rp 1.200.000
            </a>
            <!-- Nested Modal New Customer-->
            <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="createNewCustomer" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width:70%; max-height:60%">
                    <div class="modal-content">
                        <div class="modal-header d-flex-column">
                            <h5 class="modal-title" id="addCustomerLabel"><b>Payment</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="margin-bottom:23vh; margin:3%;">
                            <div class="d-flex flex-row align-items-center" style="margin-bottom: 2%">
                                <div for="inputCash" class="form-label text-center" style="width:30%"><b>Cash</b></div>
                                <div style="width:70%;">
                                    <input id="inputCash" type="text" class="form-control w-100 rounded" placeholder="Rp." aria-label="Username" aria-describedby="basic-addon1" style="width:70%;">
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center" style="margin-bottom: 2%">
                                <div class="text-center" style="width:30%"><b>E-Wallet</b></div>
                                <div style="width:70%">
                                    <div class="d-flex flex-row flex-wrap justify-content-start">
                                        <button type="button" class="btn btn-outline-secondary" style="margin-right:5vh; margin-bottom:2vh;"><img style="max-width: 20vh;" src="https://drive.google.com/uc?id=1fyMAEV-Qycp8e8CpTIhYzTHVTiRa79yj" alt="OVO"></button>
                                        <button type="button" class="btn btn-outline-secondary" style="margin-right:5vh; margin-bottom:2vh;"><img style="max-width: 20vh;" src="https://drive.google.com/uc?id=1mbdz3InFb94ekbsjAqMMODhuGLB4g67h" alt="GOPAY"></button>
                                        <button type="button" class="btn btn-outline-secondary" style="margin-right:5vh; margin-bottom:2vh;"><img style="max-width: 20vh;" src="https://drive.google.com/uc?id=1qTv2GVJ_methWiIQMHeCJ8UEGCW67IMQ" alt="ShopeePay"></button>
                                        <button type="button" class="btn btn-outline-secondary" style="margin-right:5vh; margin-bottom:2vh;"><img style="max-width: 20vh;" src="https://drive.google.com/uc?id=1fyMAEV-Qycp8e8CpTIhYzTHVTiRa79yj" alt="OVO"></button>
                                        <button type="button" class="btn btn-outline-secondary" style="margin-right:5vh; margin-bottom:2vh;"><img style="max-width: 20vh;" src="https://drive.google.com/uc?id=1mbdz3InFb94ekbsjAqMMODhuGLB4g67h" alt="GOPAY"></button>
                                        <button type="button" class="btn btn-outline-secondary" style="margin-right:5vh; margin-bottom:2vh;"><img style="max-width: 20vh;" src="https://drive.google.com/uc?id=1qTv2GVJ_methWiIQMHeCJ8UEGCW67IMQ" alt="ShopeePay"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center" style="margin-bottom: 2%">
                                <div for="inputCash" class="text-center" style="width:30%"><b>EDC</b></div>
                                <div class="d-flex flex-row flex-wrap justify-content-start" style="width:70%;">
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">BCA</button>
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">Mandiri</button>
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">BRI</button>
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">BNI</button>
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">CIMB Niaga</button>
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">Seabank</button>
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">Permata Bank</button>
                                    <button type="button" class="btn btn-outline-secondary" style="min-width:20vh; margin-right:5vh; margin-bottom:2vh;">Other EDC</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Charge</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function changeText(newText) {
        document.getElementById('targetDiv').innerText = newText;
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
                        html_view+="<tr>"+
                                    "<td>"+offsetN0+"</td>"+
                                    "<td>"+currentItem.nomor_transaksi+"</td>"+
                                    "<td>"+currentItem.tanggal_transaksi+"</td>"+
                                    "<td>"+currentItem.customer_nama_depan+currentItem.customer_nama_belakang+"</td>"+
                                    "<td>"+currentItem.dp+"</td>"+
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
    });
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
                    <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
