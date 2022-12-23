<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $testi['id']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $testi['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?= $testi['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $testi['tanggal']; ?>">
                </div>
                <div class="mb-3">
                    <label for="testimoni" class="form-label">Testimoni</label>
                    <input type="text" class="form-control" name="testimoni" id="testimoni" value="<?= $testi['testimoni']; ?>">
                </div>
                <div class="form-group">
                    <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                    <input type="submit" name="ubah" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Ubah Data">
                </div>
            </form>
        </div>
    </div>
</div>