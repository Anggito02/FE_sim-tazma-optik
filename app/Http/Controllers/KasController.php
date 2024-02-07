<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;


class KasController extends Controller {
    public function prosesKasBranch (Request $request) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 50;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);

        $branch_all = $response_branch->json();

        $user = GetUserInfo::getUserInfo();

        return view('sales.kas', [
            'data' => $user['data'],
            'branch_all' => $branch_all['data']
        ]);
    }

    public function getAllKas (Request $request) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 50;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_kas = [
            "page" => $page,
            "limit" => $limit,
            "branch_id" => $request->branch_id,
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit,
        ];

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request_kas);
        $response_pengeluaran = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/all', $api_request_kas);
        $response_pengeluaran_in = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/kas-in/all', $api_request_kas);

        $branch_all = $response_branch->json();
        $kas_all = $response_kas->json();
        $pengeluaran_all = $response_pengeluaran->json();
        $pengeluaran_in = $response_pengeluaran_in->json();

        $user = GetUserInfo::getUserInfo();

        return view('sales.kas', [
            'data' => $user['data'],
            'kas_all' => $kas_all['data'],
            'branch_all' => $branch_all['data'],
            'idx_branch' => $request->branch_id,
            'pengeluaran_all' => $pengeluaran_all['data'],
            'pengeluaran_in' => $pengeluaran_in['data'],
        ]);
    }

    public function loadDataMaster(Request $request){
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $request->page,
            "limit" => $request->limit,
            "branch_id" => $request->branch_id,
        ];

        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request);

        $kas = $response_kas->json();

        return response()->json($kas);
    }

    public function loadDataMasterCashOut(Request $request){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $request->page,
            "limit" => $request->limit,
            "branch_id" => $request->branch_id,
        ];

        $response_pengeluaran = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/all', $api_request);

        $pengeluaran = $response_pengeluaran->json();

        return response()->json($pengeluaran);
    }

    public function loadDataMasterCashIn(Request $request){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $request->page,
            "limit" => $request->limit,
            "branch_id" => $request->branch_id,
        ];

        $response_pengeluaran_in = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/kas-in/all', $api_request);

        $pengeluaran_in = $response_pengeluaran_in->json();

        return response()->json($pengeluaran_in);
    }

    public function addKasOut(Request $request) {
        $row ="";
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;

        $page = 1;
        $limit = 50;

        $api_request = [
            'deskripsi' => $request->deskripsi,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'bentuk_pengeluaran' => $request->bentuk_pengeluaran,
            'branch_id' => $request->branch_id,
            'made_by' => $request->made_by,
        ];

        $api_request_kas = [
            "page" => $page,
            "limit" => $limit,
            "branch_id" => $request->branch_id,
        ];

        $api_request_def = [
            "page" => $page,
            "limit" => $limit,
        ];

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request_def);
        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request_kas);
        $response_pengeluaran = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/all', $api_request_kas);

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/add', $api_request);

        $result = $response->json();
        $branch_all = $response_branch->json();
        $kas_all = $response_kas->json();
        $pengeluaran_all = $response_pengeluaran->json();

        $user = GetUserInfo::getUserInfo();

        return view('sales.kas', [
            'data' => $user['data'],
            'kas_all' => $kas_all['data'],
            'branch_all' => $branch_all['data'],
            'idx_branch' => $request->branch_id,
            'pengeluaran_all' => $pengeluaran_all['data'],
        ]);
    }

    public function addKasIn(Request $request) {
        $row ="";
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;

        $page = 1;
        $limit = 50;

        $api_request = [
            'deskripsi' => $request->deskripsi,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'bentuk_pengeluaran' => $request->bentuk_pengeluaran,
            'branch_id' => $request->branch_id,
            'made_by' => $request->made_by,
        ];

        $api_request_kas = [
            "page" => $page,
            "limit" => $limit,
            "branch_id" => $request->branch_id,
        ];

        $api_request_def = [
            "page" => $page,
            "limit" => $limit,
        ];

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request_def);
        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request_kas);
        $response_pengeluaran = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/all', $api_request_kas);

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/add', $api_request);

        $result = $response->json();
        $branch_all = $response_branch->json();
        $kas_all = $response_kas->json();
        $pengeluaran_all = $response_pengeluaran->json();

        $user = GetUserInfo::getUserInfo();

        return view('sales.kas', [
            'data' => $user['data'],
            'kas_all' => $kas_all['data'],
            'branch_all' => $branch_all['data'],
            'idx_branch' => $request->branch_id,
            'pengeluaran_all' => $pengeluaran_all['data'],
        ]);
    }

    public function addNewDailyKas(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $page = 1;
        $limit = 50;

        $api_request = [
            'modal_tambahan_harian' => $request->modal_tambahan_harian,
            'branch_id' => $request->branch_id,
            'employee_id' => $request->employee_id,
        ];

        $api_request_kas = [
            "page" => $page,
            "limit" => $limit,
            "branch_id" => $request->branch_id,
        ];

        $api_request_def = [
            "page" => $page,
            "limit" => $limit,
        ];

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request_def);
        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request_kas);
        $response_pengeluaran = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/all', $api_request_kas);
        $response_add_daily_kas = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/kas/add', $api_request);

        $add_daily_kas = $response_add_daily_kas->json();
        $branch_all = $response_branch->json();
        $kas_all = $response_kas->json();
        $pengeluaran_all = $response_pengeluaran->json();

        $user = GetUserInfo::getUserInfo();

        return view('sales.kas', [
            'data' => $user['data'],
            'kas_all' => $kas_all['data'],
            'branch_all' => $branch_all['data'],
            'idx_branch' => $request->branch_id,
            'pengeluaran_all' => $pengeluaran_all['data'],
        ]);
    }

    public function checkKasIfExist(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $page = 1;
        $limit = 50;

        $api_request = [
            'branch_id' => $request->branch_id,
        ];

        $api_request_kas = [
            "page" => $page,
            "limit" => $limit,
            "branch_id" => $request->branch_id,
        ];

        $api_request_def = [
            "page" => $page,
            "limit" => $limit,
        ];

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request_def);
        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request_kas);
        $response_pengeluaran = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/pengeluaran/all', $api_request_kas);
        $response_check_exist = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/kas/exist', $api_request);

        $check_exist = $response_check_exist->json();
        $branch_all = $response_branch->json();
        $kas_all = $response_kas->json();
        $pengeluaran_all = $response_pengeluaran->json();

        dd($check_exist);

        $user = GetUserInfo::getUserInfo();

        return view('sales.kas', [
            'data' => $user['data'],
            'kas_all' => $kas_all['data'],
            'branch_all' => $branch_all['data'],
            'idx_branch' => $request->branch_id,
            'pengeluaran_all' => $pengeluaran_all['data'],
        ]);
    }

}
