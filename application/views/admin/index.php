<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- row ux-->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Client</div>
                            <div class="h1 mb-0 font-weight-bold text-white"><?= $this->ModelClient->countAllClient(); ?></div>
                        </div>
                        <div class="col-2">
                            <a href="<?= base_url('adminlog/client'); ?>"><i class="fas fa-user fa-2x text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Psikolog</div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?= $this->ModelPsikolog->countAllPsikolog(); ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?= base_url('psikolog'); ?>"><i class="fas fa-stethoscope fa-2x text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 bg-danger">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Testi</div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?= $this->ModelTesti->countAllTesti(); ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?= base_url('testimoni'); ?>"><i class="fas fa-heart fa-2x text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 bg-secondary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Admin</div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?= $this->ModelUser->countAllUser(); ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?= base_url('user'); ?>"><i class="fas fa-user-md fa-2x text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row ux-->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- row table-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Client</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a class="text-danger" href="<?php echo base_url('client'); ?>"><i class="fas fa-search mt-2 float-right"> Tampilkan</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor WhatsApp</th>
                                <th>Jenis Keluhan</th>
                                <th>Psikolog</th>
                                <th>Tanggal Konsultasi</th>
                                <th>Jam Konsultasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($client as $c) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $c['nama']; ?></td>
                                    <td><?= $c['email']; ?></td>
                                    <td><?= $c['whatsapp']; ?></td>
                                    <td><?= $c['jenis_keluhan']; ?></td>
                                    <td><?= $c['nama_psikolog']; ?></td>
                                    <td><?= $c['tanggal_konsultasi']; ?></td>
                                    <td><?= $c['jam_konsultasi']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Psikolog</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a class="text-danger" href="<?php echo base_url('psikolog'); ?>"><i class="fas fa-search mt-2 float-right"> Tampilkan</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>SIPP</th>
                                <th>Nama</th>
                                <th>Whatsapp</th>
                                <th>Spesialis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($psikolog as $p) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $p['sipp']; ?></td>
                                    <td><?= $p['nama']; ?></td>
                                    <td><?= $p['whatsapp']; ?></td>
                                    <td><?= $p['jenis_keluhan']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>