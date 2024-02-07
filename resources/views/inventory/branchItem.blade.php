@extends('layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}
    
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
                            <td class="txt-center nowrap">{{ $vals['jenis_item']}}</td>
                            <td class="txt-center nowrap">{{ $vals['kode_item']}}</td>
                            <td class="nowrap text-right">{{ $vals['stok_global']}}</td>
                            <td class="nowrap text-right">{{ $vals['stok_branch']}}</td>
                            <td class="txt-center nowrap">{{ $vals['kode_branch']}}</td>
                            <td class="txt-center nowrap">{{ $vals['nama_branch']}}</td>
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
</div>
@endsection
