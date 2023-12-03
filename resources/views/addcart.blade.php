@extends('layout')
@section('content')
<div class="d-flex flex-row h-100">
    <div class="bg-white m-2 shadow p-3" style="width:70%">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row justify-content-center" style="margin-bottom: 2%;">
                <div class="form-control rounded-0" style="width: 48%; margin-right:2%;">Anandito</div>
                <div class="form-control rounded-0" style="width: 48%; margin-left:2%;">Satria</div>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="form-control rounded-0" style="width: 48%; margin-right:2%;">Anandito</div>
                <div class="form-control rounded-0" style="width: 48%; margin-left:2%;">Satria</div>
            </div>
        </div>
    </div>
    <div class="m-2 shadow d-flex flex-column justify-content-between" style="width:30%">
        <div>
            <a href="" class="btn btn-primary btn-lg active w-100 border-bottom-0 rounded-0" role="button" aria-pressed="true">
                + Add Customer
            </a>    
            <div class="d-flex flex-column align-items-center">
                <p class="text-center p-2 text-dark m-0"><b>Take Away</b></p>
                <div class="border-top border-secondary" style="width:98%">
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
                <a href="" class="btn btn-secondary btn-lg active w-50 rounded-0" role="button" style="margin:3px" aria-pressed="true">
                    Save Bill
                </a>
                <a href="" class="btn btn-secondary btn-lg active w-50 rounded-0" role="button" style="margin:3px" aria-pressed="true">
                    Print Bill
                </a>  
            </div>
            <a href="" class="btn btn-primary btn-lg active w-95 rounded-0" role="button" style="margin-right:3px; margin-left:3px;    " aria-pressed="true">
                Charge Rp 1.200.000
            </a> 
        </div>
    </div>
</div>
@endsection