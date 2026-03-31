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
                    <i class="bi bi-people"></i>
                    <span>Data Penduduk</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('kriteria*') ? 'active' : '' }}">
                <a href="/kriteria" class="sidebar-link">
                    <i class="bi bi-clipboard"></i>
                    <span>Kriteria</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('penilaian*') ? 'active' : '' }}">
                <a href="/penilaian" class="sidebar-link">
                    <i class="bi bi-clipboard2-data"></i>
                    <span>Penilaian</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('perhitungan*') ? 'active' : '' }}">
                <a href="/perhitungan" class="sidebar-link">
                    <i class="bi bi-calculator"></i>
                    <span>Perhitungan SAW</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('hasil*') ? 'active' : '' }}">
                <a href="/hasil" class="sidebar-link">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Hasil Rekomendasi</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('monitoring*') ? 'active' : '' }}">
                <a href="/monitoring" class="sidebar-link">
                    <i class="bi bi-file-ruled"></i>
                    <span>Monitoring Bantuan</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('report*') ? 'active' : '' }}">
                <a href="/report" class="sidebar-link">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <li
                class="sidebar-item  ">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-person-check"></i>
                    <span>User Management</span>
                </a>
            </li>

        </ul>
