         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">

             <!-- Main Content -->
             <div id="content">

                 <!-- Topbar -->
                 <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

                     <!-- Sidebar Toggle (Topbar) -->
                     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                         <i class="fa fa-bars"></i>
                     </button>

                     <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-white-800"><?= $judul; ?></h1>

                     <!-- Topbar Navbar -->
                     <ul class="navbar-nav ml-auto">
                         <div class="topbar-divider d-none d-sm-block"></div>

                         <!-- Nav Item - User Information -->
                         <li class="nav-item dropdown no-arrow">
                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                                 <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile') . $user['image']; ?>">
                             </a>
                             <!-- Dropdown - User Information -->
                             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                 <a class="dropdown-item" href="<?= base_url('adminlog/userPsikolog'); ?>">
                                     <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                     Profile
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="<?= base_url('adminlog/ubahPassword'); ?>">
                                     <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                     Ubah Password
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="<?= base_url('autentifikasi/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                     Logout
                                 </a>
                             </div>
                         </li>

                     </ul>

                 </nav>
                 <!-- End of Topbar -->
                 <!-- Logout Modal-->
                 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin untuk logout?</h5>
                                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">×</span>
                                 </button>
                             </div>
                             <div class="modal-body">Klik "Logout" jika anda ingin keluar dari halaman.</div>
                             <div class="modal-footer">
                                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                 <a class="btn btn-primary" href="<?= base_url('autentifikasi/logout'); ?>">Logout</a>
                             </div>
                         </div>
                     </div>
                 </div>