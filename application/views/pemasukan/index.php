<div id="box">
    <h3>Data Pemasukan</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="toolbar">
        <button type="button" class="fleft" onclick="window.location='<?= base_url('pemasukan/tambah') ?>'">tambah pemasukan</button>
        <form method="post" class="cari fleft" action="<?= base_url('pemasukan'); ?>">
            &nbsp;Tanggal&nbsp;
            <input type="text" name="startdate" class="startdate datepicker" size="10" value="<?= isset($this->session->userdata['startdate']) ? $this->session->userdata['startdate'] : ''; ?>" />
            <input type="text" name="enddate" class="enddate datepicker" size="10" value="<?= isset($this->session->userdata['enddate']) ? $this->session->userdata['enddate'] : ''; ?>" />
            <input type="submit" class="proses" value="proses" />
        </form>
        <form method="post" class="cari fright" action="<?= base_url('pemasukan'); ?>">
            <input type="text" name="cari" value="<?= isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : ''; ?>" />&nbsp;
            <input type="submit" name="submit" value="cari" />
            <input type="button" value="clear" onclick="window.location='<?= base_url('pemasukan/clear') ?>'" />
        </form>
    </div>
    <table width="100%">
        <thead>
            <tr>
                <th width="170">Keterangan</th>
                <th width="70">Tanggal</th>
                <th width="50">Jumlah</th>
                <th width="50">No Invoice</th>
                <?php cek_admin(2, "<th width='50'>Tampilkan</th>"); ?>
                <th width="50">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($pemasukan as $data): ?>
                <tr>
                    <td><a href="<?= base_url('pemasukan/view/' . $data['id_pemasukan']); ?>"><?= $data['keterangan']; ?></a></td>
                    <td><?= strftime("%d %B %Y", strtotime($data['tanggal'])); ?></td>
                    <td align="right"><span class="currency">Rp. </span><?= number_format($data['jumlah'], 2); ?></td>
                    <td class="a-center"><?= $data['no_invoice']; ?></td>
                    <?php
                    $checked = $data['hidden'] ? "" : "checked='checked'";
                    $html = "<td align='center'><input type='checkbox' $checked onchange='sethidden($data[id_pemasukan]);' value='Tampilkan' /></td>";
                    cek_admin(2, $html);
                    ?>
                    <td align="center"><a href="<?= base_url('pemasukan/edit/' . $data['id_pemasukan']); ?>"><img src="<?= base_url(); ?>/img/icons/page_white_edit.png" width="16" height="16" alt="edit" /></a>&nbsp;
                        <a href="javascript:void(0);" onclick="del(<?= $data['id_pemasukan'] ?>)"><img src="<?= base_url(); ?>/img/icons/delete.png" width="16" height="16" alt="delete" /></a></td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
    <div id="pager">
        <?= $pagination ?>
        <span style="float: right">Total <strong><?= $this->pagination->total_rows; ?></strong> records found</span>
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
                    $.post("<?= base_url('pemasukan/delete/'); ?>", {id : $(this).data('id')}, function(data){
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
        $.post("<?= base_url('pemasukan/set_hidden'); ?>", {id : id});
    }
    
    function del(id)
    {
        $("#dialog-confirm").find('p').text("Pemasukan dengan ID " + id + " akan dihapus. Apakah anda yakin?");
        $("#dialog-confirm").data('id', id).dialog("open");
    }
</script>
