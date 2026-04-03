<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partial.head')
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div class="sidebar-wrapper active" id="sidebar">
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

    {{-- 🔥 TARUH MODAL DI SINI --}}
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="/logout" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ready to Leave?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Apakah anda yakin ingin keluar?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
