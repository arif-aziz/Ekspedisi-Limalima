<div id="box">
    <h3>Data Invoice</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="toolbar">
        <button type="button" class="fleft" onclick="window.location='<?= base_url('invoice/carimuatan') ?>'">tambah invoice</button>
        <form method="post" class="cari fleft" action="<?= base_url('invoice'); ?>">
            &nbsp;Tanggal&nbsp;
            <input type="text" name="startdate" class="startdate datepicker" size="10" value="<?= isset($this->session->userdata['startdate']) ? $this->session->userdata['startdate'] : ''; ?>" />
            <input type="text" name="enddate" class="enddate datepicker" size="10" value="<?= isset($this->session->userdata['enddate']) ? $this->session->userdata['enddate'] : ''; ?>" />
            <input type="submit" class="proses" value="proses" />
        </form>
        <form method="post" class="cari fright" action="<?= base_url('invoice'); ?>">
            <input type="text" name="cari" value="<?= isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : ''; ?>" />&nbsp;
            <input type="submit" name="submit" value="cari" />
            <input type="button" value="clear" onclick="window.location='<?= base_url('invoice/clear') ?>'" />
        </form>
    </div>
    <table width="100%">
        <thead>
            <tr>
                <th width="50">No Invoice</th>
                <th width="50">Keterangan</th>
                <th width="190">Pengirim</th>
                <th width="50">Tanggal</th>
                <th width="50">Status</th>
                <? if ($this->session->userdata['tipe'] == 2): ?>
                    <th width="50">Aksi</th>
                <? endif; ?>
            </tr>
        </thead>
        <tbody>
            <? foreach ($invoice as $data): ?>
                <tr>
                    <td class="a-center"><?= $data['no_invoice']; ?></td>
                    <td><a href="<?= base_url('invoice/view/' . $data['id_invoice']); ?>"><?= $data['keterangan']; ?></a></td>
                    <td><?= $data['alamat']; ?></td>
                    <td></td>
                    <? if ($this->session->userdata['tipe'] == 1): ?>
                        <td align="center"><a href="<?= base_url('invoice/edit/' . $data['id_invoice']); ?>"><img src="<?= base_url(); ?>/img/icons/page_white_edit.png" width="16" height="16" alt="edit" /></a>&nbsp;
                            <a href="javascript:void(0);" onclick="del(<?= $data['id_invoice'] ?>)"><img src="<?= base_url(); ?>/img/icons/delete.png" width="16" height="16" alt="delete" /></a></td>
                    <? endif; ?>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
    <div id="pager">
        <?= $pagination ?>
        <span style="float: right">Total <strong><?= $this->pagination->total_rows; ?></strong> records found</span>
    </div>
</div>

<? if ($this->session->userdata['tipe'] == 1): ?>
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
                        $.post("<?= base_url('invoice/delete/'); ?>", {id : $(this).data('id')}, function(data){
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
            $('#dialog-confirm').find('p').text('Invoice dengan ID ' + id + ' akan dihapus. Apakah anda yakin?');
            $('#dialog-confirm').data('id', id).dialog('open');
        }
    </script>
<? endif; ?>
