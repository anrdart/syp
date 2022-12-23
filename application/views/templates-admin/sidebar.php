<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color:#9932CC;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fa fw"><img src="<?= base_url('assets/'); ?>img/icon.ico" style="width:40px; border-radius: 20px;"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SYP.id</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('admin'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item Master Data -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('client') ?>">
            <i class="fas fa-fw fa-solid fa-user"></i>
            <span>Data Client</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('psikolog') ?>">
            <i class="fas fa-fw fa-stethoscope"></i>
            <span>Data Psikolog</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('keluhan') ?>">
            <i class="fas fa-fw fa-heartbeat"></i>
            <span>Data Keluhan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('testimoni') ?>">
            <i class="fas fa-fw fa-heart"></i>
            <span>Data Testimoni</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Logout
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('autentifikasi/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->