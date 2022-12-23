<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data keluhan <?= $this->session->flashdata('flash'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <?php if (empty($keluhan)) : ?>
        <div class="alert alert-danger" role="alert">
            Keluhan tidak ditemukan...
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
                <!-- <a class="btn btn-sm btn-outline-danger" href="<?= base_url(); ?>keluhan/exportToPdf"><span class="far fa-lg fa-fw fa-file-pdf"></span>Cetak Data Keluhan</a> -->
                <a href="" class="d-none d-sm-inline-block btn shadow-sm" data-toggle="modal" data-target="#keluhanBaruModal" style="background-color:#9932CC; color:white;"><i class="fas fa-file-alt fa-fw"></i> Tambah Keluhan</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Keluhan</th>
                            <th scope="col">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr">
                            <?php if (!empty($keluhan)) {
                                $a = 1;
                                foreach ($keluhan as $k) : ?>
                                    <td><?= $a++; ?></td>
                                    <td><?= $k['keluhan']; ?></td>
                                    <td>
                                        <a href="<?= base_url('keluhan/hapusKeluhan/') . $k['id_keluhan']; ?>" class="badge badge-danger" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $k['keluhan']; ?> ?');"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                    </tr>
                            <?php endforeach;
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah Keluhan baru-->
<div class="modal fade" id="keluhanBaruModal" tabindex="-1" role="dialog" aria-labelledby="keluhanBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="keluhanBaruModalLabel">Tambah Keluhan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('keluhan/tambah/'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="keluhan" name="keluhan" placeholder="Masukkan Keluhan">
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