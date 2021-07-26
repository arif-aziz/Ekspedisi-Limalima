<h3 class="h3view">Data Kendaraan</h3>
<div id="viewbox">
    <div class="subviewbox">
        <div class="legend">Informasi Kendaraan</div>
        <table class="view noborder" width="100%">
            <tr>
                <td width="100">ID Kendaraan</td>
                <td width="5" class="a-center">:</td>
                <td><?= $data['id_kendaraan']; ?></td>
            </tr>
            <tr>
                <td>No. Polisi</td>
                <td>:</td>
                <td><?= $data['nopol']; ?></td>
            </tr>
            <tr>
                <td>Max Muatan</td>
                <td class="a-center">:</td>
                <td><?= $data['max_muatan']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td class="a-center">:</td>
                <td><? 
                switch($data['status'])
                {
                    case 0: echo "Siap";break;
                    case 1: echo "Ekspedisi";break;
                    case 2: echo "Bengkel";break;
                    case 3: echo "Rusak";break;
                }
                ?></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td class="a-center">:</td>
                <td><?= $data['tipe_kendaraan']; ?></td>
            </tr>
            
        </table>
    </div>
 
    <div align="center">
        <a href="<?=base_url('kendaraan/histori') . "/" . $data['id_kendaraan'];?>"><button id="button1" type="button">Lihat Histori</button></a>
        
    </div>

</div>
