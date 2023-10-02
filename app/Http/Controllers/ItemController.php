<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ItemController extends Controller
{
    //
    public function getAllItem(Request $request){
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];


        $jenis_item = '';

        if ($jenis_item == null){
            $jenis_item ='aksesoris';
        };

        $api_request = [
            "jenis_item" => $jenis_item,
            "page" => $page,
            "limit" => $limit
        ];
        // dd($api_request);
        
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/allWithJenis', $api_request);
        // dd($response);
        $item = $response->json();
        // dd($item);
        
        $user = GetUserInfo::getUserInfo();
        // dd($user);

        dd($item['status']);
        if ($item['status'] == 'success'){
            return view('master.item', ['item' => $item['data'], 'data' => $user['data']]);
        } else {
            return redirect('/dashboard');
        }

    }

    public function addItem(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'jenis_item' => $request->jenis_item,
            'deskripsi' => $request->deskripsi,
            'kode_item' => $request->kode_item,
            'stok' => $request->stok,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'frame_sku_vendor' => $request->frame_sku_vendor,
            'frame_sub_kategori' => $request->frame_sub_kategori,
            'frame_kode' => $request->frame_kode,
            'lensa_jenis_produk' => $request->lensa_jenis_produk,
            'lensa_jenis_lensa' => $request->lensa_jenis_lensa,
            'aksesoris_kategori' => $request->aksesoris_kategori
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/item/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Item added successfully!', 'Item', ['timeOut' => 3000]);
            return redirect('/item');
        }else{
            toastr()->error($result['message'], 'Item', ['timeOut' => 3000]);
            return redirect('/item');
        }
    }

    public function updateItem(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->item_id,
            'jenis_item' => $request->jenis_item,
            'deskripsi' => $request->deskripsi,
            'kode_item' => $request->kode_item,
            'stok' => $request->stok,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'frame_sku_vendor' => $request->frame_sku_vendor,
            'frame_sub_kategori' => $request->frame_sub_kategori,
            'frame_kode' => $request->frame_kode,
            'lensa_jenis_produk' => $request->lensa_jenis_produk,
            'lensa_jenis_lensa' => $request->lensa_jenis_lensa,
            'aksesoris_kategori' => $request->aksesoris_kategori
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/item/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Item updated successfully!', 'Item', ['timeOut' => 3000]);
            return redirect('/item');
        }else{
            toastr()->error($result['message'], 'Item', ['timeOut' => 3000]);
            return redirect('/item');
        }
    }

    public function deleteItem(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/item/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Item deleted successfully!', 'Item', ['timeOut' => 3000]);
            return redirect('/item');
        }else{
            toastr()->error($result['message'], 'Item', ['timeOut' => 3000]);
            return redirect('/item');
        }
    }
}

