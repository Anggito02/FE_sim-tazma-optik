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
    <script src="{{ asset('vendor/jquery/chosen.jquery.min.js')}}"></script>
    <style>
    @media print {
        
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: none;
            color: #000; /* Warna teks untuk mencetak */
        }

        @page {
            size: 10.5cm 1.9cm; /* Atur ukuran kertas */
            margin: 0 mm 1.5mm;
            padding:1 mm 1 mm;
        }

        .container, .page-content {
            page-break-inside: avoid;
            margin: 0;
            width: auto;
            overflow: visible !important;
        }

        #qrcode {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            margin-left: 5mm;
            padding: 1mm; /* Menambahkan padding di sekitar QR code */
            display: block; /* Memastikan QR code ditampilkan sebagai block untuk menambahkan padding */
        }
        
        
    }
   

</style>


</head>
<body>
    <div class="container" >
        <div class="row" id="qrcode"> <!-- Memastikan ada row untuk wrap kolom -->
                &nbsp;
                {{ QrCode::size(70)->generate($qr_pod['kode_qr_po_detail']) }}
                <span style="font-size: 24px; font-weight: bold; color: black;">|</span>
                <span style="font-size: 9px; font-weight: bold; color: black; width: 1.6cm; flex; align-items: center; justify-content: center; display: inline-block; white-space: normal; word-wrap: word-wrap: break-word; text-align: center; margin: 1mm; margin-right: 1cm">{{$qr_pod['kode_qr_po_detail']}} {{$qr_pod['kode_item']}} <?php echo "Rp.".number_format($qr_pod['harga_jual_satuan'],0,",","."); ?></span>
                {{ QrCode::size(70)->generate($qr_pod['kode_qr_po_detail']) }}
                <span style="font-size: 24px; font-weight: bold; color: black;">|</span>
                <span style="font-size: 9px; font-weight: bold; color: black; width: 1.6cm; flex; align-items: center; justify-content: center; display: inline-block; white-space: normal; word-wrap: word-wrap: break-word; text-align: center; margin: 1mm; margin-right: 1cm">{{$qr_pod['kode_qr_po_detail']}} {{$qr_pod['kode_item']}} <?php echo "Rp.".number_format($qr_pod['harga_jual_satuan'],0,",","."); ?></span>
                {{ QrCode::size(70)->generate($qr_pod['kode_qr_po_detail']) }}
                <span style="font-size: 24px; font-weight: bold; color: black;">|</span>
                <span style="font-size: 9px; font-weight: bold; color: black; width: 1.6cm; flex; align-items: center; justify-content: center; display: inline-block; white-space: normal; word-wrap: word-wrap: break-word; text-align: center; margin: 1mm; margin-right: 1cm">{{$qr_pod['kode_qr_po_detail']}} {{$qr_pod['kode_item']}} <?php echo "Rp.".number_format($qr_pod['harga_jual_satuan'],0,",","."); ?></span>

        </div>
    </div>
    {{-- <!-- <div class="container mt-5" style="position: relative; height: 100vh;">
        <div id="qrcode" style="max-width: 100%; height: auto;">
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
    </div> -->

        <!-- <script src="{{ asset('vendor\jquery\jquery.min.js')}}"></script> --> --}}

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