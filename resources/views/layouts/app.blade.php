<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partial.head')
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
            @include('layouts.partial.sidebar')
    </div>
    </div>
    <div id="main" class='layout-navbar navbar-fixed'>
        <header>

        @include('layouts.partial.navbar')
        </header>
        <div id="main-content">
            @yield('content')
        </div>

        @include('layouts.partial.footer')
    </div>
    </div>
    <script type="module" src="{{ asset('assets/static/js/components/sidebar.js') }}"></script>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', function() {

                    let id = this.dataset.id;
                    let nama = this.dataset.nama;

                    let periode_id = document.getElementById('periode').value;

                    document.getElementById('namaPenduduk').innerText = nama;

                    let tbody = document.getElementById('detailBody');
                    tbody.innerHTML = '<tr><td colspan="5">Loading...</td></tr>';

                    fetch(`/penilaian/detail-json/${id}?periode_id=${periode_id}`)
                        .then(res => {
                            if (!res.ok) throw new Error('Gagal mengambil data');
                            return res.json();
                        })
                        .then(data => {

                            let html = '';

                            if (!data || data.length === 0) {
                                html = '<tr><td colspan="5">Tidak ada data</td></tr>';
                            } else {
                                data.forEach(item => {

                                    let bukti = item.bukti_file ?
                                        `<a href="/storage/${item.bukti_file}" target="_blank">Lihat</a>` :
                                        '-';

                                    html += `
                                <tr>
                                    <td>${item.kriteria.nama_kriteria}</td>
                                    <td>${item.subkriteria.label_subkriteria}</td>
                                    <td>${item.nilai}</td>
                                    <td>${bukti}</td>
                                    <td>${item.catatan ?? '-'}</td>
                                </tr>
                            `;
                                });
                            }

                            tbody.innerHTML = html;
                        })
                        .catch(err => {
                            console.error(err);
                            tbody.innerHTML = '<tr><td colspan="5">Terjadi error</td></tr>';
                        });

                    let modalEl = document.getElementById('modalDetail');
                    let modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.show();
                });
            });

        });
    </script>

    {{--  TARUH MODAL DI SINI --}}
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
