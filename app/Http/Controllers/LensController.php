<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class LensController extends Controller
{
    public function getAllLensCategory(){
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

        $response = Http::withHeaders($headers)->get('http://localhost:8001/api/lens-category/all', $api_request);

        $lens = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($lens['status'] == 'success'){
            return view('master.lens', ['lens' => $lens['data'], 'data' => $user['data']]);

        }else{
            return view('/dashboard');
        }
    }

    public function addLensCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'nama_kategori' => $request->lens_nama
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/lens-category/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Lens category added successfully!', 'Lens', ['timeOut' => 3000]);
            return redirect('/lens-category');
        }else{
            toastr()->error($result['message'], 'Lens', ['timeOut' => 3000]);
            return redirect('/lens-category');
        }
    }

    public function updateLensCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->lens_id,
            'nama_kategori' => $request->lens_nama
        ];

        $response = Http::withHeaders($headers)->put('http://localhost:8001/api/lens-category/edit', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            toastr()->info('Lens category updated successfully!', 'Lens', ['timeOut' => 3000]);
            return redirect('/lens-category');
        }else{
            toastr()->error($result['message'], 'Lens', ['timeOut' => 3000]);
            return redirect('/lens-category');
        }
    }

    public function deleteLensCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->lens_id
        ];

        $response = Http::withHeaders($headers)->delete('http://localhost:8001/api/lens-category/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Lens category deleted successfully!', 'Lens', ['timeOut' => 3000]);
            return redirect('/lens-category');
        }else{
            toastr()->error($result['message'], 'Lens', ['timeOut' => 3000]);
            return redirect('/lens-category');
        }
    }

}
