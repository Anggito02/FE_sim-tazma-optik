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
        // print_r($headers);
        $jenis_item = null;
        $jenis_item = $request->jenis_item;

        if ($request->jenis_item == null){
            $jenis_item = '0';
        };

        $api_request = [
            "jenis_item" => $jenis_item,
            "page" => $page,
            "limit" => $limit
        ];
        // print_r($api_request);

        // $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/allWithJenis', $api_request);
        $response_index = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/index/all', $api_request);
        $response_brand = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/brand/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        $response_color = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/color/all', $api_request);
        $response_Category = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/category/all', $api_request);
        // $response_lensaCategory = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/lens-category/all', $api_request);
        // dd($response);
        // $item = $response->json();
        // print_r($item);
        // dd($item);
        $index = $response_index->json();
        $brand = $response_brand->json();
        $vendor = $response_vendor->json();
        $color = $response_color->json();
        $category = $response_Category->json();
        // $frameCategory = $response_frameCategory->json();
        // dd($frameCategory);
        // $lensaCategory = $response_lensaCategory->json();
        // dd($lensaCategory);

        $user = GetUserInfo::getUserInfo();
        // dd($user);
        // if ($item['status'] == 'success'){
            return view('master.item', [
                // 'item' => $item['data'],
                'data' => $user['data'],
                'index' => $index['data'],
                'brand' => $brand['data'],
                'vendor' => $vendor['data'],
                'color' => $color['data'],
                'category' => $category['data'],
                // 'frameCategory' => $frameCategory['data'],
                // 'lensaCategory' => $lensaCategory['data'],
                'jenis_item' => $jenis_item,
                'kode_item' => $request->kode_item,
                'aksesoris_nama_item' => $request->aksesoris_nama_item
            ]);
        // } else {
            // return redirect('/dashboard');
        // }
        // dd($item);

    }
    public function loadDataDetailOnly(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all(); 
        $api_request = [
            "page" => 1,
            "limit" => 10000
        ];
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/one', $data)->json();
        $response_index = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/index/all', $api_request);
        $response_brand = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/brand/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        $response_color = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/color/all', $api_request);
        $response_Category = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/category/all', $api_request);
        return view('master.itemEdit',['vals'=>$response['data'],'index' => $response_index['data'],'brand' => $response_brand['data'],'vendor' => $response_vendor['data'],'color' => $response_color['data'],'category' => $response_Category['data']]);
    }
    public function loadDataMaster(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all(); // Retrieve all input data from the request
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $data);
        $item = $response->json();
        // print_r($response);
        return response()->json($item);
    }
    public function addItem(Request $request)
    {
        $row="";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;
        $category_id=$request->category_id;
        $brand_id=$request->brand_id;
        $frame_color_id=$request->frame_color_id;
        $nama_kategori=NULL;
        $nama_brand_item=NULL;
        $warna_item=NULL;
        if(!empty($request->category_id) && !empty($request->brand_id) && !empty($request->frame_color_id)){
            $nama_kategori = explode('-', $request->category_id);
            $category_id = intval($nama_kategori[0]);
            $nama_kategori = $nama_kategori[1];
            $nama_brand_item = explode('-', $request->brand_id);
            $brand_id = intval($nama_brand_item[0]);
            $nama_brand_item = $nama_brand_item[1];
            $warna_item = explode('-', $request->frame_color_id);
            $frame_color_id = intval($warna_item[0]);
            $warna_item = $warna_item[1];
        }

        $lensa_index_id = intval($request->lensa_index_id);
        if($lensa_index_id==0){
            $lensa_index_id=NULL;
        }
        $index_lensa=NULL;
        if ($request->jenis_item == "lensa" && !empty($request->lensa_index_id)) {
            $index_lensa = explode('-', $request->lensa_index_id);
            $lensa_index_id = intval($index_lensa[0]);
            $index_lensa = $index_lensa[1];
        }
        $api_request = [
            'jenis_item' =>$request->jenis_item,
            'deskripsi' =>$request->deskripsi,
            'nama_kategori'=>$nama_kategori,
            'nama_brand_item'=>$nama_brand_item,
            'warna_item'=>$warna_item,
            'brand_id' =>$brand_id,
            'vendor_id' =>intval($request->vendor_id),
            'category_id'=>$category_id,
            'aksesoris_nama_item' =>$request->aksesoris_nama_item,
            'frame_sku_vendor'=>$request->frame_sku_vendor,
            'frame_color_id'=>$frame_color_id,
            "frame_kode" => $request->frame_kode,
            "frame_sub_kategori" => $request->frame_sub_kategori,
            "lensa_jenis_produk" => $request->lensa_jenis_produk,
            "lensa_jenis_lensa" => $request->lensa_jenis_lensa,
            "lensa_index_id" =>$lensa_index_id,
            "index_lensa" =>$index_lensa,
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/item/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ";
        }
        return response()->json($result);
    }

    public function updateItem(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ]; 

        if ($request->jenis_item == "frame") {
            $frame_frame_category_id = explode('-', $request->frame_frame_category_id);
            $frame_frame_category_id = intval($frame_frame_category_id[0]);
            $frame_brand_id = explode('-', $request->frame_brand_id);
            $frame_brand_id = intval($frame_brand_id[0]);
            $frame_vendor_id = explode('-', $request->frame_vendor_id);
            $frame_vendor_id = intval($frame_vendor_id[0]);
            $frame_color_id = explode('-', intval($request->frame_color_id));
            $frame_color_id = intval($frame_color_id[0]);
        } else {
            $frame_frame_category_id = null;
            $frame_brand_id = null;
            $frame_vendor_id = null;
            $frame_color_id = null;
        }

        if ($request->jenis_item == "lensa") {
            $lensa_lens_category_id = intval($request->lensa_lens_category_id);
            $lensa_brand_id = explode('-', $request->lensa_brand_id);
            $lensa_brand_id = intval($lensa_brand_id[0]);
            $lensa_index_id = explode('-', intval($request->lensa_index_id));
            $lensa_index_id = intval($lensa_index_id[0]);
        } else {
            $lensa_lens_category_id = null;
            $lensa_brand_id = null;
            $lensa_index_id = null;
        }

        if ($request->jenis_item == "aksesoris") {
            $aksesoris_brand_id = explode('-', $request->aksesoris_brand_id);
            $aksesoris_brand_id = intval($aksesoris_brand_id[0]);
        } else {
            $aksesoris_brand_id = null;
        }
        $fields = ['jenis_item','deskripsi','stok', 'harga_beli','harga_jual','frame_sku_vendor','frame_sub_kategori','frame_kode','lensa_jenis_produk','lensa_jenis_lensa','aksesoris_nama_item','aksesoris_kategori'];
        $api_request = ['id' => intval($request->item_id)];
        foreach ($fields as $field) {
            if (!is_null($request->$field)) {
                $api_request[$field] = $request->$field;
            }
        }
        $fields2 = ['frame_frame_category_id','frame_brand_id','frame_vendor_id','frame_color_id','lensa_lens_category_id','lensa_brand_id','lensa_index_id','aksesoris_brand_id'];
        $fields3 = [
            'frame_frame_category_id' => $frame_frame_category_id,
            'frame_brand_id' => $frame_brand_id,
            'frame_vendor_id' => $frame_vendor_id,
            'frame_color_id' => $frame_color_id,
            'lensa_lens_category_id' => $lensa_lens_category_id,
            'lensa_brand_id' => $lensa_brand_id,
            'lensa_index_id' => $lensa_index_id,
            'aksesoris_brand_id' => $aksesoris_brand_id
        ];
        foreach ($fields2 as $field2) {
            if (!is_null($fields3[$field2])) {
                $api_request[$field2] = $fields3[$field2];
            }
        }
        print_r($api_request);
        // // dd($api_request);

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/item/edit', $api_request);

        // // dd($response);

        $result = $response->json();
        print_r($result);
        // // dd($result);

        if($result['status'] == 'success'){
            $row['message']="The data has been successfully updated";
            //     toastr()->info('Item updated successfully!', 'Item', ['timeOut' => 3000]);
            //     return redirect('/item');
        }else{
            $row['message']="Update data failed ";
        //     toastr()->error($result['message'], 'Item', ['timeOut' => 3000]);
        //     return redirect('/item');
        }
        return response()->json($row);
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

