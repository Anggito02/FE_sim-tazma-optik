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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-glasses"></i>
                </div>
                <div class="sidebar-brand-text mx-3">TAZMA OPTIK</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-database"></i>
                    <span>Master Module</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Business Sheet:</h6>
                        <a class="collapse-item" href="/employee">Employees Information</a>
                        <a class="collapse-item" href="/branch">Branches Information</a>
                        <a class="collapse-item" href="/vendors">Vendors Information</a>
                        <h6 class="collapse-header">Master Sheet:</h6>
                        <a class="collapse-item" href="/brand">Brands Information</a>
                        <a class="collapse-item" href="/color">Colors Information</a>
                        <a class="collapse-item" href="/lens-category">Lens Information</a>
                        <a class="collapse-item" href="/frame-category">Frame Information</a>
                        <a class="collapse-item" href="/index">Index Information</a>
                        <a class="collapse-item" href="/item">Item Information</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-cart-flatbed-suitcase"></i>
                    <span>Purchase Module</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Purchase Sheet:</h6>
                        <a class="collapse-item" href="/PO">PO (Purchase Order)</a>
                        <!-- <a class="collapse-item" href="/receive-order">RO (Receive Order)</a> -->
                        {{-- <a class="collapse-item" href="">Inventory Information</a>
                        <a class="collapse-item" href="">Invoice Information</a> --}}
                        {{-- <a class="collapse-item" href="">QR Code Generator</a>
                        <a class="collapse-item" href="">Monitoring Purchase</a> --}}
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventory"
                    aria-expanded="true" aria-controls="inventory">
                    <i class="fa-solid fa-truck-moving"></i>
                    <span>Inventory Module</span>
                </a>
                <div id="inventory" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Inventory Sheet:</h6>
                        <a class="collapse-item" href="/item-outgoing">Item Outgoing</a>
                        <a class="collapse-item" href="/branch-item">Branch Item</a>
                        <a class="collapse-item" href="/stock-opname-master/all">Stock Opname</a>
                    </div>
                </div>
            </li>

            <!-- Sales -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>SALES</span>
                </a>
                <div id="sales" class="collapse" aria-labelledby="sales"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sales Sheet:</h6>
                        <a class="collapse-item" href="/sales/kasir">Kasir</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="float-left black-text">
                        @if (url('/dashboard') == url()->current())
                            <h5>DASHBOARD</h5>
                        @elseif (url('/user') == url()->current())
                            <h5>USER SHEET INFORMATION</h5>
                        @elseif (url('/vendors') == url()->current())
                            <h5>VENDOR SHEET INFORMATION</h5>
                        @elseif (url('/color') == url()->current())
                            <h5>COLOUR SHEET INFORMATION</h5>
                        @elseif ( url('/employee') == url()->current())
                            <h5>EMPLOYEE SHEET INFORMATION</h5>
                        @elseif (url('/brand') == url()->current())
                            <h5>BRAND SHEET INFORMATION</h5>
                        @elseif (url('/branch') == url()->current())
                            <h5>BRANCH SHEET INFORMATION</h5>
                        @elseif (url('/lens-category') == url()->current())
                            <h5>LENS CATEGORY SHEET INFORMATION</h5>
                        @elseif (url('/frame-category') == url()->current())
                            <h5>FRAME CATEGORY SHEET INFORMATION</h5>
                        @elseif (url('/index') == url()->current())
                            <h5>INDEX SHEET INFORMATION</h5>
                        @elseif (url('/preorder') == url()->current())
                            <h5>PRE-ORDER SHEET INFORMATION</h5>
                        @elseif (url('/receiveorder') == url()->current())
                            <h5>RECEIVE-ORDER SHEET INFORMATION</h5>
                        @elseif (url('/coa') == url()->current())
                            <h5>COA SHEET INFORMATION</h5>
                        @elseif (url('/item') == url()->current())
                            <h5>ITEM SHEET INFORMATION</h5>
                        @elseif (url('/PO') == url()->current())
                            <h5>PO SHEET INFORMATION</h5>
                        @elseif (url('/item-outgoing') == url()->current())
                            <h5>ITEM OUTGOING SHEET INFORMATION</h5>
                        @endif
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline black-text small">damas</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

            <!-- Footer -->
            @if (url('/sales/kasir') != url()->current())
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Tazma Optik 2023</span>
                    </div>
                </div>
            </footer>
            @endif
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
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
