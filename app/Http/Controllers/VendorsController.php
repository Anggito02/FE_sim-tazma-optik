<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class VendorsController extends Controller
{
    public function getAllVendor(){
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        

        $vendor = $response->json();
        // dd($vendor);

        $user = GetUserInfo::getUserInfo();

        if ($vendor['status'] == 'success'){
            return view('master.vendor', ['vendor' => $vendor['data'], 'data' => $user['data']]);

        }else{
            // return view('/dashboard');
            return redirect('/dashboard');
        }

        // $token = $_COOKIE['token'];

        // $page = 1;
        // $limit = 100;

        // $headers = [
        //     'Accept' => 'application/json',
        //     'Authorization' => 'Bearer '.$token
        // ];

        // $api_request = [
        //     "page" => $page,
        //     "limit" => $limit
        // ];

        // $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        // dd($response);
        // $vendor = $response->json();
        

        // $user = GetUserInfo::getUserInfo();

        // if ($vendor['status'] == 'success'){
        //     return view('master.vendor', ['vendor' => $vendor['data'], 'data' => $user['data']]);

        // }else{
        //     return view('/dashboard');
        // }
    }

    public function addVendor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'kode_vendor' => $request->kode_vendor,
            'npwp_vendor' => $request->npwp_vendor,
            'nama_vendor' => $request->nama_vendor,
            'alamat_vendor' => $request->alamat_vendor,
            'init_date_supply' => $request->init_data_vendor,
            'last_date_supply' => $request->last_data_vendor,
            'pic_vendor' => $request->pic_vendor,
            'no_telp_vendor' => $request->note_telp_vendor,
            'no_telp_pic' => $request->no_telp_pic_vendor,
            'status_blacklist' => $request->status_vendor
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/vendor/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Vendor added successfully!', 'Vendor', ['timeOut' => 3000]);
            return redirect('/vendors');
        }else{
            toastr()->error($result['message'], 'Vendor', ['timeOut' => 3000]);
            return redirect('/vendors');
        }
    }

    public function updateVendor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'kode_vendor' => $request->kode_vendor,
            'npwp_vendor' => $request->npwp_vendor,
            'nama_vendor' => $request->nama_vendor,
            'alamat_vendor' => $request->alamat_vendor,
            'init_data_supply' => $request->init_data_vendor,
            'last_data_supply' => $request->last_data_vendor,
            'pic_vendor' => $request->pic_vendor,
            'no_telp_vendor' => $request->no_telp_vendor,
            'no_telp_pic' => $request->no_telp_pic_vendor,
            'status_blacklist' => $request->status_vendor
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/vendor/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Vendor updated successfully!', 'Vendor', ['timeOut' => 3000]);
            return redirect('/vendors');
        }else{
            toastr()->error($result['message'], 'Vendor', ['timeOut' => 3000]);
            return redirect('/vendors');
        }
    }

    public function deleteVendor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        
        $api_request = [
            'id' => $request->id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/vendor/delete', $api_request);
        
        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Vendor deleted successfully!', 'Vendor', ['timeOut' => 3000]);
            return redirect('/vendors');
        }else{
            toastr()->error($result['message'], 'Vendor', ['timeOut' => 3000]);
            return redirect('/vendors');
        }
    }

}
