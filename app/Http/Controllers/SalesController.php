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
        // print_r($this->response_user_info['data']['id']);
        // $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-orderWith/info/all', $api_request);
        // $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_employee_one = Http::withHeaders($this->headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/one', $api_request_employee_one);
        $response_sales_master =Http::withHeaders($this->headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/one/id', $sales_master);
        // $response_kas = Http::withHeaders($this->headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request);
        
        // $po = $response->json();
        // $employee = $response_employee->json();
        // $vendor = $response_vendor->json();
        // $user = GetUserInfo::getUserInfo();
        $kas['data']="hallo";
        // $kas['data']=NULL;
        return view('sales.kasir', [
            // 'po' => $po['data'],
            // 'data' => $user['data'],
            // 'employee' => $employee['data'],
            'response_employee_one' => $response_employee_one['data'],
            'response_sales' => $response_sales_master,
            // 'response_kas' => $response_kas['data'],
            'kas' => $kas['data'],
            'user_info' => $this->response_user_info,
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
    public function findSalesMaster(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        if($request->nomor_transaksi!=0){
            $data_fillter=[
                "page"=> 1,
                "limit"=> 10,
                "nomor_transaksi"=> $request->nomor_transaksi
            ];
        }else{
            $data_fillter=[
                "page"=> 1,
                "limit"=> 10,
            ];
        }
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/sales-master/all', $data_fillter);
        return response()->json($response->json());
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
        // print_r($api_request);
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
