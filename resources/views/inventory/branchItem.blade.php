@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}
    
    <div class="card shadow mb-4">
        <div class="card-body black-text">
            <button type="button" class="btn-sm btn-success float-right bold-text" data-toggle="modal"
                data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                New Branch Item
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
                            <th class="thead-text"><span class="nowrap">Jenis Item</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Item</span></th>
                            <th class="thead-text"><span class="nowrap">Stok Global</span></th>
                            <th class="thead-text"><span class="nowrap">Stok Cabang</span></th>
                            <th class="thead-text"><span class="nowrap">Kode Cabang</span></th>
                            <th class="thead-text"><span class="nowrap">Nama Cabang</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($branch_item as $vals)
                        <tr>
                            <div class="d-none">
                                {{ $id = $vals['id'] }}
                                {{ $item_id = $vals['item_id'] }}
                                {{ $branch_id = $vals['branch_id']}}
                            </div>
                            <td class="txt-center">{{ $iterator }}</td>
                            <td class="nowrap">{{ $vals['jenis_item']}}</td>
                            <td class="nowrap">{{ $vals['kode_item']}}</td>
                            <td class="nowrap text-right">{{ $vals['stok_global']}}</td>
                            <td class="nowrap text-right">{{ $vals['stok_branch']}}</td>
                            <td class="nowrap">{{ $vals['kode_branch']}}</td>
                            <td class="nowrap">{{ $vals['nama_branch']}}</td>
                        </tr>
                        <div class="d-none">
                            {{ $iterator++}}
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
                    <form method="post" action="/branch-item/add">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col">
                                
                                <div class="mb-3">
                                    <label class="form-label">Cabang</label>
                                    <select class="form-control" name="branch_id">
                                        <option value="" hidden selected disabled>Select Branch</option>
                                        @foreach ($branch as $val)
                                        <option value="{{$val['id']}}">{{$val['nama_branch']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Barang</label>
                                    <select class="form-control" name="item_id">
                                        <option value="" hidden selected disabled>Select Item</option>
                                        @foreach ($item as $val)
                                        <option value="{{$val['id']}}">{{$val['jenis_item']}} - {{$val['kode_item']}}</option>
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
