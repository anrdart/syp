     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- Page Heading -->
         <?php if ($this->session->flashdata('flash')) : ?>
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                 Data client <?= $this->session->flashdata('flash'); ?>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <i class="fas fa-times"></i>
                 </button>
             </div>
         <?php endif; ?>

         <?php if (empty($client)) : ?>
             <div class="alert alert-danger" role="alert">
                 Client tidak ditemukan...
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
                     <a class="btn btn-sm btn-outline-danger" href="<?= base_url(); ?>client/exportToPdf"><span class="far fa-lg fa-fw fa-file-pdf"></span>Cetak Data Client</a>
                 </div>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr style="text-align:center">
                                 <th scope="col">#</th>
                                 <th scope="col">Nama Client</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Nomor WhatsApp</th>
                                 <th scope="col">Jenis Keluhan</th>
                                 <th scope="col">Psikolog</th>
                                 <th scope="col">Tanggal Konsultasi</th>
                                 <th scope="col">Jam Konsultasi</th>
                                 <th scope="col">Pilihan</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <?php
                                    $a = 1;
                                    foreach ($client as $c) { ?>
                                     <td><?= $a++; ?></td>
                                     <td><?= $c['nama']; ?></td>
                                     <td><?= $c['email']; ?></td>
                                     <td><?= $c['whatsapp']; ?></td>
                                     <td><?= $c['jenis_keluhan']; ?></td>
                                     <td><?= $c['nama_psikolog']; ?></td>
                                     <td><?= $c['tanggal_konsultasi']; ?></td>
                                     <td><?= $c['jam_konsultasi']; ?></td>
                                     <td>
                                         <a href="<?= base_url('client/updateClient/') . $c['id']; ?>" class="badge badge-success"><i class="fas fa-edit"></i> Ubah</a>
                                         <a href="<?= base_url('client/hapusClient/') . $c['id']; ?>" class="badge badge-danger" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $c['nama']; ?> ?');"><i class="fas fa-trash"></i> Hapus</a>
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