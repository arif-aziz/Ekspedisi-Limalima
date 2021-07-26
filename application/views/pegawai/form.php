<h3><?= $aksi ? "Edit" : "Tambah"; ?> Pegawai</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>PEGAWAI</legend>
        <label for="nama_pegawai">Nama Pegawai : </label> 
        <input name="nama_pegawai" id="nama_pegawai" type="text" tabindex="1" size="50" value="<?= $aksi ? $pegawai['nama_pegawai'] : ""; ?>" />
        <br />
        <label for="alamat">Alamat : </label>
        <textarea name="alamat" tabindex="2"  id="alamat"><?= $aksi ? $pegawai['alamat'] : ""; ?></textarea>
        <br />
        <label for="tgl_lahir">Tanggal Lahir : </label> 
        <input name="tgl_lahir" id="tgl_lahir" type="text" tabindex="3" size="20" value="<?= $aksi ? $pegawai['tgl_lahir'] : ""; ?>" />
        <br />
        <label for="tabungan">Tabungan : </label> 
        <input name="tabungan" id="tabungan" type="text" tabindex="4" size="20" value="<?= $aksi ? $pegawai['tabungan'] : ""; ?>" />
        <br />
        <label for="no_hp">No HP : </label> 
        <input name="no_hp" id="no_hp" type="text" tabindex="5" size="20" value="<?= $aksi ? $pegawai['no_hp'] : ""; ?>" />
        <br />
        <label for="status">Status : </label> 
        <select name="status" id="status" tabindex="6">
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 0 ) ? "selected='selected'" : ""; ?>value="0">Siap</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 1 ) ? "selected='selected'" : ""; ?>value="1">Ekspedisi</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 2 ) ? "selected='selected'" : ""; ?>value="2">Cuti</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 3 ) ? "selected='selected'" : ""; ?>value="3">Keluar</option>
        </select>
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>

<script type="text/javascript">
    $().ready(function(){
        $('#tgl_lahir').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    })
</script>
