<form method="post" action="<?php echo base_url() ?>laporan/getLaporan" >
    <table width="100%">
        <tr>
            <td width="100">Laporan</td>
            <td width="8">:</td>
            <td>&nbsp;&nbsp;<?php echo form_dropdown('laporan', array('ekspedisi' => 'Ekspedisi', 'invoice' => 'Invoice')) ?></td>
        </tr>
        <tr><td width="100">&nbsp;&nbsp;Customer</td><td width="8">:</td><td>&nbsp;&nbsp;<?php echo form_dropdown('customer', array(1 => 'Sasa', 2 => 'Masako', 3 => 'Ajino Moto', 4 => 'Royco')) ?></td></tr>
        <tr><td>&nbsp;&nbsp;Laporen per</td><td>:</td><td>&nbsp;&nbsp;
                <?php
                $bulan = empty($bulan) ? date("m") : $bulan;
                $tahun = empty($tahun) ? date("Y") : $tahun;
                echo form_dropdown('bulan', $month, $bulan);
                echo "&nbsp;&nbsp;";
                echo form_dropdown('tahun', $year, $tahun)
                ?>&nbsp;&nbsp;<input type="submit" name="show" value="Tampilkan Laporan"/></td></tr>
    </table>
</form>

<?php if (isset($data)): ?>
    <table width="100%">
        <thead>
            <tr>
                <?php
                foreach ($data->list_fields() as $field)
                {
                    echo "<td><b>" . (strtoupper(str_replace('_', ' ', $field))) . "</b></td>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($laporan == 'invoice')
            {
                if ($data->num_rows() > 0)
                {
                    foreach ($data->result() as $row)
                    {
                        echo "<tr><td>" . $row->id_invoice . "</td><td>" . $row->tanggal . "</td><td>" . $row->keterangan . "</td><td>" . $row->tanggal_bayar . "</td><td>" . $row->jumlah . "</td><td>" . $row->nama_pengirim . "</td></tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='6'>Tidak Ada Data</td></tr>";
                }
            }
            else
            {
                if ($data->num_rows() > 0)
                {
                    foreach ($data->result() as $row)
                    {
                        echo "<tr><td>" . $row->id_ekspedisi . "</td><td>" . $row->tgl_berangkat . "</td><td>" . $row->tgl_sampai . "</td><td>" . $row->nopol . "</td><td>" . $row->sopir . "</td><td>" . $row->kernet . "</td><td>" . $row->kota_tujuan . "</td></tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='8'>Tidak Ada Data</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <table width="100%">
        <tr><td>Export to <a href="<?php echo site_url("laporan/excelLaporan/$laporan/$customer/$bulan/$tahun/" . $data->num_rows()) ?>"><?php echo img('img/icons/xls.png'); ?></a> || <a href="<?php echo site_url("laporan/pdfLaporan/$laporan/$customer/$bulan/$tahun/" . $data->num_rows()) ?>"><?php echo img('img/icons/pdf.png'); ?></a></td></tr>
    </table>
<?php endif; ?>