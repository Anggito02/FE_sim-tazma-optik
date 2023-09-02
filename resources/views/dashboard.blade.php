@extends('layout')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1 class="h3 mb-4 text-gray-800">Selamat Datang di Tazma Optik</h1>
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    @foreach ($data as $val)
                    <p>
                        {{$val}}
                    </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
