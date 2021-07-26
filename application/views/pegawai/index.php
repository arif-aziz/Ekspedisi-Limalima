<div id="box">
    <h3>Data Pegawai</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="toolbar">
        <button type="button" class="fleft" onclick="window.location='<?= base_url('pegawai/tambah') ?>'">tambah data</button>
        <form method="post" class="cari fright" action="<?= base_url('pegawai'); ?>">
            <input type="text" name="cari" value="<?= isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : ''; ?>" />&nbsp;
            <input type="submit" name="submit" value="cari" />
            <input type="button" value="clear" onclick="window.location='<?= base_url('pegawai/clear') ?>'" />
        </form>
    </div>
    <table width="100%">
        <thead>
            <tr>
                <th width="20">ID Pegawai</th>
                <th width="100">Nama Pegawai</th>
                <th width="190">Alamat</th>
                <th width="80">Tgl Lahir</th>
                <th width="60">Tabungan</th>
                <th width="50">No HP</th>
                <th width="60">Status</th>
                <th width="50">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($pegawai as $data): ?>
                <tr>
                    <td class="a-center"><?= $data['id_pegawai']; ?></td>
                    <td><a href="<?= base_url('pegawai/view/' . $data['id_pegawai']); ?>"><?= $data['nama_pegawai']; ?></a></td>
                    <td><?= $data['alamat']; ?></td>
                    <td><?= strftime("%d %B %Y", strtotime($data['tgl_lahir'])); ?></td>
                    <td><?= $data['tabungan']; ?></td>
                    <td><?= $data['no_hp']; ?></td>
                    <td>
                        <?php
                            switch($data['status'])
                            {
                                case 0 : echo "Siap"; break;
                                case 1 : echo "Ekspedisi"; break;
                                case 2 : echo "Cuti"; break;
                                case 3 : echo "Keluar"; break;
                            }
                        ?>
                    </td>
                    <td align="center"><a href="<?= base_url('pegawai/edit/' . $data['id_pegawai']); ?>"><img src="<?= base_url(); ?>/img/icons/page_white_edit.png" width="16" height="16" alt="edit" /></a>&nbsp;
                        <a href="javascript:void(0);" onclick="del(<?= $data['id_pegawai'] ?>)"><img src="<?= base_url(); ?>/img/icons/delete.png" width="16" height="16" alt="delete" /></a></td>
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
                    $.post("<?= base_url('pegawai/delete/'); ?>", {id : $(this).data('id')}, function(data){
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
        $("#dialog-confirm").find('p').text("Pegawai dengan ID " + id + " akan dihapus. Apakah anda yakin?");
        $("#dialog-confirm").data('id', id).dialog("open");
    }
</script>
