@extends('layout')
@section('content')
<div class="d-flex flex-row" style="height: 85vh">
    <div class="d-flex flex-column align-items-center bg-white m-2 shadow p-3" style="width:70%">
        <div style="width: 100%; margin-bottom:5%">
            <form id="add_info" class="form-horizontal" onsubmit="submitForm(event)">
                <input type="text" {{ empty($kas) ? 'disabled' : '' }} name="qrcode" autofocus=true class="form-control" />
            </form>
            @if(empty($kas))
                <span><font color="red" >Silahkan Generate Kas Tanggal {{date("d-m-Y")}} Terlebih Dahulu Pada Cabang {{$response_employee_one[0]['nama_branch']}} </font></span>
            @endif
        </div>
        <hr/>
        <div style="width: 100%; margin-bottom:5%">
            <button type="button" class="btn btn-primary" style="width: 49%;">Open Kas</button>
            <span class="pull-right">Amount Kas : Rp.50.000.000.000.000</span>
        </div>
        <div class="table-responsive" style="max-height: 75%; width:100%">
            <table class="table w-100" style="overflow-x: hidden;">
                <thead style="position: sticky; top: 0; background-color: #fff;">
                    <tr>
                        <th scope="col" style="width: 20%;">Nama Produk</th>
                        <th scope="col" style="width: 20%;">Harga</th>
                        <th scope="col" style="width: 20%;">Kuantitas</th>
                        <th scope="col" style="width: 20%;">Subtotal</th>
                        <th scope="col" style="width: 10%;">Tambah</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0;$i<=100;$i++)
                    <tr>
                        <td>Lensa</td>
                        <td>Rp. 300.000</td>
                        <td><input type="number" id="quantity" name="quantity" min="0" value="0" style="max-width:50%;"></td>
                        <td>Rp. 900.000</td>
                        <td><button type="button" class="btn btn-primary">+</button></td>
                    </tr>
                    <tr>
                        <td>Frame</td>
                        <td>Rp. 900.000</td>
                        <td><input type="number" id="quantity" name="quantity" min="0" value="0" style="max-width:50%;"></td>
                        <td>Rp. 900.000</td>
                        <td><button type="button" class="btn btn-primary">+</button></td>
                    </tr>
                   @endfor
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-row justify-content-between w-100" style="margin-top: 5vh">
            <button type="button" class="btn btn-primary" style="width: 49%;">Primary</button>
            <button type="button" class="btn btn-primary" style="width: 49%;">Primary</button>
        </div>
        <hr/>
        <div class="table-responsive" style="max-height: 25%; width:100%">
            <table class="table w-100" style="overflow-x: hidden;">
                <thead style="position: sticky; top: 0; background-color: #fff;">
                    <tr>
                        <th scope="col" style="width: 20%;">Coa</th>
                        <th scope="col" style="width: 20%;">Jenis Kas</th>
                        <th scope="col" style="width: 20%;">Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0;$i<=100;$i++)
                    <tr>
                        <td>COA001</td>
                        <td><font color="green">Masukan</font></td>
                        <td><font color="green">+Rp. 300.000</font></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>COA002</td>
                        <td>Keluaran</td>
                        <td>-Rp. 300.000</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="m-2 shadow d-flex flex-column justify-content-between" style="width:30%">
        <div>
            <button href="" class="btn btn-primary btn-lg w-100 border-bottom-0 rounded-0" type="button" role="button" aria-pressed="true" data-toggle="modal" data-target="#addCustomer">
                + Add Customer
            </button>
            <!-- Modal New Customer-->
            <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="addCustomerLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width:70%; max-height:60%">
                    <div class="modal-content">
                        <div class="modal-header d-flex-column">
                            <h5 class="modal-title" id="addCustomerLabel"><b>221 Customers</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search by Name, Phone, or Email" aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-right" id="basic-addon1">@</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" style="width: 100%; margin-bottom: 3%;" type="button" role="button" aria-pressed="true" data-toggle="modal" data-target="#createNewCustomer">+ Create New Customer</button>
                            <div class="table-responsive" style="max-height: 40vh; width:100%">
                                <table class="table">
                                    <p class="m-0"><b>Recently Added</b></p>
                                    <thead>
                                        <tr style="position: sticky; top: 0; background-color: #fff;">
                                            <th scope="col" style="width: 20%;">Name</th>
                                            <th scope="col" style="width: 20%;">Phone</th>
                                            <th scope="col" style="width: 20%;">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody class="overflow-auto">
                                        <a href="">
                                            <tr>
                                                <td>Anandito</td>
                                                <td>08124123012</td>
                                                <td>anandito@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Niko</td>
                                                <td>08139283123</td>
                                                <td>niko@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Anandito</td>
                                                <td>08124123012</td>
                                                <td>anandito@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Niko</td>
                                                <td>08139283123</td>
                                                <td>niko@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Anandito</td>
                                                <td>08124123012</td>
                                                <td>anandito@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Niko</td>
                                                <td>08139283123</td>
                                                <td>niko@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Anandito</td>
                                                <td>08124123012</td>
                                                <td>anandito@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Niko</td>
                                                <td>08139283123</td>
                                                <td>niko@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Anandito</td>
                                                <td>08124123012</td>
                                                <td>anandito@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Niko</td>
                                                <td>08139283123</td>
                                                <td>niko@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Anandito</td>
                                                <td>08124123012</td>
                                                <td>anandito@gmail.com</td>
                                            </tr>
                                        </a>
                                        <a href="">
                                            <tr>
                                                <td>Niko</td>
                                                <td>08139283123</td>
                                                <td>niko@gmail.com</td>
                                            </tr>
                                        </a>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Nested Modal New Customer-->
            <div class="modal fade" id="createNewCustomer" tabindex="-1" role="dialog" aria-labelledby="createNewCustomer" aria-hidden="true">
                <div class="modal-dialog" role="document" style="max-width:70%; max-height:60%">
                    <div class="modal-content">
                        <div class="modal-header d-flex-column">
                            <h5 class="modal-title" id="addCustomerLabel"><b>New Customer</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="margin-bottom:23vh">
                            <div class="input-group mb-3 d-flex flex-column">
                                <label for="inputNama" class="form-label"><b>Name</b></label>
                                <input id="inputNama" type="text" class="form-control w-100 rounded" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3 d-flex flex-column">
                                <label for="inputTelp" class="form-label"><b>Phone</b>  (Required)</label>
                                <input id="inputTelp" type="text" class="form-control w-100 rounded" placeholder="🇮🇩 +62" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3 d-flex flex-column">
                                <label for="inputEmail" class="form-label"><b>Email</b></label>
                                <input id="inputEmail" type="text" class="form-control w-100 rounded" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center" style="height:60%;">
                {{-- <li class="nav-item dropdown" style="list-style: none; min-width:100%">
                    <a class="btn text-dark d-flex flex-row align-items-center justify-content-center nav-link dropdown-toggle" data-toggle="collapse" href="#dropdownOptions" aria-controls="dropdownOptions">
                        <b id="targetDiv">Take Away</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated--grow-in" id="dropdownOptions">
                        <p onclick="changeText('Take Away')" class="p-2 m-0">Take Away</p>
                        <p onclick="changeText('Dine In')" class="p-2 m-0">Dine In</p>
                    </div>
                </li> --}}
                <div class="border-top border-secondary overflow-auto" style="width:98%; min-height:60%;">
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
</script>
@endsection
