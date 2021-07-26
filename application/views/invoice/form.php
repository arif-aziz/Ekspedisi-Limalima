<h3><?= $aksi ? "Edit" : "Tambah"; ?> Invoice</h3>
<form id="form" action="<?=base_url('invoice/simpan');?>" method="post">
    <fieldset id="personal">
        <legend>EKSPEDISI</legend>
        <label for="no_dm">No. Invoice : </label> 
        <input name="no_invoice" id="no_invoice" type="text" tabindex="1" size="20" value="<?= $aksi ? $invoice['no_invoice'] : ""; ?>" />
        <br />
        <label for="tanggal">Tanggal Invoice : </label>
        <input class="datepicker" readonly="readonly" name="tanggal" id="tanggal" type="text" tabindex="2" size="20" value="<?= $aksi ? $invoice['tanggal'] : ""; ?>" />
        <br />
        <label for="id_pengirim">Kepada : </label>
        <span><?= $nama_pengirim; ?></span>
        <input name="id_pengirim" id="id_pengirim" type="hidden" size="20" value="<?= $id_pengirim; ?>" />
        <br />
        <label for="keterangan">Keterangan : </label>
        <textarea name="keterangan" id="keterangan" tabindex="3" size="20"><?= $aksi ? $invoice['tgl_sampai'] : ""; ?></textarea>
        <br />
        <label for="nilai">Jumlah : </label>
        <span class="currency">Rp.&nbsp;<?= number_format($nilai, 2); ?></span>
        <input name="nilai" id="nilai" type="hidden" tabindex="5" size="20" value="<?= $nilai; ?>" />
        <br />   
    </fieldset>
    <fieldset id="personal">
        <legend>DATA MUATAN</legend>
        <? foreach ($tujuan as $group): ?>
            <h3>Data Muatan Tujuan <?= $group['kota_tujuan']; ?> (<?= $group['alias']; ?>)</h3>
            <table class="tblmuatan" width="100%">
                <thead>
                    <tr>
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
                <tbody class="data-muatan">
                    <? if (isset($muatan)): ?>
                        <? foreach ($muatan[$group['id_tujuan']] as $mt): ?>
                            <tr>
                                <td align='right'><?= $mt["no_sm"]; ?></td>
                                <td><?= $mt["nama_penerima"]; ?></td>
                                <td><?= $mt["kota_asal"]; ?></td>
                                <td><?= $mt["kota_tujuan"]; ?></td>
                                <td align='right'><?= number_format($mt["berat"], 2); ?></td>
                                <td class="a-right"><span class="currency">Rp. </span><?= number_format($mt["harga"], 2); ?></td>
                                <td class="a-right"><span class="currency">Rp. </span><?= number_format($mt["biaya"], 2); ?></td>
                                <td><?= $mt["nama_pengirim"]; ?></td>
                            </tr>
                        <? endforeach; ?>
                        <tr>
                            <td colspan="4" class="a-center">Jumlah</td>
                            <td class="a-right"><?= number_format($group['berat_total'], 2); ?></td>
                            <td></td>
                            <td class="a-right"><span class="currency">Rp. </span><?= number_format($group['total'], 2); ?></td>
                        </tr>
                    <? endif; ?>
                </tbody>
            </table>
        <? endforeach; ?>
    </fieldset>

    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>

<script>
    
    $(document).ready(function(){
                
        $('form#form').validate({
            rules : {
                no_invoice: {
                    required: true,
                    number: true
                },
                tanggal: "required",
                keterangan: "required"             
            },
            messages : {
                no_invoice: {
                    required: "No Invoice harus diisi",
                    number: "Tulis dengan angka"
                },
                tanggal: "Tanggal muat harus diisi",
                keterangan: "Keterangan sampai harus diisi" 

            },
            onkeyup: false
        })
        
        $(".deletemuatan").live("click", function(){
            $(this).parent().parent().remove();
        })
      
        $("#nopol").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'kendaraan',
            status: 1,
            field: 'nopol',
            showOn: true,
            resetButton: true,
            colModel: [{
                    'columnName':'id_kendaraan',
                    'width':'10',
                    'label':'ID'
                }, {
                    'columnName':'nopol',
                    'width':'45',
                    'label':'No Pol'
                },{
                    'columnName':'tipe_kendaraan',
                    'width':'45',
                    'label':'Tipe'
                }],
            select: function( event, ui ) {
                $(this).val( ui.item.nopol );
                $('#id_kendaraan').val(ui.item.id_kendaraan);
                $("#nopol").valid();
                return false;
            }
        });
      
        $("#nama_sopir").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'pegawai',
            status: 1,
            showOn: true,
            resetButton: true,
            field: 'nama_pegawai',
            colModel: [{
                    'columnName':'id_pegawai',
                    'width':'10',
                    'label':'ID'
                }, {
                    'columnName':'nama_pegawai',
                    'width':'45',
                    'label':'Nama'
                },{
                    'columnName':'alamat',
                    'width':'45',
                    'label':'Alamat'
                }],
            select: function( event, ui ) {
                $(this).val( ui.item.nama_pegawai );
                $('#sopir').val(ui.item.id_pegawai);
                $("#nama_sopir").valid();
                return false;
            }
        });
        
        $("#nama_kernet").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'pegawai',
            status: 1,
            showOn: true,   
            resetButton: true,         
            field: 'nama_pegawai',
            colModel: [{
                    'columnName':'id_pegawai',
                    'width':'10',
                    'label':'ID'
                }, {
                    'columnName':'nama_pegawai',
                    'width':'45',
                    'label':'Nama'
                },{
                    'columnName':'alamat',
                    'width':'45',
                    'label':'Alamat'
                }],
            select: function( event, ui ) {
                $(this).val( ui.item.nama_pegawai );
                $('#kernet').val(ui.item.id_pegawai);
                $("#nama_kernet").valid();
                return false;
            }
        });
        
        $("#kota_asal").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'asal',
            showOn: true,
            resetButton: true,
            field: 'kota_asal',
            colModel: [{
                    'columnName':'id_asal',
                    'width':'10',
                    'label':'ID'
                }, {
                    'columnName':'kota_asal',
                    'width':'45',
                    'label':'Kota'
                },{
                    'columnName':'alias',
                    'width':'45',
                    'label':'Alias'
                }],
            select: function( event, ui ) {
                $(this).val( ui.item.kota_asal );
                $('#id_asal').val(ui.item.id_asal);
                $("#kota_asal").valid();
                return false;
            }
        });
        
        $("#kota_tujuan").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'tujuan',
            showOn: true,
            resetButton: true,
            field: 'kota_tujuan',
            colModel: [{
                    'columnName':'id_tujuan',
                    'width':'10',
                    'label':'ID'
                }, {
                    'columnName':'kota_tujuan',
                    'width':'45',
                    'label':'Kota'
                },{
                    'columnName':'alias',
                    'width':'45',
                    'label':'Alias'
                }],
            select: function( event, ui ) {
                $(this).val( ui.item.kota_tujuan );
                $('#id_tujuan').val(ui.item.id_tujuan);
                $("#kota_tujuan").valid();
                return false;
            }
        });
        
    })
</script>