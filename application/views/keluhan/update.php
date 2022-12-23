<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_keluhan" id="id_keluhan" value="<?= $keluhan['id_keluhan']; ?>">
                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <input type="text" class="form-control" name="keluhan" id="keluhan" value="<?= $keluhan['keluhan']; ?>">
                </div>
                <div class="form-group">
                    <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                    <input type="submit" name="ubah" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Ubah Data">
                </div>
            </form>
        </div>
    </div>
</div>