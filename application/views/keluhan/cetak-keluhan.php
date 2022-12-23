<table border=1>
    <tr>
        <th style="text-align:center;"><?= $judul; ?></th>
    </tr>
    <tr>
        <td>
            <div class="table-responsive">
                <table border=1 align="center">
                    <tr>
                        <th>No.</th>
                        <th>Jenis Keluhan</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($keluhan as $k) {
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $k['keluhan']; ?></td>
                        </tr>
                    <?php $no++;
                    } ?>
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