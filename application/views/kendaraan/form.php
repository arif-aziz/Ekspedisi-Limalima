<h3><?= $aksi ? "Edit" : "Tambah"; ?> Kendaraan</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>KENDARAAN</legend>
        <label for="nopol">No. Polisi : </label> 
        <input name="nopol" id="nopol" type="text" tabindex="1" size="50" value="<?= $aksi ? $kendaraan['nopol'] : ""; ?>" />
        <br />
        <label for="max_muatan">Max Muatan : </label>
        <input name="max_muatan" id="max_muatan" type="text" tabindex="2" size="50" value="<?= $aksi ? $kendaraan['max_muatan'] : ""; ?>" />
        <br />
        <label for="status">Status : </label> 
        <select name="status" id="status" tabindex="3">
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 0 ) ? "selected='selected'" : ""; ?>value="0">Siap</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 1 ) ? "selected='selected'" : ""; ?>value="1">Ekspedisi</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 2 ) ? "selected='selected'" : ""; ?>value="2">Bengkel</option>
            <option <?= (isset($pegawai['status']) && $pegawai['status'] == 3 ) ? "selected='selected'" : ""; ?>value="3">Rusak</option>
        </select>
        <br />
        <label for="tipe_kendaraan">Tipe Kendaraan : </label> 
        <select name="tipe_kendaraan" id="status" tabindex="3">
            <option <?= (isset($pegawai['tipe_kendaraan']) && $pegawai['tipe_kendaraan'] == 'gandengan' ) ? "selected='selected'" : ""; ?>value="gandengan">Gandengan</option>
            <option <?= (isset($pegawai['tipe_kendaraan']) && $pegawai['tipe_kendaraan'] == 'tronton' ) ? "selected='selected'" : ""; ?>value="tronton">Tronton</option>
            <option <?= (isset($pegawai['tipe_kendaraan']) && $pegawai['tipe_kendaraan'] == 'trailer' ) ? "selected='selected'" : ""; ?>value="trailer">Trailer</option>
        </select>
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>
