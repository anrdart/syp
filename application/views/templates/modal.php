<!-- login modal -->
<div class="modal fade" tabindex="-1" id="loginModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jadwalkan Konsultasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('client'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">WhatsApp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="Whatsapp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_keluhan" class="col-sm-2 col-form-label">Jenis Keluhan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_keluhan" name="id_keluhan" placeholder="Jenis Keluhan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
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