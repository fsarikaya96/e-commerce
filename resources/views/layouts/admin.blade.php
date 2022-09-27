<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Majestic Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset("admin/vendors/mdi/css/materialdesignicons.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/vendors/base/vendor.bundle.base.css") }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset("admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css") }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset("admin/css/style.css") }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset("admin/images/favicon.png") }}"/>
    @livewireStyles
    @vite('resources/css/admin.css')
</head>
<body>
<div class="container-scroller">
@include('layouts.inc.admin.navbar')
<div class="container-fluid page-body-wrapper">
    @include('layouts.inc.admin.sidebar')

    <div class="main-panel">
        <div class="content-wrapper">
            @include('layouts.partials.alert')
            @yield('content')
        </div>
    </div>
</div>
</div>

<script src="{{ asset("admin/vendors/base/vendor.bundle.base.js") }}"></script>

<script src="{{ asset("admin/vendors/datatables.net/jquery.dataTables.js") }}"></script>
<script src="{{ asset("admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js") }}"></script>

<script src="{{ asset("admin/js/off-canvas.js") }}"></script>
<script src="{{ asset("admin/js/hoverable-collapse.js") }}"></script>

<script src="{{ asset("admin/js/template.js") }}"></script>

<script src="{{ asset("admin/js/dashboard.js") }}"></script>
<script src="{{ asset("admin/js/data-table.js") }}"></script>
<script src="{{ asset("admin/js/jquery.dataTables.js") }}"></script>
<script src="{{ asset("admin/js/dataTables.bootstrap4.js") }}"></script>
@vite('resources/js/admin.js')
@livewireScripts
</body>

</html>

