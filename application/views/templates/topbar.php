<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="<?= base_url('autentifikasi');?>">
                <img src="<?= base_url('assets/'); ?>img/icon.ico" style="width:40px; border-radius: 20px;">
                SYP.ID
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home')?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/about')?>">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('home/rumahbicara')?>">Rumah Bicara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('home/psikolog')?>">Psikolog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('home/testimoni')?>">Testimoni</a>
                    </li>
                </ul>
                <!-- <button type="button" class="btn btn-warning me-5 text-white p-3" style="border-radius: 40px;">Jadwalkan Konsultan</button> -->
                <a href="" class="btn btn-warning me-5 text-white p-3" data-toggle="modal" data-target="#konsultasiModal" style="border-radius: 40px;">Jadwalkan Konsultasi</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">

        <!-- login modal -->
        <div class="modal fade" tabindex="-1" id="konsultasiModal" role="dialog" aria-labelledby="konsultasiModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="konsultasiModalLabel">Jadwalkan Konsultasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('client/tambah/'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-user" id="email" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="whatsapp" class="col-sm-2 col-form-label">WhatsApp</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control form-control-user" id="whatsapp" name="whatsapp">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_keluhan" class="col-sm-2 col-form-label">Bidang Keluhan</label>
                                    <select name="id_keluhan" class="form-control form-control-user">
                                        <option value="">Bidang Keluhan</option>
                                        <?php
                                        foreach ($keluhan as $k) { ?>
                                            <option value="<?= $k['id_keluhan']; ?>"><?= $k['keluhan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="id_psikolog" class="col-sm-2 col-form-label">Nama Psikolog</label>
                                    <select name="id_psikolog" class="form-control form-control-user">
                                        <option value="">Nama Psikolog</option>
                                        <?php
                                        foreach ($psikolog as $p) { ?>
                                            <option value="<?= $p['sipp']; ?>"><?= $p['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_konsultasi" class="col-sm-2 col-form-label">Tanggal Konsultasi</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control form-control-user" name="tanggal_konsultasi" id="tanggal_konsultasi">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jam_konsultasi" class="col-sm-2 col-form-label">Jam Konsultasi</label>
                                    <select name="jam_konsultasi" class="form-control form-control-user">
                                        <option value="">Pilih Jam Konsultasi</option>
                                        <?php
                                        $jam_konsultasi = ['09.00 - 10.00 WIB', '10.00 - 11.00 WIB', '13.00 - 14.00 WIB', '14.00 - 15.00 WIB', '16.00 - 17.00 WIB', '18.30 - 19.30 WIB', '19.30 - 20.30 WIB'];
                                        for ($i = 0; $i < 7; $i++) { ?>
                                            <option value="<?= $jam_konsultasi[$i]; ?>"><?= $jam_konsultasi[$i]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button> -->
                                <button type="submit" class="btn btn-outline-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- modal info-->
            <div class="modal fade" tabindex="-1" id="modalinfo" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Informasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span class="alert alert-message alert-success">Anda sudah Dijadwalkan, Anda akan dihubungi oleh Psikiater anda!</span>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-outline-info" href="<?= base_url(); ?>">OK</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/modal info -->