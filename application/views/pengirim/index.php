<div id="box">
    <h3>Data Pengirim</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="toolbar">
        <button type="button" class="fleft" onclick="window.location='<?= base_url('pengirim/tambah') ?>'">tambah data</button>
        <form method="post" class="cari fright" action="<?= base_url('pengirim'); ?>">
            <input type="text" name="cari" value="<?= isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : ''; ?>" />&nbsp;
            <input type="submit" name="submit" value="cari" />
            <input type="button" value="clear" onclick="window.location='<?= base_url('pengirim/clear') ?>'" />
        </form>
    </div>
    <table width="100%">
        <thead>
            <tr>
                <th width="20">ID Pengirim</th>
                <th width="50">Nama Pengirim</th>
                <th width="20">Alias</th>
                <th width="190">Alamat</th>
                <th width="50">Kota</th>
                <th width="50">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($pengirim as $data): ?>
                <tr>
                    <td class="a-center"><?= $data['id_pengirim']; ?></td>
                    <td><a href="<?= base_url('pengirim/view/' . $data['id_pengirim']); ?>"><?= $data['nama_pengirim']; ?></a></td>
                    <td><?= $data['alias']; ?></td>
                    <td><?= $data['alamat']; ?></td>
                    <td><?= $data['kota']; ?></td>
                    <td align="center"><a href="<?= base_url('pengirim/edit/' . $data['id_pengirim']); ?>"><img src="<?= base_url(); ?>/img/icons/page_white_edit.png" width="16" height="16" alt="edit" /></a>&nbsp;
                        <a href="javascript:void(0);" onclick="del(<?= $data['id_pengirim'] ?>)"><img src="<?= base_url(); ?>/img/icons/delete.png" width="16" height="16" alt="delete" /></a></td>
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
    $().ready(function() {
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
	
        $( "#dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height:150,
            modal: true,
            buttons: {
                "OK": function() {
                    $.post("<?= base_url('pengirim/delete/'); ?>", {id : $(this).data('id')}, function(data){
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
    
    function del(id)
    {
        $("#dialog-confirm").find('p').text("Pengirim dengan ID " + id + " akan dihapus. Apakah anda yakin?");
        $("#dialog-confirm").data('id', id).dialog("open");
    }
</script>
