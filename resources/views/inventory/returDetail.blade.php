@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="mb-4">
        <a href="/retur"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between p-5 black-text">
                <div class="d-flex flex-column">
                    <h3>Nomor Retur:</h3>
                    <h3>{{$retur['nomor_retur']}}</h3>
                    <h3><br></h3>
                    <h3>Tanggal Retur:</h3>
                    <h3>{{$retur['tanggal_retur']}}</h3>
                    <h3><br></h3>
                    <h3>Tanggal Pengiriman:</h3>
                    <h3>{{$retur['tanggal_pengiriman']}}</h3>
                </div>
                <div class="d-flex flex-column align-items-end">
                    {{-- <p>Known By: {{$retur['known_by_name']}}</p> --}}
                    <p>Checked By: {{$retur['checked_by_name']}}</p>
                    <p>Approved By: {{$retur['approved_by_name']}}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between p-5 black-text">
                <div class="d-flex flex-column">
                    <h3>Kode Cabang - Nama Cabang:</h3>
                    <h3>{{$retur['kode_branch']}} - {{$retur['nama_branch']}}</h3>
                </div>

                <div class="d-flex flex-column align-items-end"> 
                    <p>Delivered By: {{$retur['delivered_by_name']}}</p>
                    @if ($retur['received_by'] == 0)
                    <p>Received By: <span class="badge badge-danger">Belum Diterima</span></p>
                    @else
                    <p>Received By: {{$retur['received_by_name']}}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">WARNA SHEET</h6>
        </div> -->

        <div class="card-body">
            <button type="button" class="btn-sm btn-success float-right bold-text mb-3" data-toggle="modal"
                data-target="#exampleModalCenter"><i class="fa-solid fa-pencil"></i>
                Add Retur 
            </button>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-color txt-center">
                        <tr>
                            <th class="thead-text"><span class="nowrap">No</span></th>
                            <th class="thead-text"><span class="nowrap">Jumlah yang dikirimkan</span></th>
                            <th class="thead-text"><span class="nowrap">Waktu Verifikasi</span></th>
                            <th class="thead-text"><span class="nowrap">Status Verifikasi</span></th>
                            <th class="thead-text"><span class="nowrap">Diverifikasi oleh</span></th>
                            <th class="thead-text"><span class="nowrap">Item</span></th>
                            <th class="thead-text"><span class="nowrap">Verifikasi</span></th>
                            <th class="thead-text"><span class="nowrap">Edit</span></th>
                            <th class="thead-text"><span class="nowrap">Delete</span></th>

                        </tr>
                    </thead>
                    <tbody>

                        <div class="d-none">
                            {{ $iterator = 1 }}
                        </div>
                        @foreach ($retur_detail as $valIod)
                        <tr>
                            <td class="txt-center">{{ $iterator }}</td>
                            <td class="nowrap text-right">{{ $valIod['delivered_qty'] }}</td>
                            <td class="nowrap text-right">{{ $valIod['verified_at'] }}</td>
                            @if ($valIod['verified_status'] == 0)
                            <td class="nowrap text-center text-danger">Unverified</td>
                            @elseif ($valIod['verified_status'] == 1)
                            <td class="nowrap text-center text-success">Verified</td>
                            @endif
                            <td class="nowrap text-center">{{ $valIod['verified_by_nama'] }}</td>
                            <td class="nowrap text-right">{{ $valIod['kode_item'] }}</td>
                            <td>
                                @if ($valIod['verified_status'] == 1)
                                <button class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-square-check"></i>
                                </button>
                                @elseif ($valIod['verified_status'] == 0)
                                <button type="button" class="btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModalCenterVerify{{$valIod['id']}}">
                                    <i class="fa fa-square-check"></i>
                                </button>
                                @endif

                                <!-- Modal Verify Data -->
                                <div class="modal fade" id="exampleModalCenterVerify{{$valIod['id']}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Verify
                                                    Data Retur</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <p>Apakah data berikut sudah benar?</p>
                                                <p>Jumlah yang dikirim: {{$valIod['delivered_qty']}}</p>
                                                <p>Diverifikasi Oleh: {{$valIod['verified_by_nama']}}</p>
                                                <p>Barang: {{$valIod['kode_item']}} - {{$valIod['jenis_item']}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/retur/detail/verify" method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    <input type="hidden" name="id" value="{{$valIod['id']}}">
                                                    <input type="hidden" name="retur_id" value="{{$valIod['retur_id']}}">
                                                    <input type="hidden" name="delivered_qty" value="{{$valIod['delivered_qty']}}">
                                                    <input type="hidden" name="item_id" value="{{$valIod['item_id']}}">
                                                    <input type="hidden" name="retur_id" value="{{$valIod['retur_id']}}">
                                                    <button type="submit" class="btn btn-success">Yes</button>

                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($valIod['verified_status'] == 1)
                                <button class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-edit"></i>
                                </button>
                                @elseif ($valIod['verified_status'] == 0)
                                <button type="button" class="btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenterEdit{{$valIod['id']}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                @endif

                                <!-- Modal Update Data -->
                                <div class="modal fade" id="exampleModalCenterEdit{{$valIod['id']}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Edit Data
                                                    Retur</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body black-text">
                                                <form method="post" action="/retur/detail/edit">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="row">
                                                        <div class="col">
                                                            
                                                            <input type="hidden" name="id" value="{{$valIod['id']}}">
                                                            <input type="hidden" name="retur_id" value="{{$valIod['retur_id']}}">
                                                            <div class="mb-3">
                                                                <label class="form-label">Jumlah yang dikirimkan</label>
                                                                <input type="number" class="form-control" name="delivered_qty" value="{{$valIod['delivered_qty']}}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Item</label>
                                                                <select name="item_id" class="form-control">
                                                                    <option value="{{$valIod['item_id']}}" hidden selected>{{$valIod['kode_item']}} - {{$valIod['jenis_item']}}</option>
                                                                    @foreach ($item as $val)
                                                                    <option value="{{$val['id']}}">{{$val['kode_item']}} - {{$val['jenis_item']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label">Verified By</label>
                                                                <select name="verified_by" class="form-control">
                                                                    <option value="{{$valIod['verified_by']}}" hidden selected>{{$valIod['verified_by_nama']}}</option>
                                                                    @foreach ($employee as $val)
                                                                    <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mt-5 float-right">
                                                                <button type="submit" class="btn btn-primary">Update</button>
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
                                @if ($valIod['verified_status'] == 1)
                                <button class="btn-sm btn-secondary" disabled>
                                    <i class="fa fa-trash"></i>
                                </button>
                                @elseif ($valIod['verified_status'] == 0)
                                <button type="button" class="btn-sm btn-danger" data-toggle="modal"
                                    data-target="#exampleModalCenterDelete{{$valIod['id']}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @endif

                                <!-- Modal Delete Data -->
                                <div class="modal fade" id="exampleModalCenterDelete{{$valIod['id']}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title black-text" id="exampleModalLongTitle">Delete
                                                    Data Retur</h5>
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

                                                <form method="post" action="/retur/detail/delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" name="id" value="{{$valIod['id']}}">
                                                    <input type="hidden" name="retur_id" value="{{$valIod['retur_id']}}">
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="d-none">
                            {{ $iterator = $iterator + 1 }}
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
                    <h5 class="modal-title black-text" id="exampleModalLongTitle">New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body black-text">
                    <form method="post" action="/retur/detail/add">
                        @csrf
                        @method("POST")
                        <div class="row">
                            <div class="col">

                                <input type="hidden" name="retur_id" value="{{$retur['id']}}">
                                
                                <div class="mb-3">
                                    <label class="form-label">Jumlah yang dikirimkan</label>
                                    <input type="number" name="delivered_qty" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Verified By</label>
                                    <select name="verified_by" class="form-control">
                                        @foreach ($employee as $val)
                                        <option disabled selected hidden>Select Employee</option>
                                        <option value="{{$val['id']}}">{{$val['employee_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Item</label>
                                    <select name="item_id" class="form-control">
                                        @foreach ($item as $val)
                                        <option disabled selected hidden>Select Item</option>
                                        <option value="{{$val['id']}}">{{$val['kode_item']}} - {{$val['jenis_item']}}</option>
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
