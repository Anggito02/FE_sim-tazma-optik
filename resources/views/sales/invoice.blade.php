<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TAZMA OPTIK</title>

    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery-3.6.4.min.js')}}"></script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.fixedColumns.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendor/select2/select2.js')}}"></script>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/support-index.css')}}" rel="stylesheet">

    <!-- datatables bootstrap 4 -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- Menambahkan CSS Chosen -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <!-- Menambahkan JavaScript Chosen -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <style>
        @media print {
            .row, .col-md-2 {
                display: flex;
                flex-wrap: nowrap;
                width: 100%;
            }
            .col-md-2 {
                flex: 0 0 16.66666667%; /* Ini sama dengan 1/6 (untuk col-md-2) */
                max-width: 16.66666667%;
            }
        }
    </style>


</head>
<body>
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h2><b>(Logos) OPTIK TAZMA</b></h2>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <center>
                    <h6><b><i class="fa fa-shopping-cart" aria-hidden="true"></i> tazma_shop</b></h6>
                </center>
            </div>
            <div class="col-md-3">
                <center>
                    <h6><b><i class="fa fa-envelope" aria-hidden="true"></i> info@tazma_shop.com</b></h6>
                </center>
            </div>
            <div class="col-md-3">
                <center>
                    <h6><b><i class="fa fa-phone" aria-hidden="true"></i> (022) 1234567 / +62936516412853</b></h6>
                </center>
            </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-md-6 black-text bold-text">
                <span style="color:red;">Optik Tazma - {{$response_sales['data']['nama_branch']}}</span>
                <table>
                    <tr style="white-space: nowrap;">
                        <td>Transcation No</td>
                        <td>:</td>
                        <td>{{$response_sales['data']['nomor_transaksi']}}</td>
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Customer Name</td>
                        <td>:</td>
                        <td>{{$response_sales['data']['customer_nama_depan']}} {{$response_sales['data']['customer_nama_belakang']}}</td>
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Address</td>
                        <td>:</td>
                        <td>{{$response_sales['data']['customer_alamat']}}</td>
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{$response_sales['data']['customer_nomor_telepon']}}</td>
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$response_sales['data']['customer_email']}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3 black-text bold-text">
                &nbsp;
            </div>
            <div class="col-md-3 black-text bold-text d-flex ">
                <br/>
                <table>
                    <tr style="white-space: nowrap;">
                        <td>Payment Method</td>
                        <td>:</td>
                        @if ($response_sales['data']['sistem_pembayaran'] != "null")
                            <td>{{$response_sales['data']['sistem_pembayaran']}}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Payment Status</td>
                        <td>:</td>
                        @if ($response_sales['data']['status'] != "null")
                            <td>{{$response_sales['data']['status']}}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Reference No</td>
                        <td>:</td>
                        @if($response_sales['data']['nomor_referensi'] != "null")
                            <td>{{$response_sales['data']['nomor_referensi']}}</td>
                        @else  
                            <td></td>
                        @endif    
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Term Payment</td>
                        <td>:</td>
                        @if ($response_sales['data']['dp'] != "null")
                            <td>{{$response_sales['data']['dp']}}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                    <tr style="white-space: nowrap;">
                        <td>Kasir</td>
                        <td>:</td>
                        @if ($response_sales['data']['employee_name'] != "null")
                            <td>{{$response_sales['data']['employee_name']}}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <table class="table" id="data_sales_master" width="100%" cellspacing="0">
                <thead style="position: sticky; top: 0; background-color: #fff;">
                    <tr>
                        <th>No</th>
                        <th>Kode Item</th>
                        <th>Items Name</th>
                        <th class="text-right" >Price</th>
                        <th align="center" >Discount %</th>
                        <th class="text-right" >After Discount</th>
                        <th align="center" >QTY</th>
                        <th class="text-right" >Amount</th>
                    </tr>
                </thead>
                <tbody id="bodySalesMaster">
                    <?php $total=0; ?>
                    @foreach($response_sales_detail['data'] as $key => $value)
                        <tr>
                            <td>{{$key + 1 }}</td> <!-- Menampilkan nomor urut -->
                            <td>{{$value['kode_item']}}</td> <!-- Menampilkan nomor urut -->
                            <td>{{$value['kode_item']}}</td> <!-- Menampilkan nomor urut -->
                            <td align="right" >{{number_format($value['harga']/(100-($value['diskon']))*100)}}</td> <!-- Menampilkan nomor urut -->
                            <td align="center" >{{$value['diskon']}}</td> <!-- Menampilkan nomor urut -->
                            <td align="right" >{{number_format($value['harga'])}}</td> <!-- Menampilkan nomor urut -->
                            <td align="center" >{{number_format($value['qty'])}}</td> <!-- Menampilkan nomor urut -->
                            <td align="right" >{{number_format($value['qty']*$value['harga'])}}</td> <!-- Menampilkan nomor urut -->
                            <?php $total+=$value['qty']*$value['harga']; ?>
                        </tr>
                    @endforeach
                        <tr>
                            <th class="text-right" colspan="7">Grand Total</th>
                            <th class="text-right" >{{number_format($total)}}</th>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>