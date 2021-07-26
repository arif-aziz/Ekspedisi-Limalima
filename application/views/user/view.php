<h3 class="h3view">Data Pengirim</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Pengirim</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">Username</td>
                <td width="5" class="a-center">:</td>
                <td><?= $data['username']; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $data['nama_user']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td class="a-center">:</td>
                <td><?= $data['alamat']; ?></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td class="a-center">:</td>
                <td><? 
                switch($data['tipe'])
                {
                    case 0: echo "Admin Gudang";break;
                    case 1: echo "Admin Kantor";break;
                    case 2: echo "Super Admin";break;
                }
                ?></td>
            </tr>
        </table>
    </div>
 
</div>
