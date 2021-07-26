<h3 class="h3view">Data Pemasukan</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Pemasukan</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Pengeluaran</td>
                <td width="5" class="a-center">:</td>
                <td><?= $data['id_pengeluaran']; ?></td>
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
            <tr>
                <td>Pegawai</td>
                <td class="a-center">:</td>
                <td><a href="<?=base_url("pegawai/view/") . "/" .  $data['id_pegawai'];?>"><?= $data['nama_pegawai']; ?></a></td>
            </tr>
            <tr>
                <td>Bengkel</td>
                <td class="a-center">:</td>
                <td><a href="<?=base_url("bengkel/view/") . "/" .  $data['id_bengkel'];?>"><?= $data['nama_bengkel']; ?></a></td>
            </tr>
            <tr>
                <td>Kendaraan</td>
                <td class="a-center">:</td>
                <td><a href="<?=base_url("kendaraan/view/") . "/" . $data['id_kendaraan'];?>"><?= $data['nopol']; ?></a></td>
            </tr>            
        </table>
    </div>
 
    <div align="center">
        <button id="button1" type="button">Cetak Kuitansi</button>
    </div>

</div>
