<h3><?= $aksi ? "Edit" : "Tambah"; ?> User</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>BENGKEL</legend>
        <label for="username">Username : </label> 
        <? if ($aksi): ?>
        <span><?=$user['username'];?></span>
        <? else: ?>
        <input name="username" id="username" type="text" tabindex="1" size="50" value="" />
        <? endif; ?>
        <br />
        <? if (!$aksi): ?>
            <label for="password">Password : </label> 
            <input name="password" id="password" type="password" tabindex="1" size="50" value="" />
            <br />
        <? endif; ?>
        <label for="nama_user">Nama User : </label> 
        <input name="nama_user" id="nama_user" type="text" tabindex="2" size="50" value="<?= $aksi ? $user['nama_user'] : ""; ?>" />
        <br />
        <label for="alamat">Alamat : </label>
        <textarea name="alamat" id="alamat" tabindex="3"><?= $aksi ? $user['alamat'] : ""; ?></textarea>
        <br />
        <label for="tipe">Tipe : </label> 
        <select name="tipe" id="tipe" tabindex="4">
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 0 ) ? "selected='selected'" : ""; ?>value="0">Admin Gudang</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 1 ) ? "selected='selected'" : ""; ?>value="1">Admin Kantor</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 2 ) ? "selected='selected'" : ""; ?>value="2">Super Admin</option>
        </select>
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>
