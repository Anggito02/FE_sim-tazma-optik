@extends('layout')
@section('content')
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
                    <td>{{$response_sales['data']['customer_nama_depan']}} {{$response_sales['data']['customer_nama_belakang']}}</td>
                </tr>
                <tr style="white-space: nowrap;">
                    <td>Phone</td>
                    <td>:</td>
                    <td>{{$response_sales['data']['customer_nama_depan']}} {{$response_sales['data']['customer_nama_belakang']}}</td>
                </tr>
                <tr style="white-space: nowrap;">
                    <td>Email</td>
                    <td>:</td>
                    <td>{{$response_sales['data']['customer_nama_depan']}} {{$response_sales['data']['customer_nama_belakang']}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6 black-text bold-text d-flex justify-content-end">
            <br/>
            <table>
                <tr style="white-space: nowrap;">
                    <td>Payment Method</td>
                    <td>:</td>
                    @if ($response_sales['data']['dp'] != "null")
                        <td>{{$response_sales['data']['dp']}}</td>
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
@endsection
