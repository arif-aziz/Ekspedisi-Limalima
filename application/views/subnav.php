<div id="top-panel">
    <div id="panel">
        <? if ($base === 6): ?>
            <ul>
                <li><a href="<?= base_url('kendaraan'); ?>">Kendaraan</a></li>
                <li><a href="<?= base_url('bengkel'); ?>">Bengkel</a></li>
                <li><a href="<?= base_url('pegawai'); ?>">Pegawai</a></li>
                <li><a href="<?= base_url('pengirim'); ?>">Pengirim</a></li>
                <? cek_admin(2, "<li><a href=" . base_url('user') . ">User</a></li>");?>
            </ul>   
        <? endif; ?>
    </div>
</div>