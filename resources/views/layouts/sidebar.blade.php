<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="background-color: #4159AF;">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Home Page</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <li class="nav-item">
            <a class="nav-link {{ Request::is('kontrol') || Request::is('riwayat') ? '' : 'collapsed' }}" href="{{ route('kontrol.index') }}">
                <i class="bi bi-layout-text-window-reverse"></i><span>Kontrol</span></i>
            </a>

        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('pencatatan') ? '' : 'collapsed' }}" href="{{ route('pencatatan.index') }}">
                <i class="bi bi-bar-chart"></i><span>Pecatatan</span></i>
            </a>

        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('pemantauan') ? '' : 'collapsed' }}" href="{{ route('pemantauan.index') }}">
                <i class="bi bi-eyeglasses"></i><span>Pemantauan</span></i>
            </a>

        </li><!-- End Charts Nav -->
    </ul>

</aside><!-- End Sidebar-->