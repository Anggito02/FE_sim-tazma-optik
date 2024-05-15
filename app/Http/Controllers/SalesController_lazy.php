<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
// use App\Utils\GetUserInfo;

class SalesController_lazy extends Controller
{
    protected $response_user_info;
    protected $headers;
    public function __construct(){
        if(isset($_COOKIE['token'])){
            $token = $_COOKIE['token'];
            $headers_ = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            $this->headers=$headers_;
        }else{
            return redirect('/dashboard');
        }
    }
    public function detail(Request $request){
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-detail/all', $request);
        return response()->json($response->json());
    }
    public function findSalesMaster(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        if($request->nomor_transaksi!=0){
            $data_fillter=[
                "page"=> 1,
                "limit"=> 10,
                "nomor_transaksi"=> $request->nomor_transaksi
            ];
        }else{
            $data_fillter=[
                "page"=> 1,
                "limit"=> 10,
            ];
        }
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/all', $data_fillter);
        return response()->json($response->json());
    }
}
