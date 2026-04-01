<ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('resident*') ? 'active' : '' }}">
                <a href="/resident" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Penduduk</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('employee*') ? 'active' : '' }}">
                <a href="/employee" class="sidebar-link">
                    <i class="bi bi-file-person-fill"></i>
                    <span>Data Pegawai</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('kriteria*') ? 'active' : '' }}">
                <a href="/kriteria" class="sidebar-link">
                    <i class="bi bi-clipboard-fill"></i>
                    <span>Kriteria</span>
                </a>
            </li>


            <li
                class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-gear-wide-connected"></i>
                    <span>Proses</span>
                </a>

                <ul class="submenu ">

                    <li class="sidebar-item {{ request()->is('penilaian*') ? 'active' : '' }}">
                        <a href="/penilaian" class="sidebar-link">
                            <i class="bi bi-clipboard2-data-fill"></i>
                            <span>Penilaian</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('perhitungan*') ? 'active' : '' }}">
                        <a href="/perhitungan" class="sidebar-link">
                            <i class="bi bi-calculator-fill"></i>
                            <span>Perhitungan SAW</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Hasil</span>
                </a>

                <ul class="submenu ">
                    <li class="sidebar-item {{ request()->is('hasil*') ? 'active' : '' }}">
                        <a href="/hasil" class="sidebar-link">
                            <i class="bi bi-clipboard2-check-fill"></i>
                            <span>Hasil Rekomendasi</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('monitoring*') ? 'active' : '' }}">
                        <a href="/monitoring" class="sidebar-link">
                            <i class="bi bi-file-ruled-fill"></i>
                            <span>Monitoring Bantuan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ request()->is('report*') ? 'active' : '' }}">
                <a href="/report" class="sidebar-link">
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li
                class="sidebar-item  ">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-person-check-fill"></i>
                    <span>User Management</span>
                </a>
            </li>

        </ul>
