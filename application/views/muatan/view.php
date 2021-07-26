<h3 class="h3view">Data Ekspedisi</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Ekspedisi</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Muatan</td>
                <td width="5" class="a-center">:</td>
                <td><?= $muatan['id_muatan']; ?></td>
            </tr>
            <tr>
                <td>No. SM</td>
                <td class="a-center">:</td>
                <td><?= $muatan['no_sm']; ?></td>
            </tr>
            <tr>
                <td>Nama Penerima</td>
                <td class="a-center">:</td>
                <td><?= $muatan['nama_penerima']; ?></td>
            </tr>
            <tr>
                <td>Alamat Penerima</td>
                <td class="a-center">:</td>
                <td><?= $muatan['alamat_penerima']; ?></td>
            </tr>
            <tr>
                <td>Berat</td>
                <td class="a-center">:</td>
                <td><?=  number_format($muatan["berat"], 2); ?></td>
            </tr>
            <tr>
                <td>Tarif</td>
                <td class="a-center">:</td>
                <td><span class="currency">Rp.&nbsp;</span><?= number_format($muatan['harga'], 2); ?></td>
            </tr>
            <tr>
                <td>Biaya</td>
                <td class="a-center">:</td>
                <td><span class="currency">Rp.&nbsp;</span><?= number_format($muatan['biaya'], 2); ?></td>
            </tr>
            <tr>
                <td>Pengirim</td>
                <td class="a-center">:</td>
                <td><a href="<?= base_url("pengirim/view/") . "/" . $muatan['id_pengirim']; ?>"><?= $muatan['nama_pengirim']; ?></a></td>
            </tr>
            <tr>
                <td>Ekspedisi</td>
                <td class="a-center">:</td>
                <td><a href="<?= base_url("ekspedisi/view/") . "/" . $muatan['id_ekspedisi']; ?>"><?= $muatan['id_ekspedisi']; ?></a></td>
            </tr>
        </table>
    </div>
    <div class="subviewbox">
        <h3 class="legend">DATA MUATAN</h3>
        <table id="tblmuatan" width="100%">
            <thead>
                <tr>
                    <th width="20">Banyak</th>
                    <th width="50">Jenis Barang</th>
                    <th width="60">Merk</th>
                </tr>
            </thead>
            <tbody class="data-muatan">
                <? if (isset($muatandt)): ?>
                    <? foreach ($muatandt as $mt): ?>
                        <tr>
                            <td align='right'><?= number_format($mt["qty"], 0); ?></td>
                            <td><?= $mt["jenis_brg"]; ?></td>
                            <td><?= $mt["merk"]; ?></td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
    </div>

    <div align="center">
        <button id="button1" type="button">Cetak SM</button>
    </div>

</div>
