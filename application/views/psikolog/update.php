<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?php foreach ($psikolog as $p) { ?>
                <form action="<?= base_url('psikolog/updatePsikolog/'); ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="sipp">SIPP</label>
                        <input class="form-control" id="sipp" type="text" name="sipp" value="<?= $p['sipp'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Psikolog</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $p['nama']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="<?= $p['whatsapp']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="id_keluhan">Jenis Keluhan</label>
                        <input class="form-control" id="id_keluhan" type="text" name="id_keluhan" value="<?= $p['jenis_keluhan'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Psikolog</label>
                        <br>
                        <?php
                        if (isset($p['image'])) { ?>
                            <input type="hidden" name="old_pict" id="old_pict" value="<?= $p['image']; ?>">
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('./images/psikolog/') . $p['image']; ?>" class="rounded mx-auto mb-3 d-blok" alt="...">
                            </picture>
                        <?php } ?>
                        <input type="file" class="form-control form-control-user" id="image" name="image">
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