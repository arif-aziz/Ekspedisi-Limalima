<h3><?= $aksi ? "Edit" : "Tambah"; ?> Pengeluaran</h3>
<form id="form" action="" method="post">
    <fieldset id="personal">
        <legend>PENGELUARAN</legend>
        <label for="keterangan">Keterangan : </label> 
        <input name="keterangan" id="keterangan" type="text" tabindex="1" size="50" value="<?= $aksi ? $pengeluaran['keterangan'] : ""; ?>" />
        <br />
        <label for="harga">Biaya : </label> 
        <input class="nominal" name="harga" id="harga" type="text" tabindex="2" size="10" value="<?= $aksi ? $pengeluaran['harga'] : ""; ?>" />
        <br />
        <label for="qty">Banyak : </label> 
        <input class="nominal" name="qty" id="qty" type="text" tabindex="2" size="10" value="<?= $aksi ? $pengeluaran['qty'] : ""; ?>" />
        <br />
        <label for="satuan">Satuan : </label> 
        <input class="nominal" name="satuan" id="satuan" type="text" tabindex="2" size="10" value="<?= $aksi ? $pengeluaran['satuan'] : ""; ?>" />
        <br />
        <label for="jumlah">Jumlah : </label> 
        <input class="nominal" name="jumlah" id="jumlah" type="text" tabindex="2" size="20" value="<?= $aksi ? $pengeluaran['jumlah'] : ""; ?>" />
        <br />
    </fieldset>
    <fieldset id="optional">
        <legend>OPTIONAL</legend>
        <label for="nama_pegawai">Pegawai : </label> 
        <input name="nama_pegawai" id="nama_pegawai" type="text" tabindex="3" size="20" value="<?= $aksi ? $pengeluaran['nama_pegawai'] : ""; ?>" />
        <input name="id_pegawai" id="id_pegawai" type="hidden" size="20" value="<?= $aksi ? $pengeluaran['id_pegawai'] : ""; ?>" />
        <br />
        <label for="nopol">Kendaraan : </label> 
        <input name="nopol" id="nopol" type="text" tabindex="4" size="20" value="<?= $aksi ? $pengeluaran['nopol'] : ""; ?>" />
        <input name="id_kendaraan" id="id_kendaraan" type="hidden" size="20" value="<?= $aksi ? $pengeluaran['id_kendaraan'] : ""; ?>" />
        <br />
        <label for="nama_bengkel">Bengkel : </label> 
        <input name="nama_bengkel" id="nama_bengkel" type="text" tabindex="5" size="20" value="<?= $aksi ? $pengeluaran['nama_bengkel'] : ""; ?>" />
        <input name="id_bengkel" id="id_bengkel" type="hidden" size="20" value="<?= $aksi ? $pengeluaran['id_bengkel'] : ""; ?>" />
        <br />
    </fieldset>
    <div align="center">
        <input id="button1" type="submit" value="Simpan" /> 
        <input id="button2" type="reset" value="Reset" />
    </div>
</form>

<script type="text/javascript">
    
    function clearInput(a, b)
    {
        $(a).live('keyup', function(){
            if($(a).val().length == 0){
                $(b).val("");
            }
        });
    }
    
    jQuery(document).ready(function(){
        
        clearInput("#nopol", "#id_kendaraan");
        clearInput("#nama_pegawai", "#id_pegawai");
        clearInput("#nama_bengkel", "#id_bengkel");
        
        $("#harga").keyup(function(){
            hitung();
        });
        
        $("#qty").keyup(function(){
            hitung(); 
        });
        
        $("#nama_pegawai").live('keyup', function(){
            if($( "#nama_pegawai" ).val().length==0){
                $('#id_pegawai').val("");
            }
        });
        $("#nopol").live('keyup', function(){
            if($( "#nopol" ).val().length==0){
                $('#id_kendaraan').val("");
            }
        });
        $("#nama_bengkel").live('keyup', function(){
            if($( "#nama_bengkel" ).val().length==0){
                $('#id_bengkel').val("");
            }
        });
        
        $("#nama_pegawai").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'pegawai',
            field: 'nama_pegawai',
            showOn: true,
            resetButton: true,            
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
                $('#id_pegawai').val(ui.item.id_pegawai);
                return false;
            }
        });
        
        $("#nama_bengkel").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'bengkel',
            field: 'nama_bengkel',
            showOn: true,
            resetButton: true,
            colModel: [{
                    'columnName':'id_bengkel',
                    'width':'10',
                    'label':'ID'
                }, {
                    'columnName':'nama_bengkel',
                    'width':'45',
                    'label':'Nama'
                },{
                    'columnName':'alamat',
                    'width':'45',
                    'label':'Alamat'
                }],
            select: function( event, ui ) {
                $(this).val( ui.item.nama_bengkel );
                $('#id_bengkel').val(ui.item.id_bengkel);
                return false;
            }
        });
        
        $("#nopol").combogrid({
            url: base_url + 'proses/get_data',
            debug: true,
            width: 500,
            table: 'kendaraan',
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
    });
    
    function hitung()
    {
        $("#jumlah").val($("#harga").val() * $("#qty").val());
    }
</script>


