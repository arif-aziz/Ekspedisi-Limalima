<h3 class="h3view">Data Bengkel</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Bengkel</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Bengkel</td>
                <td width="5" class="a-center">:</td>
                <td><?= $data['id_bengkel']; ?></td>
            </tr>
            <tr>
                <td>Nama Bengkel</td>
                <td>:</td>
                <td><?= $data['nama_bengkel']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td class="a-center">:</td>
                <td><?= $data['alamat']; ?></td>
            </tr>
           
        </table>
    </div>
 
    <div align="center">
        <button id="button1" type="button">Lihat Histori</button>
        
    </div>

</div>
