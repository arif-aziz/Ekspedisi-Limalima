<h3><?= $aksi ? "Edit" : "Tambah"; ?> Pemasukan</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>PEMASUKAN</legend>
        <label for="keterangan">Keterangan : </label> 
        <input name="keterangan" id="keterangan" type="text" tabindex="1" size="50" value="<?= $aksi ? $pemasukan['keterangan'] : ""; ?>" />
        <br />
        <label for="jumlah">Jumlah : </label> 
        <input name="jumlah" id="jumlah" type="text" tabindex="2" size="50" value="<?= $aksi ? $pemasukan['jumlah'] : ""; ?>" />
        <br />
        <?php if($aksi && isset($pemasukan['id_invoice'])): ?>
        <label for="nilai">No Invoice : </label> 
        <a href="<?=base_url() . 'invoice/view/' . $pemasukan['id_invoice'];?>"><?= $pemasukan['no_invoice']; ?></a>
        <?php endif; ?>
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>


