<h3><?= $aksi ? "Edit" : "Tambah"; ?> Pengirim</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>PENGIRIM</legend>
        <label for="nama_pengirim">Nama Pengirim : </label> 
        <input name="nama_pengirim" id="nama_pengirim" type="text" tabindex="1" size="50" value="<?= $aksi ? $pengirim['nama_pengirim'] : ""; ?>" />
        <br />
        <label for="alamat">Alamat : </label>
        <textarea name="alamat" id="alamat" tabindex="2"><?= $aksi ? $pengirim['alamat'] : ""; ?></textarea>
        <br />
        <label for="kota">Kota : </label> 
        <input name="kota" id="kota" type="text" tabindex="3" size="50" value="<?= $aksi ? $pengirim['kota'] : ""; ?>" />
        <br />        
        <label for="alias">Alias : </label> 
        <input name="alias" id="alias" type="text" tabindex="4" size="50" value="<?= $aksi ? $pengirim['alias'] : ""; ?>" />
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>
