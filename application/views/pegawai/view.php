<h3 class="h3view">Data Pegawai</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Pegawai</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Pegawai</td>
                <td width="5" class="a-center">:</td>
                <td><?= $data['id_pegawai']; ?></td>
            </tr>
            <tr>
                <td>Nama Pegawai</td>
                <td>:</td>
                <td><?= $data['nama_pegawai']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td class="a-center">:</td>
                <td><?= $data['alamat']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td class="a-center">:</td>
                <td><?= $data['tgl_lahir']; ?></td>
            </tr>
            <tr>
                <td>Tabungan</td>
                <td class="a-center">:</td>
                <td><?= $data['tabungan']; ?></td>
            </tr>
            <tr>
                <td>No. Handphone</td>
                <td class="a-center">:</td>
                <td><?= $data['no_hp']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td class="a-center">:</td>
                <td><?php switch($data['status'])
                {
                    case 0: echo "Siap";break;
                    case 1: echo "Ekspedisi";break;
                    case 2: echo "Cuti";break;
                    case 3: echo "Keluar";break;
                }
                ?></td>
            </tr>
            
           
        </table>
    </div>
 
    <div align="center">
        <button id="button1" type="button">Lihat Histori</button>
        
    </div>

</div>
