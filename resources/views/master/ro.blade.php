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
        <div class="card-body">
            <div class="add-btn">
                <button type="button" class="btn-sm btn-success bold-text btn-new-item float-right" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    New RO
                </button>
            </div>

        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">No Receive Order</span></th>
                            <th class="thead-text"><span class="nowrap">Tanggal Penerimaan</span></th>
                            <th class="thead-text"><span class="nowrap">ID PO</span></th>
                            <th class="thead-text"><span class="nowrap">Received by</span></th>
                            <th class="thead-text"><span class="nowrap">Checked by</span></th>
                            <th class="thead-text"><span class="nowrap">Approved by</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>

                        </tr>
                    </thead>
                    <tbody>
                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($ro as $vals)
                        <tr>
                            <div class="d-none">
                                {{ $id = $vals['id'] }}
                            </div>
                            <td class="txt-center"><span class="nowrap">{{$iterator}}</span></td>
                            <td class="nowrap">{{ $vals['nomor_receive_order'] }}</td>
                            <td class="nowrap">{{ $vals['tanggal_penerimaan']}}</td>
                            <td class="nowrap text-right">{{ $vals['purchase_order_id']}}</td>
                            <td class="nowrap text-right">{{ $vals['received_by']}}</td>
                            <td class="nowrap text-right">{{ $vals['checked_by']}}</td>
                            <td class="nowrap text-right">{{ $vals['approved_by']}}</td>
                            <td>
                                <button type="button" class="btn-sm btn-primary btn-edit-item" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Item</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="/receive-order/edit">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row">
                                                        <input type="hidden" id="id" name="item_id" class="form-control"
                                                            value="{{$id}}">
                                                        <div class="col">
                                                            
                                                        </div>

                                                        <div class="col">

                                                            <div class="mt-5 float-right">
                                                                <button type="submit" class="btn btn-success">Edit
                                                                    Item</button>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <form method="post" action="/RO/delete">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" id="id" name="id" class="form-control" value="{{ $id }}">
                            <button type="submit" class="btn btn-danger">Yes</button>
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/receive-order/add">
                    @csrf
                    @method("POST")
                    <div class="row">
                        <div class="col">
                            
                            <div class="mb-3">
                                <label for="InputJenisItem" class="form-label">Tanggal Penerimaan</label>
                                <input type="text" name="tanggal_penerimaan" class="form-control" placeholder="YYYY/MM/DD">
                            </div>

                            <div class="mb-3">
                                <label for="InputFrameSub" class="form-label">Purchase Order</label>
                                <select name="purchase_order_id" class="form-control" id="">
                                    @foreach ($po as $val)
                                    <option value="" disabled selected hidden>Choose...</option>
                                    <option value="{{$val['id']}}">{{ $val['nomor_po'] }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="FrameCategory" class="form-label">Approved by</label>
                                <select type="number" name="approved_by" id="" class="form-control">
                                    @foreach ($employee as $val)
                                    <option value="" disabled selected hidden>Choose...</option>
                                    <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3 ">
                                <label for="InputDeskripsi" class="form-label">Received by</label>
                                <select type="number" name="received_by" id="" class="form-control">
                                    @foreach ($employee as $val)
                                    <option value="" disabled selected hidden>Choose...</option>
                                    <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="InputIndexBrand" class="form-label">Checked by</label>
                                <select type="number" name="checked_by" class="form-control" id="">
                                    @foreach ($employee as $val)
                                    <option value="" disabled selected hidden>Choose...</option>
                                    <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
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
</div>

@endsection
