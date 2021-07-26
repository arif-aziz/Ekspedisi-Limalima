<div id="topmenu">
    <ul>
        <li <?= ($base === 1) ? "class='current'" : ""; ?>><a href="<?= base_url('/'); ?>">Dashboard</a></li>
        <li <?= ($base === 2) ? "class='current'" : ""; ?>><a href="<?= base_url('ekspedisi'); ?>">Ekspedisi</a></li>
        <li <?= ($base === 3) ? "class='current'" : ""; ?>><a href="<?= base_url('pemasukan'); ?>">Pemasukan</a></li>
        <li <?= ($base === 4) ? "class='current'" : ""; ?>><a href="<?= base_url('pengeluaran'); ?>">Pengeluaran</a></li>
        <li <?= ($base === 5) ? "class='current'" : ""; ?>><a href="<?= base_url('invoice'); ?>">Invoice</a></li>
        <li <?= ($base === 6) ? "class='current'" : ""; ?>><a href="<?= base_url('kendaraan'); ?>">Data</a></li>
        <!--li <?= ($base === 7) ? "class='current'" : ""; ?>><a href="<?= base_url('laporan'); ?>">Laporan</a></li-->
        <li><a href="<?= base_url('logout'); ?>">Logout</a></li>
    </ul>
</div>