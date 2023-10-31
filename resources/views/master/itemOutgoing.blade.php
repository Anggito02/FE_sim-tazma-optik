@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body black-text">
            <button type="button" class="btn-sm btn-success float-right bold-text" data-toggle="modal"
                data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                New Item Outgoing
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">WARNA SHEET</h6>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Nomor Outgoing</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Outgoing</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Pengiriman</span></th>
                            <th class="thead-text"><span class="nowrap">Branch</span></th>
                            <th class="thead-text"><span class="nowrap">Known By</span></th>
                            <th class="thead-text"><span class="nowrap">Checked By</span></th>
                            <th class="thead-text"><span class="nowrap">Approved By</span></th>
                            <th class="thead-text"><span class="nowrap">Delivered By</span></th>
                            <th class="thead-text"><span class="nowrap">Received By</span></th>
                            <th class="thead-text"><span class="nowrap">Details</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>

                        </tr>
                    </thead>
                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($item_outgoing as $vals)
                        <tr>
                            <div class="d-none">
                                {{ $id = $vals['id'] }}
                            </div>
                            <td class="txt-center">{{$iterator}}</td>
                            <td class="nowrap">{{$vals['nomor_outgoing']}}</td>
                            <td class="nowrap">{{$vals['tanggal_outgoing']}}</td>
                            <td class="nowrap">{{$vals['tanggal_pengiriman']}}</td>
                            <td class="nowrap">{{$vals['nama_branch']}}</td>
                            <td class="nowrap">{{$vals['known_by_name']}}</td>
                            <td class="nowrap">{{$vals['checked_by_name']}}</td>
                            <td class="nowrap">{{$vals['approved_by_name']}}</td>

                            @if ($vals['delivered_by'] == null)
                            <td class="nowrap text-danger">Belum Dikirim</td>
                            @else
                            <td class="nowrap">{{$vals['delivered_by_name']}}</td>
                            @endif

                            @if ($vals['received_by'] == null)
                            <td class="nowrap text-danger">Belum Diterima</td>
                            @else
                            <td class="nowrap">{{$vals['received_by_name']}}</td>
                            @endif
                            <td>
                                <a href="/item-outgoing/detail/{{ $vals['id'] }}">
                                    <button type="button" class="btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                
                            
                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Edit Data
                                                    Item Outgoing</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <form method="post" action="/item-outgoing/edit">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" name="id" value="{{$vals['id']}}">
                                                            <div class="mb-3">
                                                                {{-- <label for="InputTanggal" class="form-label">Tanggal Pengiriman</label>
                                                                <input type="text" id="id" name="tanggal_pengiriman" class="form-control" value="{{$vals['tanggal_pengiriman']}}"> --}}
                                                                <label for="InputLastDateSupply" class="form-label">Tanggal Pengiriman</label>
                                                                <div>
                                                                    <input type="date" id="id" name="tanggal_pengiriman" class="form-control" value="{{$vals['tanggal_pengiriman']}}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label class="form-label">Branch</label>
                                                                <select class="form-control" name="branch_id">
                                                                    <option value="{{$vals['branch_id']}}" selected>{{$vals['nama_branch']}}</option>
                                                                    @foreach ($branch as $branchVal)
                                                                    <option value="{{$branchVal['id']}}">{{$branchVal['nama_branch']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Known By</label>
                                                                <select class="form-control" name="known_by">
                                                                    <option value="{{$vals['known_by']}}" selected>{{$vals['known_by_name']}}</option>
                                                                    @foreach ($employee as $employeeVal)
                                                                    <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Checked By</label>
                                                                <select class="form-control" name="checked_by">
                                                                    <option value="{{$vals['checked_by']}}" selected>{{$vals['checked_by_name']}}</option>
                                                                    @foreach ($employee as $employeeVal)
                                                                    <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        
                                                        </div>
                                                        
                                                        <div class="col">

                                                            <div class="mb-3">
                                                                <label class="form-label">Approved By</label>
                                                                <select class="form-control" name="approved_by">
                                                                    <option value="{{$vals['approved_by']}}" selected>{{$vals['approved_by_name']}}</option>
                                                                    @foreach ($employee as $employeeVal)
                                                                    <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Delivered By</label>
                                                                <select class="form-control" name="delivered_by">
                                                                    <option value="{{$vals['delivered_by']}}" selected>{{$vals['delivered_by_name']}}</option>
                                                                    @foreach ($employee as $employeeVal)
                                                                    <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Received By</label>
                                                                <select class="form-control" name="received_by">
                                                                    <option value="{{$vals['received_by']}}" selected>{{$vals['received_by_name']}}</option>
                                                                    @foreach ($employee as $employeeVal)
                                                                    <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="mt-5 float-right">
                                                                <button type="submit"
                                                                    class="btn-sm btn-success bold-text mb-3">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                    data-target="#exampleModalCenterDelete{{$id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                

                                <!-- Modal Delete Data -->
                                <div class="modal fade" id="exampleModalCenterDelete{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Delete
                                                    Item Outgoing</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <p>Are you sure you want to delete?</p>
                                            </div>
                                            <div class="modal-footer black-text">

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <form method="post" action="/item-outgoing/delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" name="id" value="{{$vals['id']}}">
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        <div class="d-none">
                            {{ $iterator++ }}
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Data -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title black-text" id="exampleModalLongTitle">New Item Outgoing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body black-text">
                    <form method="post" action="/item-outgoing/add">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col">
                                
                                <div class="mb-3">
                                    {{-- <label for="InputTanggal" class="form-label">Tanggal Pengiriman</label>
                                    <input type="text" id="id" name="tanggal_pengiriman" class="form-control" placeholder="YYYY-MM-DD"> --}}
                                    <label for="InputLastDateSupply" class="form-label">Tanggal Pengiriman</label>
                                    <div><input type="date" id="id" name="tanggal_pengiriman" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Branch</label>
                                    <select class="form-control" name="branch_id">
                                        <option value="" hidden selected disabled>Select Branch</option>
                                        @foreach ($branch as $branchVal)
                                        <option value="{{$branchVal['id']}}">{{$branchVal['nama_branch']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Known By</label>
                                    <select name="known_by" class="form-control">
                                        <option value="" hidden selected disabled>Select Employee</option>
                                        @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                
                                
                            </div>
                            
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Checked By</label>
                                    <select name="checked_by" class="form-control">
                                        <option value="" hidden selected disabled>Select Employee</option>
                                        @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <select name="approved_by" class="form-control">
                                        <option value="" hidden selected disabled>Select Employee</option>
                                        @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Delivered By</label>
                                    <select name="delivered_by" class="form-control">
                                        <option value="" hidden selected disabled>Select Employee</option>
                                        @foreach ($employee as $employeeVal)
                                        <option value="{{$employeeVal['id']}}">{{$employeeVal['employee_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mt-5 float-right">
                                    <button type="submit" class="btn btn-success">Add new</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
