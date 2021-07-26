<h3><?= $aksi ? "Edit" : "Tambah"; ?> Ekspedisi</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>EKSPEDISI</legend>
        <div id="fieldset-left">
            <label for="no_dm">No DM : </label> 
            <input name="no_dm" id="no_dm" type="text" tabindex="1" size="20" value="<?= $aksi ? $ekspedisi['no_dm'] : ""; ?>" />
            <br />
            <label for="tgl_muat">Tanggal Muat : </label>
            <input class="datepicker" readonly="readonly" name="tgl_muat" id="tgl_muat" type="text" tabindex="2" size="20" value="<?= $aksi ? $ekspedisi['tgl_muat'] : ""; ?>" />
            <br />
            <label for="tgl_sampai">Tanggal Sampai : </label>
            <input class="datepicker" readonly="readonly" name="tgl_sampai" id="tgl_sampai" type="text" tabindex="3" size="20" value="<?= $aksi ? $ekspedisi['tgl_sampai'] : ""; ?>" />
            <br />
            <label for="nopol">Nopol Kend. : </label>
            <input name="nopol" id="nopol" type="text" tabindex="4" size="20" value="<?= $aksi ? $ekspedisi['nopol'] : ""; ?>" />
            <input name="id_kendaraan" id="id_kendaraan" type="hidden" size="20" value="<?= $aksi ? $ekspedisi['id_kendaraan'] : ""; ?>" />
            <br />
            <label for="kota_asal">Asal : </label>
            <input name="kota_asal" id="kota_asal" type="text" tabindex="5" size="20" value="<?= $aksi ? $ekspedisi['kota_asal'] : ""; ?>" />
            <input name="id_asal" id="id_asal" type="hidden" size="20" value="<?= $aksi ? $ekspedisi['id_asal'] : ""; ?>" />
            <br />
            <label for="kota_tujuan">Tujuan : </label>
            <input name="kota_tujuan" id="kota_tujuan" type="text" tabindex="6" size="20" value="<?= $aksi ? $ekspedisi['kota_tujuan'] : ""; ?>" />
            <input name="id_tujuan" id="id_tujuan" type="hidden" size="20" value="<?= $aksi ? $ekspedisi['id_tujuan'] : ""; ?>" />
            <br />
        </div>
        <div id="fieldset-right">
            <label for="nama_sopir">Sopir : </label>
            <input name="nama_sopir" id="nama_sopir" type="text" tabindex="7" size="20" value="<?= $aksi ? $pengeluaran['sopir']['nama_pegawai'] : ""; ?>" />
            <input name="sopir" id="sopir" type="hidden" tabindex="2" size="20" value="<?= $aksi ? $ekspedisi['sopir']['id_pegawai'] : ""; ?>" />
            <br />
            <label for="nama_kernet">Kernet : </label>
            <input name="nama_kernet" id="nama_kernet" type="text" tabindex="8" size="20" value="<?= $aksi ? $pengeluaran['kernet']['nama_pegawai'] : ""; ?>" />
            <input name="kernet" id="kernet" type="hidden" tabindex="2" size="20" value="<?= $aksi ? $ekspedisi['kernet']['id_pegawai'] : ""; ?>" />
            <br />
            <label for="ongkos">Ongkos : </label>
            <input class="nominal" name="ongkos" id="ongkos" type="text" tabindex="9" size="20" value="<?= $aksi ? $ekspedisi['ongkos'] : ""; ?>" />
            <br />
        </div>
    </fieldset>
    <fieldset id="personal">
        <legend>MUATAN</legend>
        <div class="toolbar">
            <button type="button" id="tambah-muatan">tambah muatan</button>
        </div>
        <table id="tblmuatan" width="100%">
            <thead>
                <tr>
                    <th width="20">No SM</th>
                    <th width="50">Penerima</th>
                    <th width="60">Alamat</th>
                    <th width="60">Berat</th>
                    <th width="60">Tarif</th>
                    <th width="60">Biaya</th>
                    <th width="50">Pengirim</th>
                    <th width="50">Aksi</th>
                </tr>
            </thead>
            <tbody class="data-muatan">
                <? if (isset($muatan)): ?>
                    <? foreach ($muatan as $mt): ?>
                        <tr>
                            <td class='a-right'><?= $mt["no_sm"]; ?></td>
                            <td><?= $mt["nama_penerima"]; ?></td>
                            <td><?= $mt["alamat_penerima"]; ?></td>
                            <td class='a-right'><?= number_format($mt["berat"], 2); ?></td>
                            <td class='a-right'><span class="currency">Rp. </span><?= number_format($mt['harga'], 2); ?></td>
                            <td class='a-right'><span class="currency">Rp. </span><?= number_format($mt['biaya'], 2); ?></td>
                            <td><?= $mt["nama_pengirim"]; ?></td>
                            <td class='a-center'><a onclick='del(<?= $mt["id_muatan"] ?>)' href='javascript:void(0)'><img src='<?= base_url(); ?>/img/icons/delete.png' width='16' height='16' alt='delete' /></td>
                        </tr>
                    <? endforeach; ?>
                <? endif; ?>
            </tbody>
        </table>
    </fieldset>
    <div id="note"><em>Note: Jika anda menekan tombol Simpan dan data berhasil dimasukkan, maka sistem akan otomatis mengubah status kendaraan dan pegawai menjadi "Ekspedisi". Serta menambahkan tabungan pegawai sebesar Rp. 50.000,- </em></div>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>

