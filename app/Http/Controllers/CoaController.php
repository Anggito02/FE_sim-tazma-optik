<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class CoaController extends Controller
{
    //
    public function getAllCoa(){
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/coa/all', $api_request);

        $coa = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($coa['status'] == 'success'){
            return view('master.coa', ['coa' => $coa['data'], 'data' => $user['data']]);

        }else{
            return redirect('/dashboard');
        }
    }

    public function addCoa(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'kode_coa' => $request->kode_coa,
            'deskripsi' => $request->deskripsi_coa,
            'kategori' => $request->kategori_coa,
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/coa/add', $api_request);

        $result = $response->json();
        dd($result);
        if($result['status'] == 'success'){
            toastr()->info('Coa added successfully!', 'Coa', ['timeOut' => 3000]);
            return redirect('/coa');
        }else{
            toastr()->error($result['message'], 'Coa', ['timeOut' => 3000]);
            return redirect('/coa');
        }
    }

    public function updateCoa(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id_coa,
            'deskripsi' => $request->deskripsi_coa,
            'kategori' => $request->kategori_coa
        ];


        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/coa/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Coa updated successfully!', 'Coa', ['timeOut' => 3000]);
            return redirect('/coa');
        }else{
            toastr()->error($result['message'], 'Coa', ['timeOut' => 3000]);
            return redirect('/coa');
        }
    }

    public function deleteCoa(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/coa/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Coa deleted successfully!', 'Coa', ['timeOut' => 3000]);
            return redirect('/coa');
        }else{
            toastr()->error($result['message'], 'Coa', ['timeOut' => 3000]);
            return redirect('/coa');
        }
    }
}
