<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class SalesController extends Controller
{
    protected $response_user_info;
    protected $headers;
    public function __construct(){
        if(isset($_COOKIE['token'])){
            $token = $_COOKIE['token'];
            // print_r($token);
            $headers_ = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            $this->headers=$headers_;
            $response_user_info_ = GetUserInfo::getUserInfo();
            if($response_user_info_){    
                $this->response_user_info=$response_user_info_;
            }else{
                return redirect('/dashboard');
            }
        }else{
            return redirect('/dashboard');
        }
    }
    public function index (Request $request) {
        $api_request = [
            "page" => 0,
            "limit" => 100,
            "branch_id" => $this->response_user_info['data']['branch_id']
        ];
        $sales_master['id']=0;
        if(isset($request->sales_master_id)){
            $sales_master['id']=$request->sales_master_id;
        }
        $api_request_employee_one['id']=$this->response_user_info['data']['id'];
        $response_employee_one = Http::withHeaders($this->headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/one', $api_request_employee_one);
        $response_sales_master =Http::withHeaders($this->headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/one/id', $sales_master);
        $kas['data']="hallo";
        $user = GetUserInfo::getUserInfo();
        return view('sales.kasir', [
            'response_employee_one' => $response_employee_one['data'],
            'response_sales' => $response_sales_master,
            'kas' => $kas['data'],
            'user_info' => $this->response_user_info,
            'data' => $user['data']
        ]);
    }
    function print_invoice(Request $request){
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $sales_master['id']=0;
        $sales_master_s['sales_master_id']=0;
        if(isset($request->sales_master_id)){
            $sales_master['id']=$request->sales_master_id;
            $sales_master_s['sales_master_id']=$request->sales_master_id;
            $sales_master_s['page']=1;
            $sales_master_s['limit']=10000;
        }
        $response_sales_master =Http::withHeaders($this->headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/one/id', $sales_master);
        $responses = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-detail/all', $sales_master_s);
        return view('sales.invoice', [
            'response_sales_detail' => $responses,
            'response_sales' => $response_sales_master,
        ]);
    }
    public function findCustomer(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all();
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer/one', $data);
        $customer = $response->json();
        return response()->json($customer);
    }
    // public function detail(Request $request){
    //     $token = $_COOKIE['token'];
    //     $headers = [
    //         'Accept' => 'application\json',
    //         'Authorization' => 'Bearer '.$token
    //     ];
    //     $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-detail/all', $request);
    //     // print_r($request);
    //     return response()->json($response->json());
    // }
    // public function findSalesMaster(Request $request)
    // {
    //     $token = $_COOKIE['token'];
    //     $headers = [
    //         'Accept' => 'application\json',
    //         'Authorization' => 'Bearer '.$token
    //     ];
    //     if($request->nomor_transaksi!=0){
    //         $data_fillter=[
    //             "page"=> 1,
    //             "limit"=> 10,
    //             "nomor_transaksi"=> $request->nomor_transaksi
    //         ];
    //     }else{
    //         $data_fillter=[
    //             "page"=> 1,
    //             "limit"=> 10,
    //         ];
    //     }
    //     $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/all', $data_fillter);
    //     return response()->json($response->json());
    // }
    function addScanItem(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            "kode_qr_po_detail"=>$request->qrcode,
            "sales_master_id"=>$request->sales_master_id,
            "branch_id"=>$request->branch_id
        ];
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/sales-detail/add', $api_request);
        $result = $response->json();
        // print_r($result);
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed".$result['message'];
        }
        return response()->json($row);
    }
    public function addCustomer(Request $request)
    {
        $row['message']="-";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            'nama_depan' =>$request->nama_depan,
            'nama_belakang' =>$request->nama_belakang,
            'email' =>$request->email,
            'nomor_telepon' =>$request->nomor_telepon,
            'alamat' =>$request->alamat,
            'kabkota_id' =>$request->kabkota_id,
            'tanggal_lahir' =>$request->tanggal_lahir,
            'gender' =>$request->gender,
            'branch_id' =>$this->response_user_info['data']['branch_id'],
        ];
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/customer/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ".$result['data'];
        }
        return response()->json($row);
    }
    public function addSalesDetail(Request $request)
    {
        $row['message']="-";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            'kode_qr_po_detail' =>strval($request->qrcode),
            'sales_master_id' =>intval($request->sales_master_id),
            'branch_id' =>intval($this->response_user_info['data']['branch_id']),
        ];
        print_r($api_request);
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/sales-detail/add', $api_request);
        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            // $row['message']="Insert data failed ".$result['data'];
        }
        return response()->json($result);
    }
    public function delete_detail(Request $request)
    {
        $row['message']="-";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            "id"=>$request->id,
            "sales_master_id"=>$request->sales_master_id,
        ];
        $response = Http::withHeaders($headers)->DELETE($_ENV['BACKEND_API_ENDPOINT'].'/sales-detail/delete', $api_request);
        return response()->json($response->json());
    }
    public function verifyMaster(Request $request)
    {
        print_r("masuk");
        $row['message']="-";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            "id"=>$request->id,
        ];
        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/verify', $api_request);
        return response()->json($response->json());
    }
    public function addPayment(Request $request)
    {
        $row['message']="-";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            "id"=>$request->id,
            'ref_sales_id' =>$request->ref_sales_id,
            "sistem_pembayaran"=>$request->sistem_pembayaran,
            "nomor_kartu"=>$request->nomor_kartu,
            "nomor_referensi"=>$request->nomor_referensi,
            "dp"=>$request->dp,
            'branch_id' =>$request->branch_id,
            'employee_id' =>$request->employee_id,
            'customer_id' =>$request->customer_id,
        ];
        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/edit', $api_request);
        return response()->json($response->json());
    }
    public function addSalesMaster(Request $request)
    {
        $row['message']="-";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            'ref_sales_id' =>$request->ref_sales_id,
            'branch_id' =>$request->branch_id,
            'employee_id' =>$request->employee_id,
            'customer_id' =>$request->customer_id,
        ];
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/add', $api_request);
        return response()->json($response->json());
    }

    // public function addPO(Request $request) {
    //     $token = $_COOKIE['token'];

    //     $headers = [
    //         'Accept' => 'application\json',
    //         'Authorization' => 'Bearer '.$token
    //     ];
    //     // dd($request->all());
    //     $status_penerimaan = $request->status_penerimaan;
    //     $status_pembayaran = $request->status_pembayaran;
    //     $status_po = $request->status_po;

    //     if ($status_penerimaan == 'Belum Diterima') {
    //         $status_penerimaan = 0;
    //     } else {
    //         $status_penerimaan = 1;
    //     }

    //     if ($status_pembayaran == 'Belum Dibayar') {
    //         $status_pembayaran = 0;
    //     } else {
    //         $status_pembayaran = 1;
    //     }

    //     if ($status_po == 'OPEN') {
    //         $status_po = 1;
    //     } else {
    //         $status_po = 0;
    //     }

    //     $api_request = [
    //         'nomor_po' => $request->nomor_po,
    //         'tanggal_dibuat' => $request->tanggal_dibuat,
    //         'status_penerimaan' => $status_penerimaan,
    //         'status_pembayaran' => $status_pembayaran,
    //         'status_po' => $status_po,
    //         'checked_by' => $request->checked_by,
    //         'made_by' => $request->made_by,
    //         'approved_by' => $request->approved_by,
    //         'vendor_id' => $request->vendor_id
    //     ];
    //     // dd($api_request);

    //     $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/add', $api_request);

    //     $result = $response->json();
    //     // dd($result);

    //     if($result['status'] == 'success'){
    //         toastr()->info('Purchase order added successfully!', 'Purchase Order', ['timeOut' => 3000]);
    //         return redirect('/PO');
    //     }else{
    //         toastr()->error($result['message'], 'Purchase Order', ['timeOut' => 3000]);
    //         return redirect('/PO');
    //     }
    // }

    // public function updatePO(Request $request){
    //     $token = $_COOKIE['token'];

    //     $headers = [
    //         'Accept' => 'application/json',
    //         'Authorization' => 'Bearer '.$token
    //     ];

    //     $api_request = [
    //         'id' => $request->id,
    //         'status_penerimaan' => $request->status_penerimaan,
    //         'status_pembayaran' => $request->status_pembayaran,
    //         'status_po' => $request->status_po,
    //         'checked_by' => $request->checked_by,
    //         'made_by' => $request->made_by,
    //         'approved_by' => $request->approved_by,
    //         'vendor_id' => $request->vendor_id
    //     ];
    //     // dd($api_request);

    //     $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/edit', $api_request);

    //     $result = $response->json();

    //     if($result['status'] == 'success'){
    //         toastr()->info('Purchase Order updated successfully!', 'Purchase Order', ['timeOut' => 3000]);
    //         return redirect('/PO');
    //     }else{
    //         toastr()->error($result['data'], 'Purchase Order', ['timeOut' => 3000]);
    //         return redirect('/PO');
    //     }
    // }

    // public function deletePO(Request $request){
    //     $token = $_COOKIE['token'];

    //     $headers = [
    //         'Accept' => 'application\json',
    //         'Authorization' => 'Bearer '.$token
    //     ];

    //     $api_request = [
    //         'id' => $request->po_id
    //     ];
    //     // dd($api_request);
    //     $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/delete', $api_request);

    //     $result = $response->json();

    //     if($result['status'] == 'success'){
    //         toastr()->info('Purchase Order deleted successfully!', 'Purchase Order', ['timeOut' => 3000]);
    //         return redirect('/PO');
    //     }else{
    //         toastr()->error($result['message'], 'Purchase Order', ['timeOut' => 3000]);
    //         return redirect('/PO');
    //     }
    // }
}
