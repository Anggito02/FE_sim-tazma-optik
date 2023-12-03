<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Utils\GetUserInfo;

class BranchItemController extends Controller
{
    /**
     * Deskripsi: Mengambil semua Branch Item
     *
     * Parameter yang dibutuhkan:
     * @param  Request  $request
     * - @param int   $page   Halaman yang ingin ditampilkan
     * - @param int   $limit  Banyaknya data yang ingin ditampilkan
     *
     * Return value:
     * - @return array  $branch_item['data']    Array dari branch item
     *      - @return int       $branch_item['data']['id']          ID dari branch item
     *
     *      - @return int       $branch_item['data']['item_id']     ID dari item
     *      - @return string    $branch_item['data']['jenis_item']  Jenis dari item
     *      - @return string    $branch_item['data']['kode_item']   Kode dari item
     *      - @return int       $branch_item['data']['stok_global'] Stok global dari item
     *      - @return int       $branch_item['data']['stok_branch'] Stok branch dari item
     *
     *      - @return int       $branch_item['data']['branch_id']   ID dari branch
     *      - @return string    $branch_item['data']['kode_cabang'] Kode dari branch
     *      - @return string    $branch_item['data']['nama_cabang'] Nama dari branch
     *
     * Catatan tambahan:
     * 1. Nama atribut data yang didapatkan bisa dibaca di return value
     */
    public function getAllBranchItem (Request $request) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_getBranchItem = [
            "page" => $page,
            "limit" => $limit
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch-item/all', $api_request_getBranchItem);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request_getBranchItem);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/all', $api_request_getBranchItem);
        $branch_item = $response->json();
        $branch = $response_branch->json();
        // dd($branch);
        $item = $response_item->json();
        // dd($item);
        // dd($branch_item);

        $user = GetUserInfo::getUserInfo();
        if ($branch_item['status'] == 'success'){
            return view('inventory.branchItem', [
                'branch_item' => $branch_item['data'],
                'branch' => $branch['data'],
                'item' => $item['data'],
                'data' => $user['data']
            ]);
        }else{
            return redirect('/dashboard');
        }
    }

    /**
     * Deskripsi: Mengambil semua Branch Item
     *
     * Parameter yang dibutuhkan:
     * @param  Request  $request
     * - @param int   $branch_id  ID dari branch yang ingin stoknya ditambah
     * - @param int   $item_id    ID dari item yang ingin ditambahkan stoknya
     *
     * Return value:
     * - @return    succcess|error
     *
     * Catatan tambahan:
     * 1. Pada modal tambah Branch Item, sudah disediakan dropdown untuk memilih branch dan item yang ingin ditambahkan stoknya
     * 2. Pass id dari branch dan item yang dipilih ke route ini
     */
    public function addBranchItem(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_addBranchItem = [
            "branch_id" => $request->branch_id,
            "item_id" => $request->item_id,
        ];

        $response_addBranchItem = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/branch-item/add', $api_request_addBranchItem);

        $result_addBranchItem = $response_addBranchItem->json();
        // dd($result_addBranchItem);

        if ($result_addBranchItem['status'] == 'success'){
            toastr()->info('Branch item added successfully!', 'Branch Item', ["timeOut" => 3000]);
            return redirect('/branch-item');
        }else{
            toastr()->error('Failed to add branch item!', 'Branch Item', ["timeOut" => 3000]);
            return redirect('/branch-item');
        }
    }
}

?>
