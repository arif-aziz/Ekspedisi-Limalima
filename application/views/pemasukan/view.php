<h3 class="h3view">Data Pemasukan</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Pemasukan</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Pemasukan</td>
                <td width="5" class="a-center">:</td>
                <td><?= $data['id_pemasukan']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?= strftime("%d %B %Y", strtotime($data['tanggal'])); ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td class="a-center">:</td>
                <td><?= $data['keterangan']; ?></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td class="a-center">:</td>
                <td><?= $data['jumlah']; ?></td>
            </tr>
            <tr>
                <td>Penginput</td>
                <td class="a-center">:</td>
                <td><a href="<?= base_url("user/view/") . "/" . $data['username']; ?>"><?= $data['username']; ?></a></td>
            </tr>
        </table>
    </div>
 
    <div align="center">
        <button id="button1" type="button">Cetak Kuitansi</button>
    </div>

</div>
