<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TAZMA</title>
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery-3.6.4.min.js')}}"></script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.fixedColumns.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendor/select2/select2.js')}}"></script>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/support-index.css')}}" rel="stylesheet">

    <!-- datatables bootstrap 4 -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    {{-- <!-- <link href="{{ asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet"> --> --}}
</head>

<body class="bg-light">
    <div class="header-page">
        <div class="page-top p-5">
            <div class="d-flex justify-content-between">
                <div class="left">
                    <h1>Tazma Optik</h1>
                </div>
                <div class="right">
                    <div class="d-flex mr-3">
                        <div class="pr-2">
                            <h2 class="text-right">Tanggal</h2>
                            <h2 class="text-left">20 Agu 2023</h2>
                        </div>
                        <div class="vr"></div>
                        <div class="pl-2">
                            <h2>Kasir</h2>
                            <h2>Toni</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="break-line"></div>
    </div>

    <div class="middle-page mt-1">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <div class="">
                                    <i class="fa-solid fa-circle-plus" style="color: #9AC5F4;"></i>
                                </div>
                                <div class="mr-auto pl-2">
                                    <p class=""><strong>TAMBAH ITEM</strong><span style="color: #9AC5F4">(F1)</span></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <p class="text-secondary">Rp. 0</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="m-5">
                        <div class="">
                            <div class="">
                                <h5><strong style="color: #9AC5F4">Total</strong></h5>
                            </div>
                            <div class="mt-5">
                                <h1 class="text-right">Rp. 0</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-page mt-1">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="table-responsive">
                        <div class="table table-bordered table-striped" id="data_item_table_1" width="100%" cellspacing="0">
                            <div class="thead-color txt-center">
                                <tr style="white-space: nowrap;"></tr>
                            </div>
                        </div>
                    </div>
                    <div class=""></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
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
        $(document).ready(function () {
            $(".select2").select2();
        });

    </script>
</body>

</html>
