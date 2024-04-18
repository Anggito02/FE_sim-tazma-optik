<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TAZMA OPTIK</title>

    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery-3.6.4.min.js')}}"></script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.fixedColumns.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendor/select2/select2.js')}}"></script>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/support-index.css')}}" rel="stylesheet">

    <!-- datatables bootstrap 4 -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- Menambahkan CSS Chosen -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <!-- Menambahkan JavaScript Chosen -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>


</head>
<body>
    <div class="container mt-5">
        <div id="qrcode">
            <div class="d-flex flex-column align-items-center">
                <div class="mb-4">
                    {{ QrCode::size(250)->generate($qr_pod['kode_qr_po_detail']) }}
                </div>
                <div class="mb-1">
                    <p class="black-text">{{$qr_pod['kode_item']}}</p>
                </div>
                <div class="mb-3">
                    <p class="black-text">{{$qr_pod['kode_qr_po_detail']}}</p>
                </div>
            </div>
        </div>
    </div>

        <!-- <script src="{{ asset('vendor\jquery\jquery.min.js')}}"></script> -->

        <script src="{{ asset('vendor\bootstrap\js\bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor\jquery-easing\jquery.easing.min.js')}}"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js\sb-admin-2.min.js')}}"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('js\support.js')}}"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".select2").select2();
            });
        </script>
    
</body>
</html>