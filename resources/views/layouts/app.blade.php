<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partial.head')

    {{-- Tom Select --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        @include('layouts.partial.sidebar')
        <div id="main" class="layout-navbar">
            <header>

                @include('layouts.partial.navbar')
            </header>
            <div id="main-content">
                @yield('content')
            </div>

            @include('layouts.partial.footer')
        </div>
    </div>

    {{-- Tom Select --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

    {{-- <script type="module" src="{{ asset('assets/static/js/components/sidebar.js') }}"></script> --}}
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const sidebar = document.getElementById('sidebar');

            if (window.innerWidth < 1200 && sidebar) {
                sidebar.classList.remove('active');
            }

            document.querySelectorAll(
                '#sidebar .submenu-link, #sidebar .sidebar-item:not(.has-sub) .sidebar-link'
            ).forEach(link => {

                link.addEventListener('click', function() {

                    if (window.innerWidth < 1200) {
                        sidebar.classList.remove('active');
                    }

                });

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (window.innerWidth < 1200) {

                const sidebarWrapper = document.querySelector('.sidebar-wrapper');

                if (sidebarWrapper) {
                    sidebarWrapper.style.overflowY = 'auto';
                }

            }

        });
    </script>

    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>

    <script>
        let table = document.querySelector('#table1');
        if (table) {
            new simpleDatatables.DataTable(table);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /*
            |--------------------------------------------------------------------------
            | EVENT CLICK
            |--------------------------------------------------------------------------
            | Semua aksi klik pada halaman ditangani di sini.
            | - btn-detail  : Membuka modal detail penilaian
            | - btn-preview : Membuka modal preview bukti
            |--------------------------------------------------------------------------
            */
            document.addEventListener('click', function(e) {

                /*
                |--------------------------------------------------------------------------
                | PREVIEW BUKTI
                |--------------------------------------------------------------------------
                | Saat tombol "Lihat" pada kolom Bukti diklik,
                | tampilkan gambar atau PDF ke dalam modal preview.
                |--------------------------------------------------------------------------
                */
                const previewButton = e.target.closest('.btn-preview');

                if (previewButton) {

                    e.preventDefault();

                    const file = previewButton.dataset.file;
                    const title = previewButton.dataset.title;

                    // Judul modal mengikuti nama kriteria
                    document.getElementById('previewTitle').innerText = title;

                    const previewContainer = document.getElementById('previewContainer');

                    // Ambil ekstensi file
                    const ext = file.split('.').pop().toLowerCase();

                    /*
                    |--------------------------------------------------------------------------
                    | Preview Gambar
                    |--------------------------------------------------------------------------
                    */
                    if (['jpg', 'jpeg', 'png', 'webp'].includes(ext)) {

                        previewContainer.innerHTML = `
                    <img
                        src="${file}"
                        class="img-fluid rounded shadow-sm"
                        alt="Bukti Penilaian">
                `;

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Preview PDF
                    |--------------------------------------------------------------------------
                    */
                    else if (ext === 'pdf') {

                        previewContainer.innerHTML = `
                    <iframe
                        src="${file}"
                        width="100%"
                        height="650"
                        style="border:none;">
                    </iframe>
                `;

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | File selain gambar & PDF
                    |--------------------------------------------------------------------------
                    */
                    else {

                        previewContainer.innerHTML = `
                    <a
                        href="${file}"
                        target="_blank"
                        class="btn btn-primary">

                        <i class="bi bi-download me-1"></i>

                        Download File

                    </a>
                `;

                    }

                    // Tampilkan modal preview
                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('modalPreview')
                    ).show();

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | DETAIL PENILAIAN
                |--------------------------------------------------------------------------
                | Saat tombol mata diklik, ambil data detail penilaian
                | menggunakan AJAX kemudian tampilkan ke modal detail.
                |--------------------------------------------------------------------------
                */
                const button = e.target.closest('.btn-detail');

                if (!button) return;

                const id = button.dataset.id;
                const nama = button.dataset.nama;

                // Ambil periode yang sedang dipilih
                const periode_id = document.getElementById('periode').value;

                // Tampilkan nama penduduk
                document.getElementById('namaPenduduk').innerText = nama;

                // Loading sementara
                const tbody = document.getElementById('detailBody');

                tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center">
                    Loading...
                </td>
            </tr>
        `;

                /*
                |--------------------------------------------------------------------------
                | AJAX Ambil Detail Penilaian
                |--------------------------------------------------------------------------
                */
                fetch(`/penilaian/detail-json/${id}?periode_id=${periode_id}`)

                    .then(res => {

                        if (!res.ok)
                            throw new Error('Gagal mengambil data');

                        return res.json();

                    })

                    .then(data => {

                        let html = '';

                        if (!data || data.length === 0) {

                            html = `
                        <tr>
                            <td colspan="5" class="text-center">
                                Tidak ada data
                            </td>
                        </tr>
                    `;

                        } else {

                            data.forEach(item => {

                                /*
                                |--------------------------------------------------------------------------
                                | Tombol Lihat Bukti
                                |--------------------------------------------------------------------------
                                */
                                let bukti = '-';

                                if (item.bukti_file) {

                                    bukti = `
                                <button
                                    type="button"
                                    class="btn btn-link btn-sm p-0 btn-preview"

                                    data-file="/storage/${item.bukti_file}"

                                    data-title="${item.kriteria.nama_kriteria}">

                                    Lihat

                                </button>
                            `;

                                }

                                html += `
                            <tr>

                                <td>
                                    ${item.kriteria.nama_kriteria}
                                </td>

                                <td>
                                    ${item.subkriteria.label_subkriteria}
                                </td>

                                <td class="text-center">
                                    ${item.nilai}
                                </td>

                                <td class="text-center">
                                    ${bukti}
                                </td>

                                <td>
                                    ${item.catatan ?? '-'}
                                </td>

                            </tr>
                        `;

                            });

                        }

                        tbody.innerHTML = html;

                    })

                    .catch(err => {

                        console.error(err);

                        tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-danger">
                            Terjadi kesalahan saat mengambil data.
                        </td>
                    </tr>
                `;

                    });

                /*
                |--------------------------------------------------------------------------
                | Tampilkan Modal Detail
                |--------------------------------------------------------------------------
                */
                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById('modalDetail')
                ).show();

            });


            /*
            |--------------------------------------------------------------------------
            | Reset Modal Preview
            |--------------------------------------------------------------------------
            | Menghapus isi preview ketika modal ditutup
            | agar gambar/PDF tidak tetap termuat di browser.
            |--------------------------------------------------------------------------
            */
            document.getElementById('modalPreview')
                .addEventListener('hidden.bs.modal', function() {

                    document.getElementById('previewContainer').innerHTML = '';

                    document.getElementById('previewTitle').innerText = 'Bukti Penilaian';

                });

        });

        /*
        |--------------------------------------------------------------------------
        | Konfirmasi Edit
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function(e) {

            const btn = e.target.closest('.btn-edit-confirm');

            if (!btn) return;

            document
                .getElementById('btnLanjutEdit')
                .href = btn.dataset.url;

            bootstrap.Modal
                .getOrCreateInstance(
                    document.getElementById('modalEditConfirm')
                )
                .show();

        });

        /*
        |--------------------------------------------------------------------------
        | Konfirmasi Hapus
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function(e) {

            const btn = e.target.closest('.btn-delete-confirm');

            if (!btn) return;

            const targetModal = btn.dataset.target;

            document.getElementById('btnLanjutDelete').onclick = function() {

                // Tutup modal konfirmasi
                bootstrap.Modal
                    .getInstance(document.getElementById('modalDeleteConfirm'))
                    .hide();

                // Buka modal hapus asli
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.querySelector(targetModal)
                    )
                    .show();

            };

            bootstrap.Modal
                .getOrCreateInstance(
                    document.getElementById('modalDeleteConfirm')
                )
                .show();

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
