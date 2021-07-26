<div id="box">
    <h3>Data Kendaraan</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="toolbar">
        <button type="button" class="fleft" onclick="window.location='<?= base_url('kendaraan/tambah') ?>'">tambah data</button>
        <form method="post" class="cari fright" action="<?= base_url('kendaraan'); ?>">
            <input type="text" name="cari" value="<?= isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : ''; ?>" />&nbsp;
            <input type="submit" name="submit" value="cari" />
            <input type="button" value="clear" onclick="window.location='<?= base_url('kendaraan/clear') ?>'" />
        </form>
    </div>
    <table width="100%">
        <thead>
            <tr>
                <th width="20">ID Kendaraan</th>
                <th width="50">No Polisi</th>
                <th width="60">Max Muatan</th>
                <th width="60">Tipe Kendaraan</th>
                <th width="60">Status</th>
                <th width="50">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($kendaraan as $data): ?>
                <tr>
                    <td class="a-center"><?= $data['id_kendaraan']; ?></td>
                    <td><a href="<?= base_url('kendaraan/view/' . $data['id_kendaraan']); ?>"><?= $data['nopol']; ?></a></td>
                    <td><?= $data['max_muatan']; ?></td>
                    <td>
                        <?php
                            switch($data['tipe_kendaraan'])
                            {
                                case 'gandengan' : echo "Gandengan"; break;
                                case 'tronton' : echo "Tronton"; break;
                                case 'trailer' : echo "Trailer"; break;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            switch($data['status'])
                            {
                                case 0 : echo "Siap"; break;
                                case 1 : echo "Ekspedisi"; break;
                                case 2 : echo "Bengkel"; break;
                                case 3 : echo "Rusak"; break;
                            }
                        ?>
                    </td>
                    <td align="center"><a href="<?= base_url('kendaraan/edit/' . $data['id_kendaraan']); ?>"><img src="<?= base_url(); ?>/img/icons/page_white_edit.png" width="16" height="16" alt="edit" /></a>&nbsp;
                        <a href="javascript:void(0);" onclick="del(<?= $data['id_kendaraan'] ?>)"><img src="<?= base_url(); ?>/img/icons/delete.png" width="16" height="16" alt="delete" /></a></td>
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
                    $.post("<?= base_url('kendaraan/delete/'); ?>", {id : $(this).data('id')}, function(data){
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
        $("#dialog-confirm").find('p').text("Kendaraan dengan ID " + id + " akan dihapus. Apakah anda yakin?");
        $("#dialog-confirm").data('id', id).dialog("open");
    }
</script>
