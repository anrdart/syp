<table border=1>
    <tr>
        <th style="text-align:center;"><?= $judul; ?></th>
    </tr>
    <tr>
        <td>
            <div class="table-responsive">
                <table border=1 align="center">
                    <tr>
                        <th>#</th>
                        <th>Nama Client</th>
                        <th>Email</th>
                        <th>Nomor WhatsApp</th>
                        <th>Jenis Keluhan</th>
                        <th>Psikolog</th>
                        <th>Tanggal Konsultasi</th>
                        <th>Jam Konsultasi</th>
                        <th>Pilihan</th>
                    </tr>
                    <?php
                    $a = 1;
                    foreach ($client as $c) {
                    ?>
                        <tr>
                            <td><?= $a++; ?></td>
                            <td><?= $c['nama']; ?></td>
                            <td><?= $c['email']; ?></td>
                            <td><?= $c['whatsapp']; ?></td>
                            <td><?= $c['jenis_keluhan']; ?></td>
                            <td><?= $c['nama_psikolog']; ?></td>
                            <td><?= $c['tanggal_konsultasi']; ?></td>
                            <td><?= $c['jam_konsultasi']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td align="center">
            <?= (date('d M Y H:i:s')); ?>
        </td>
    </tr>
</table>