<h3 class="h3view">Data Pengirim</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Pengirim</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Pengirim</td>
                <td width="5" class="a-center">:</td>
                <td><?= $data['id_pengirim']; ?></td>
            </tr>
            <tr>
                <td>Nama Pengirim</td>
                <td>:</td>
                <td><?= $data['nama_pengirim']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td class="a-center">:</td>
                <td><?= $data['alamat']; ?></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td class="a-center">:</td>
                <td><?=$data['kota'];?></td>
            </tr>
            <tr>
                <td>Alias</td>
                <td class="a-center">:</td>
                <td><?= $data['alias']; ?></td>
            </tr>
            
        </table>
    </div>
 
</div>
