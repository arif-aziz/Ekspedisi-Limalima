<h3><?= $aksi ? "Edit" : "Tambah"; ?> Bengkel</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>BENGKEL</legend>
        <label for="nama_bengkel">Nama Bengkel : </label> 
        <input name="nama_bengkel" id="nama_bengkel" type="text" tabindex="1" size="50" value="<?= $aksi ? $bengkel['nama_bengkel'] : ""; ?>" />
        <br />
        <label for="alamat">Alamat : </label>
        <textarea name="alamat" id="alamat" tabindex="2"><?= $aksi ? $bengkel['alamat'] : ""; ?></textarea>
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>