<script>
    function closeWindow()
    {
        $.window.closeAll();
    }
    
    function clearInput(a, b)
    {
        $(a).live('keyup', function(){
            if($(a).val().length == 0){
                $(b).val("");
            }
        });
    }
       
    function del(id)
    {
        $("#dialog-confirm").find('p').text("Muatan dengan ID " + id + " akan dihapus. Apakah anda yakin?");
        $("#dialog-confirm").data('id', id).dialog("open");
    }
    
    $(document).ready(function(){

        $( "#dialog:ui-dialog" ).dialog( "destroy" );
	
        $( "#dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height:150,
            modal: true,
            buttons: {
                "OK": function() {
                    $.post("<?= base_url('muatan/delete/'); ?>", {id : $(this).data('id')}, function(data){
                        window.location.reload();
                    })
                    $( this ).dialog( "close" );
                },
                "Batal": function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        clearInput("#nopol", "#id_kendaraan");
        clearInput("#kota_asal", "#id_asal");
        clearInput("#kota_tujuan", "#id_tujuan");
        clearInput("#nama_sopir", "#sopir");
        clearInput("#nama_kernet", "#kernet");
        
        $('form#form').validate({
            rules : {
                no_dm: {
                    required: true,
                    number: true,
                    remote: "cek_dm"                     
                },
                tgl_muat: "required",
                tgl_sampai: "required",
                id_kendaraan: "required",
                id_asal: "required",
                id_tujuan: "required",
                sopir: "required",
                ongkos: {
                    required: true,
                    number: true
                }                
            },
            messages : {
                no_dm: {
                    required: "No DM harus diisi",
                    number: "Tulis dengan angka",
                    remote: "No DM sudah terpakai"
                },
                tgl_muat: "Tanggal muat harus diisi",
                tgl_sampai: "Tanggal sampai harus diisi",
                id_kendaraan: "Kendaraan harus diisi",
                id_asal: "Asal harus diisi",
                id_tujuan: "Tujuan harus diisi",
                sopir: "Sopir harus diisi",
                ongkos: {
                    required: "Ongkos harus diisi",
                    number: "Tulis dengan angka"
                }   

            },
            onkeyup: false,
            onsubmit: function(){
                
                if($("form#form").valid())
                {
                    var no_sm = $("#no_sm").val();
                    var nama_penerima = $("#nama_penerima").val();
                    var alamat_penerima = $("#alamat_penerima").val();
                    var tipe_biaya = $("form input[checked='checked']:radio").val();
                    var berat = $("#berat").val();
                    var harga = $("#harga").val();
                    var biaya = $("#biaya").val();
                    var id_pengirim = $("#id_pengirim").val();
                    var status = 0;
                    var hidden = 0;
                    var id_muatan = "";
                        
                    $.ajax({
                        type : 'POST',
                        url : base_url + "muatan/tambah", 
                        data : {
                            no_sm : no_sm,
                            nama_penerima : nama_penerima,
                            alamat_penerima : alamat_penerima,
                            tipe_biaya : tipe_biaya,
                            berat : berat,
                            harga : harga,
                            biaya : biaya,
                            id_pengirim : id_pengirim,
                            status : status,
                            hidden : hidden
                        },
                        async: false,
                        success: function(data)
                        {
                            id_muatan = data;
                        }
                    });
                        
                    $("#muatan tr").each(function(){
                        if ($(this).find('.qty').text() != "")
                        {
                            var qty = $(this).find('.qty').text();
                            var merk = $(this).find('.merk').text();
                            var jenis_brg = $(this).find('.jenis_brg').text();
                            $.ajax({
                                type : 'POST',
                                url : base_url + "muatan/tambah_dt", 
                                data : {
                                    id_muatan : id_muatan,
                                    qty : qty,
                                    merk : merk,
                                    jenis_brg : jenis_brg
                                },
                                async: false
                            });
                        }
                    });
                    window.parent.closeWindow();
                }
            }
        })
        
        $("#tambah-muatan").click(function() {
            $.window({
                title: "Tambah Muatan",
                url: base_url + "muatan",
                width: 980,           // window width
                height: 500, 
                maxWidth: 1000,
                bookmarkable: false,
                showModal: true,
                onClose: function(wnd)
                {
                    $.getJSON(base_url + 'muatan/get_muatan', function(json){
                        var tbody = $("#tblmuatan > tbody");
                        tbody.empty();
                        $.each(json, function(index, value) {
                            tbody.append("<tr>" + 
                                "<td class='a-right'>" + value.no_sm + "</td>" + 
                                "<td>" + value.nama_penerima + "</td>" + 
                                "<td>" + value.alamat_penerima +  "</td>" + 
                                "<td class='a-right'>" + addCommas(format_number(value.berat, 2)) + "</td>" + 
                                "<td class='a-right'><span class='currency'>Rp. </span>" + addCommas(format_number(value.harga, 2)) + "</td>" + 
                                "<td class='a-right'><span class='currency'>Rp. </span>" + addCommas(format_number(value.biaya, 2)) + "</td>" + 
                                "<td>" + value.nama_pengirim + "</td>" + 
                                "<td class='a-center'><a onclick='del(" + value.id_muatan + ")' href='javascript:void(0)'>" + 
                                "<img src='<?= base_url(); ?>/img/icons/delete.png' width='16' height='16' alt='delete' /></td" + 
                                "</tr>");
                        });
                    });
                }
            });
        });
      
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
                    'width':'30',
                    'label':'No Pol'
                },{
                    'columnName':'tipe_kendaraan',
                    'width':'30',
                    'label':'Tipe'
                },{
                    'columnName':'max_muatan',
                    'width':'30',
                    'label':'Max Muatan'
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