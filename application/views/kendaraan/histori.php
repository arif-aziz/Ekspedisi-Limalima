<div id="box">
    <h3>Histori Kendaraan</h3>
    <div class="toolbar">
        <form method="post" class="cari fleft" action="<?= base_url('kendaraan/histori') . "/" . $kendaraan['id_kendaraan']; ?>">
            &nbsp;Tanggal&nbsp;
            <input type="text" name="startdate" class="startdate datepicker" size="10" value="" />
            <input type="text" name="enddate" class="enddate datepicker" size="10" value="" />
            <input type="submit" class="proses" value="proses" />
        </form>
    </div>
</div>
