<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class CategoryController extends Controller
{
    public function getAllCategory(){
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/category/all', $api_request);

        $category = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($category['status'] == 'success'){
            return view('master.category', ['category' => $category['data'], 'data' => $user['data']]);

        }else{
            return redirect('/dashboard');
        }
    }

    public function addCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'nama_kategori' => $request->nama_kategori
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/category/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Category added successfully!', 'Category', ['timeOut' => 3000]);
            return redirect('/category');
        }else{
            toastr()->error($result['message'], 'Category', ['timeOut' => 3000]);
            return redirect('/category');
        }
    }

    public function updateCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->category_id,
            'nama_kategori' => $request->nama_kategori
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/category/edit', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            toastr()->info('Category updated successfully!', 'Category', ['timeOut' => 3000]);
            return redirect('/category');
        }else{
            toastr()->error($result['message'], 'Category', ['timeOut' => 3000]);
            return redirect('/category');
        }
    }

    public function deleteCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->category_id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/category/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Category deleted successfully!', 'Category', ['timeOut' => 3000]);
            return redirect('/category');
        }else{
            toastr()->error($result['message'], 'Category', ['timeOut' => 3000]);
            return redirect('/category');
        }
    }

}
