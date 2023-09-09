<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class BrandController extends Controller
{
    //
    public function getAllBrand(){
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/brand/all', $api_request);

        $brand = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($brand['status'] == 'success'){
            return view('master.brand', ['brand' => $brand['data'], 'data' => $user['data']]);

        }else{
            return view('/dashboard');
        }
    }

    public function addBrand(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'nama_brand' => $request->nama_brand,
            'deskripsi' => $request->deskripsi,
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/brand/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Brand added successfully!', 'Brand', ['timeOut' => 3000]);
            return redirect('/brand');
        }else{
            toastr()->error($result['message'], 'Brand', ['timeOut' => 3000]);
            return redirect('/brand');
        }
    }

    public function updateBrand(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->brand_id,
            'nama_brand' => $request->nama_brand,
            'deskripsi' => $request->deskripsi
        ];
        

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/brand/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Brand updated successfully!', 'Brand', ['timeOut' => 3000]);
            return redirect('/brand');
        }else{
            toastr()->error($result['message'], 'Brand', ['timeOut' => 3000]);
            return redirect('/brand');
        }
    }

    public function deleteBrand(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/brand/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Brand deleted successfully!', 'Brand', ['timeOut' => 3000]);
            return redirect('/brand');
        }else{
            toastr()->error($result['message'], 'Brand', ['timeOut' => 3000]);
            return redirect('/brand');
        }
    }
}
