<div id="box">
    <h3>Data Ekspedisi</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="toolbar">
        <button type="button" class="fleft" onclick="window.location='<?= base_url('ekspedisi/tambah') ?>'">tambah ekspedisi</button>
        <form method="post" class="cari fleft" action="<?= base_url('ekspedisi'); ?>">
            &nbsp;Tanggal Muat&nbsp;
            <input type="text" name="startdate" class="startdate datepicker" size="10" value="<?= isset($this->session->userdata['startdate']) ? $this->session->userdata['startdate'] : ''; ?>" />
            <input type="text" name="enddate" class="enddate datepicker" size="10" value="<?= isset($this->session->userdata['enddate']) ? $this->session->userdata['enddate'] : ''; ?>" />
            <input type="submit" class="proses" value="proses" />
        </form>
        <form method="post" class="cari fright" action="<?= base_url('ekspedisi'); ?>">
            <input type="text" name="cari" value="<?= isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : ''; ?>" />&nbsp;
            <input type="submit" name="submit" value="cari" />
            <input type="button" value="clear" onclick="window.location='<?= base_url('ekspedisi/clear') ?>'" />
        </form>
    </div>
    <table width="100%">
        <thead>
            <tr>
                <th width="20">No DM</th>
                <th width="60">Tanggal Muat</th>
                <th width="60">Tanggal Sampai</th>
                <th width="40">Asal</th>
                <th width="50">Tujuan</th>
                <th width="40">Kendaraan</th>
                <th width="40">Ongkos</th>
                <th width="40">Jumlah Biaya</th>
                <?php cek_admin(2, "<th width='30'>Tampilkan</th>"); ?>
                <!--th width="50">Aksi</th-->
            </tr>
        </thead>
        <tbody>
            <? foreach ($ekspedisi as $data): ?>
                <tr class="tr-<?= $data['id_ekspedisi'] ?>" <?= ($data['status'] == 1) ? "style='background-color: #9FD0D5'" : ""; ?>>
                    <td class="a-center"><a href="<?= base_url('ekspedisi/view/' . $data['id_ekspedisi']); ?>"><?= $data['no_dm']; ?></a></td>
                    <td><?= strftime("%d %B %Y", strtotime($data['tgl_muat'])); ?></td>
                    <td><?= strftime("%d %B %Y", strtotime($data['tgl_sampai'])); ?></td>
                    <td><?= $data['kota_asal']; ?></td>
                    <td><?= $data['kota_tujuan']; ?> (<?= $data["alias"]; ?>)</td>
                    <td><?= $data['nopol']; ?></td>
                    <td class="a-right"><span class="currency">Rp. </span><?= number_format($data['ongkos'], 2); ?></td>
                    <td class="a-right"><span class="currency">Rp. </span><?= number_format($data['total'], 2); ?></td>
                    <?php
                    $checked = $data['hidden'] ? "" : "checked='checked'";
                    $html = "<td align='center'><input type='checkbox' $checked onchange='sethidden($data[id_ekspedisi]);' value='Tampilkan' /></td>";
                    cek_admin(2, $html); 
                    ?>
                    <!--td align="center"><a href="<?= base_url('ekspedisi/edit/' . $data['id_ekspedisi']); ?>"><img src="<?= base_url(); ?>/img/icons/page_white_edit.png" width="16" height="16" alt="edit" /></a>&nbsp;
                        <a href="javascript:void(0);" onclick="del(<?= $data['id_ekspedisi'] ?>)"><img src="<?= base_url(); ?>/img/icons/delete.png" width="16" height="16" alt="delete" /></a></td-->
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
    <div id="pager">
        <?= $pagination ?>
        <span style="float: right">Total <strong><?= $this->pagination->total_rows; ?></strong> records found</span>
    </div>

    <div id="total">

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
	
        $( "#dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height:150,
            modal: true,
            buttons: {
                "OK": function() {
                    $.post("<?= base_url('ekspedisi/delete/'); ?>", {id : $(this).data('id')}, function(data){
                        window.location.reload();
                    })
                    $( this ).dialog( "close" );
                },
                "Batal": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
    
    function sethidden(id)
    {
        $.post("<?= base_url('ekspedisi/set_hidden'); ?>", {id : id});
    }
    
    function del(id)
    {
        $("#dialog-confirm").find('p').text("Ekspedisi dengan ID " + id + " akan dihapus. Apakah anda yakin?");
        $("#dialog-confirm").data('id', id).dialog("open");
    }
</script>
