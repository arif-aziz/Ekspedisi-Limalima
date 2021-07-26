<div id="box">
    <h3>Cari Muatan</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="toolbar">
        <form method="post" class="cari fleft" action="<?= base_url('invoice/carimuatan'); ?>">
            &nbsp;Tanggal&nbsp;
            <input type="text" name="startdate" class="startdate datepicker" size="10" value="<?= isset($this->session->userdata['startdate']) ? $this->session->userdata['startdate'] : ''; ?>" />
            <input type="text" name="enddate" class="enddate datepicker" size="10" value="<?= isset($this->session->userdata['enddate']) ? $this->session->userdata['enddate'] : ''; ?>" />
            &nbsp;Pengirim&nbsp;
            <input name="nama_pengirim" id="nama_pengirim" type="text" tabindex="2" size="20" value="<?= isset($this->session->userdata['nama_pengirim']) ? $this->session->userdata['nama_pengirim'] : ''; ?>" />
            <input name="id_pengirim" id="id_pengirim" type="hidden" size="20" value="<?= isset($this->session->userdata['id_pengirim']) ? $this->session->userdata['id_pengirim'] : ''; ?>" />

            <input type="text" name="cari" value="<?= isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : ''; ?>" />&nbsp;
            <input type="submit" name="submit" value="cari" />
            <input type="button" value="clear" onclick="window.location='<?= base_url('invoice/clear') ?>'" />
        </form>
    </div>
    <form action="<?= base_url('invoice/tambah'); ?>" method="post">
        <table width="100%">
            <thead>
                <tr>
                    <th width="20"><input id="checkall" name="checkall" type="checkbox" value="all" onchange="ceksemua();" /></th>
                    <th width="20">No SM</th>
                    <th width="50">Penerima</th>
                    <th width="60">Asal</th>
                    <th width="60">Tujuan</th>
                    <th width="60">Berat</th>
                    <th width="60">Tarif</th>
                    <th width="60">Biaya</th>
                    <th width="50">Pengirim</th>
                </tr>
            </thead>
            <tbody>
                <? if (isset($muatan)): ?>
                    <? foreach ($muatan as $mt): ?>
                        <tr>
                            <td class="a-center"><input class="checkmuatan" name="checkmuatan[]" type="checkbox" value="<?= $mt['id_muatan']; ?>" /></td>
                            <td><?= $mt["no_sm"]; ?></td>
                            <td><?= $mt["nama_penerima"]; ?></td>
                            <td><?= $mt["kota_asal"]; ?></td>
                            <td><?= $mt["kota_tujuan"]; ?> (<?= $mt["alias"]; ?>)</td>
                            <td class="a-right"><?= $mt["berat"]; ?></td>
                            <td class="a-right"><span class="currency">Rp. </span><?= number_format($mt["harga"], 2); ?></td>
                            <td class="a-right"><span class="currency">Rp. </span><?= number_format($mt["biaya"], 2); ?></td>
                            <td><?= $mt["nama_pengirim"]; ?></td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
        <div align="center">
            <input name="id_pengirim" id="id_pengirim" type="hidden" size="20" value="<?= isset($this->session->userdata['id_pengirim']) ? $this->session->userdata['id_pengirim'] : ''; ?>" />
            <input id="button1" name="submit" type="submit" value="Buat Invoice" /> 
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        $("#nama_pengirim").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'pengirim',
            showOn: true,
            resetButton : true,
            field: 'nama_pengirim',
            colModel: [{
                    'columnName':'id_pengirim',
                    'width':'10',
                    'label':'id'
                }, {
                    'columnName':'nama_pengirim',
                    'width':'45',
                    'label':'nama'
                },{
                    'columnName':'alamat',
                    'width':'45',
                    'label':'alamat'
                }],
        select: function( event, ui ) {
            $(this).val( ui.item.nama_pengirim );
            $('#id_pengirim').val(ui.item.id_pengirim);
            return false;
        }
    });
})
    
function ceksemua()
{
    if($("#checkall").attr("checked") == "checked")
        $('.checkmuatan').attr("checked", "checked");

    else
        $('.checkmuatan').removeAttr("checked");
}
</script>