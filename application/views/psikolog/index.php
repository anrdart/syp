     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <?php if ($this->session->flashdata('flash')) : ?>
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                 Data psikolog <?= $this->session->flashdata('flash'); ?>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <i class="fas fa-times"></i>
                 </button>
             </div>
         <?php endif; ?>

         <?php if (empty($psikolog)) : ?>
             <div class="alert alert-danger" role="alert">
                 Psikolog tidak ditemukan...
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <i class="fas fa-times"></i>
                 </button>
             </div>
         <?php endif; ?>

         <div class="row mt-3">
             <div class="col-6 mb-2">
                 <form action="" method="post">
                     <div class="input-group">
                         <input type="text" class="form-control" placeholder="Masukkan Pencarian ..." name="keyword">
                         <button class="btn" type="submit" style="background-color:#9932CC;"><i class="fas fa-search fa-fw text-white"></i></button>
                     </div>
                 </form>
             </div>
         </div>

         <?php if (validation_errors()) { ?>
             <div class="alert alert-danger" role="alert">
                 <?= validation_errors(); ?>
             </div>
         <?php } ?>

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <!-- Page Heading -->
                 <div class="d-sm-flex align-items-center justify-content-between mb-0">
                     <a class="btn btn-sm btn-outline-danger" href="<?= base_url(); ?>psikolog/exportToPdf"><span class="far fa-lg fa-fw fa-file-pdf"></span>Cetak Data Psikolog</a>
                     <a href="" class="d-none d-sm-inline-block btn shadow-sm" data-toggle="modal" data-target="#psikologBaruModal" style="background-color:#9932CC; color:white;"><i class="fas fa-file-alt fa-fw"></i> Tambah Psikolog</a>
                 </div>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr style="text-align:center">
                                 <th scope="col">#</th>
                                 <th scope="col">SIPP</th>
                                 <th scope="col">Nama Psikolog</th>
                                 <th scope="col">Nomor WhatsApp</th>
                                 <th scope="col">Bidang Keluhan</th>
                                 <th scope="col">Gambar</th>
                                 <th scope="col">Pilihan</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <?php
                                    $a = 1;
                                    foreach ($psikolog as $p) { ?>
                                     <td><?= $a++; ?></td>
                                     <td><?= $p['sipp']; ?></td>
                                     <td><?= $p['nama']; ?></td>
                                     <td><?= $p['whatsapp']; ?></td>
                                     <td><?= $p['jenis_keluhan']; ?></td>
                                     <td>
                                         <picture>
                                             <source srcset="" type="image/svg+xml">
                                             <img src="<?= base_url('./images/psikolog/') . $p['image']; ?>" class="img-fluid img-thumbnail" alt="...">
                                         </picture>
                                     </td>
                                     <td>
                                         <a href="<?= base_url('psikolog/updatePsikolog/') . $p['sipp']; ?>" class="badge badge-success"><i class="fas fa-edit"></i> Ubah</a>
                                         <a href="<?= base_url('psikolog/hapusPsikolog/') . $p['sipp']; ?>" class="badge badge-danger" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $p['nama']; ?> ?');"><i class="fas fa-trash"></i> Hapus</a>
                                     </td>
                             </tr>
                         <?php } ?>
                         </tr>

                         </tbody>
                     </table>
                 </div>
             </div>
         </div>

     </div>
     <!-- /.container-fluid -->

     </div>
     <!-- End of Main Content -->

     <!-- Modal Tambah Psikolog baru-->
     <div class="modal fade" id="psikologBaruModal" tabindex="-1" role="dialog" aria-labelledby="psikologBaruModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="psikologBaruModalLabel">Tambah Psikolog</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="<?= base_url('psikolog/tambah/'); ?>" method="post" enctype="multipart/form-data">
                     <div class="modal-body">
                         <div class="form-group">
                             <input type="text" class="form-control form-control-user" id="sipp" name="sipp" placeholder="Masukkan Nomor SIPP">
                             <?= form_error('sipp', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <div class="form-group">
                             <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Masukkan Nama Psikolog">
                             <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <div class="form-group">
                             <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email Psikolog">
                             <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <div class="form-group">
                             <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password">
                             <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <div class="form-group">
                             <input type="number" class="form-control form-control-user" id="whatsapp" name="whatsapp" placeholder="Masukkan Nomor Whatsapp">
                             <?= form_error('whatsapp', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                         <!-- <div class="form-group">
                             <select name="id_keluhan" class="form-control form-control-user">
                                 <option value="">Jenis Keluhan</option>
                                 <?php
                                    foreach ($keluhan as $k) { ?>
                                     <option value="<?= $k['id_keluhan']; ?>"><?= $k['keluhan']; ?></option>
                                 <?php } ?>
                             </select>
                         </div> -->
                         <div class="form-group">
                             <select name="id_keluhan" class="form-control form-control-user">
                                 <option value="">Bidang Keluhan</option>
                                 <?php
                                    foreach ($keluhan as $k) { ?>
                                     <option value="<?= $k['id_keluhan']; ?>"><?= $k['keluhan']; ?></option>
                                 <?php } ?>
                             </select>
                         </div>
                         <div class="form-group">
                             <input type="file" class="form-control form-control-user" id="image" name="image">
                             <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                         <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- End of Modal Tambah Mneu -->