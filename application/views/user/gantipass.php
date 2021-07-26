<h3>Ganti Password</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>Komentar</legend>
        <label>Username : </label> 
        <?= $user['username']; ?>
        <br />
        <label for="password">Password : </label>
        <input name="password" id="password" type="password" tabindex="2" size="50" value="" />
        <br />
        <label for="confirm">Ulangi : </label>
        <input name="confirm" id="confirm" type="password" tabindex="2" size="50" value="" />
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Hapus" />
    </div>
</form>

</div>
