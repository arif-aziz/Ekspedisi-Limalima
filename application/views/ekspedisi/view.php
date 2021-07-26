<h3 class="h3view">Data Ekspedisi</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Ekspedisi</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Ekspedisi</td>
                <td width="5" class="a-center">:</td>
                <td><?= $ekspedisi['id_ekspedisi']; ?></td>
            </tr>
            <tr>
                <td>No. DM</td>
                <td class="a-center">:</td>
                <td><?= $ekspedisi['no_dm']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Muat</td>
                <td class="a-center">:</td>
                <td><?= strftime("%d %B %Y", strtotime($ekspedisi['tgl_muat'])); ?></td>
            </tr>
            <tr>
                <td>Tanggal Sampai</td>
                <td class="a-center">:</td>
                <td><?= strftime("%d %B %Y", strtotime($ekspedisi['tgl_sampai'])); ?></td>
            </tr>
            <tr>
                <td>Asal</td>
                <td class="a-center">:</td>
                <td><?= $ekspedisi['kota_asal']; ?></td>
            </tr>
            <tr>
                <td>Tujuan</td>
                <td class="a-center">:</td>
                <td><?= $ekspedisi['kota_tujuan']; ?></td>
            </tr>
            <tr>
                <td>Kendaraan</td>
                <td class="a-center">:</td>
                <td><a href="<?= base_url("kendaraan/view/") . "/" . $ekspedisi['id_kendaraan']; ?>"><?= $ekspedisi['nopol']; ?></a></td>
            </tr>
            <tr>
                <td>Sopir</td>
                <td class="a-center">:</td>
                <td><a href="<?= base_url("pegawai/view/") . "/" . $ekspedisi['sopir']; ?>"><?= $ekspedisi['nama_sopir']; ?></a></td>
            </tr>
            <tr>
                <td>Kernet</td>
                <td class="a-center">:</td>
                <td><a href="<?= base_url("pegawai/view/") . "/" . $ekspedisi['kernet']; ?>"><?= $ekspedisi['nama_kernet']; ?></a></td>
            </tr>
            <tr>
                <td>Penginput</td>
                <td class="a-center">:</td>
                <td><a href="<?= base_url("user/view/") . "/" . $ekspedisi['username']; ?>"><?= $ekspedisi['username']; ?></a></td>
            </tr>
            <tr>
                <td>Tanggal Input</td>
                <td class="a-center">:</td>
                <td><?= strftime("%d %B %Y", strtotime($ekspedisi['tgl_input'])); ?></td>
            </tr>
        </table>
    </div>
    <div class="subviewbox">
        <h3 class="legend">DATA MUATAN</h3>
        <table id="tblmuatan" width="100%">
            <thead>
                <tr>
                    <th width="20">No SM</th>
                    <th width="50">Penerima</th>
                    <th width="60">Alamat</th>
                    <th width="60">Berat</th>
                    <th width="60">Tarif</th>
                    <th width="60">Biaya</th>
                    <th width="50">Pengirim</th>
                </tr>
            </thead>
            <tbody class="data-muatan">
                <? if (isset($muatan)): ?>
                    <? foreach ($muatan as $mt): ?>
                        <tr>
                            <td align='right'><a href="<?= base_url("muatan/view/") . "/" . $mt['id_muatan']; ?>"><?= $mt["no_sm"]; ?></a></td>
                            <td><?= $mt["nama_penerima"]; ?></td>
                            <td><?= $mt["alamat_penerima"]; ?></td>
                            <td align='right'><?= $mt["berat"]; ?></td>
                            <td class="a-right"><span class="currency">Rp. </span><?= number_format($mt["harga"], 2); ?></td>
                            <td class="a-right"><span class="currency">Rp. </span><?= number_format($mt["biaya"], 2); ?></td>
                            <td><?= $mt["nama_pengirim"]; ?></td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
    </div>

    <div align="center">
        <button id="button1" type="button">Cetak DM</button>
        <? if($ekspedisi['status'] == 1): ?>
        <a href="<?= base_url("ekspedisi/complete") . "/" . $ekspedisi['id_ekspedisi'];?>"><button id="button2" type="button">Complete</button></a>
        <? endif; ?>
    </div>

</div>
