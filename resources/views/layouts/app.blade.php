<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partial.head')
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div class="sidebar-wrapper active" id="sidebar">
            <div class="sidebar-header position-relative">
                @include('layouts.partial.sidebarheader')
            </div>
            <div class="sidebar-menu">
                @include('layouts.partial.sidebar')
            </div>
        </div>
    </div>
    <div id="main" class='layout-navbar navbar-fixed'>

        @include('layouts.partial.navbar')

        <div id="main-content">
            @yield('content')
        </div>

        @include('layouts.partial.footer')
    </div>
    </div>
    <script src="{{ asset('assets/static/js/components/sidebar.js') }}"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>

    <script>
        let table = document.querySelector('#table1');
        if (table) {
            new simpleDatatables.DataTable(table);
        }
    </script>

</body>

</html>
