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


        $jenis_item = $request->input('jenis_item');

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
        $response_index = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/index/all', $api_request);
        $response_brand = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/brand/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        $response_color = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/color/all', $api_request);
        $response_frameCategory = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/frame-category/all', $api_request);
        $response_lensaCategory = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/lens-category/all', $api_request);
        // dd($response);
        $item = $response->json();
        $index = $response_index->json();
        $brand = $response_brand->json();
        $vendor = $response_vendor->json();
        $color = $response_color->json();
        $frameCategory = $response_frameCategory->json();
        $lensaCategory = $response_lensaCategory->json();
        // dd($item);
        

        $user = GetUserInfo::getUserInfo();

        if ($item['status'] == 'success'){
            return view('master.item', [
                'item' => $item['data'],
                'data' => $user['data'],
                'index' => $index['data'],
                'brand' => $brand['data'],
                'vendor' => $vendor['data'],
                'color' => $color['data'],
                'frameCategory' => $frameCategory['data'],
                'lensaCategory' => $lensaCategory['data']
            ]);
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

        $warna_item = explode('_', $request->frame_color_id)[1];
        $frame_color_id = explode('_', $request->frame_color_id)[0];

        $api_request = [
            'jenis_item' => $request->jenis_item,
            'deskripsi' => $request->deskripsi,
            'nama_brand_item' => $request->nama_brand_item,
            'warna_item' => $warna_item,
            'index_lensa' => $request->index_lensa,
            'frame_sku_vendor' => $request->frame_sku_vendor,
            'frame_sub_kategori' => $request->frame_sub_kategori,
            'frame_kode' => $request->frame_kode,
            'lensa_jenis_produk' => $request->lensa_jenis_produk,
            'lensa_jenis_lensa' => $request->lensa_jenis_lensa,
            'aksesoris_nama_item' => $request->aksesoris_nama_item,
            'aksesoris_kategori' => $request->aksesoris_kategori,
            'frame_frame_category_id' => $request->frame_frame_category_id,
            'frame_brand_id' => $request->frame_brand_id,
            'frame_vendor_id' => $request->frame_vendor_id,
            'frame_color_id' => $frame_color_id,
            'lensa_lens_category_id' => $request->lensa_lens_category_id,
            'lensa_brand_id' => $request->lensa_brand_id,
            'lensa_index_id' => $request->lensa_index_id,
            'aksesoris_brand_id' => $request->aksesoris_brand_id
        ];
        // dd($api_request);

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

