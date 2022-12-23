<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?php foreach ($client as $c) { ?>
                <form action="<?= base_url('adminlog/updateClient/'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $c['id']; ?>">
                    <div class="mb-3">
                        <label for="nama">Nama Client</label>
                        <input class="form-control" id="nama" type="text" name="nama" value="<?= $c['nama'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" value="<?= $c['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp">Nomor WhatsApp</label>
                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="<?= $c['whatsapp']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="id_keluhan">Jenis Keluhan</label>
                        <input class="form-control" id="id_keluhan" type="text" name="id_keluhan" value="<?= $c['jenis_keluhan'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="sipp">Psikiater</label>
                        <input class="form-control" id="id_psikolog" type="text" name="id_psikolog" value="<?= $c['nama_psikolog'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_konsultasi" class="form-label">Tanggal Konsultasi</label>
                        <input type="date" class="form-control" name="tanggal_konsultasi" id="tanggal_konsultasi" value="<?= $c['tanggal_konsultasi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jam_konsultasi" class="form-label">Jam Konsultasi</label>
                        <select name="jam_konsultasi" class="form-control form-control-user">
                            <option value="">Pilih Jam Konsultasi</option>
                            <?php
                            $jam_konsultasi = ['09.00 - 10.00 WIB', '10.00 - 11.00 WIB', '13.00 - 14.00 WIB', '14.00 - 15.00 WIB', '16.00 - 17.00 WIB', '18.30 - 19.30 WIB', '19.30 - 20.30 WIB'];
                            for ($i = 0; $i < 7; $i++) { ?>
                                <option value="<?= $jam_konsultasi[$i]; ?>"><?= $jam_konsultasi[$i]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" name="ubah" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Ubah Data">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>