<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('home') }}">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">SIA Maxxima</span>
    </a>
</div>
<hr class="horizontal dark mt-0">
<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Route::is('siswa.*') ? 'active' : '' }}" href="{{ route('siswa.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">SISWA</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('matpel.*') ? 'active' : '' }}" href="{{ route('matpel.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">MATA PELAJARAN</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('ujian.*') ? 'active' : '' }}" href="{{ route('ujian.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">UJIAN</span>
            </a>
        </li>
    </ul>
</div>
<div class="sidenav-footer mx-3 ">
    <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="/assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
            <div class="docs-info">
                <h6 class="mb-0">Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                </h6>
                <p class="text-xs font-weight-bold mb-0"> Developed By <a href="https://qkohst.github.io/" target="_black">Qkoh St</a>
                </p>
            </div>
        </div>
    </div>
</div>