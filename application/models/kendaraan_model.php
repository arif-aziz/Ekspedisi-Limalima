<?php

class Kendaraan_Model extends MY_Model {

    private $table = "kendaraan";

    public function __construct()
    {
        parent::__construct();
    }

    public function set_status($id_kendaraan, $status)
    {
        $this->db->where('id_kendaraan', $id_kendaraan);
        $this->db->update($this->table, array("status" => $status));
    }

    public function get_group_pengeluaran($id_kendaraan, $data)
    {
        $this->db->select('bengkel.id_bengkel, SUM(pengeluaran.jumlah) as total');
        $this->db->distinct();
        $this->db->join('kendaraan', 'kendaraan.id_kendaraan = pengeluaran.id_kendaraan', 'left');
        $this->db->join('bengkel', 'bengkel.id_bengkel = pengeluaran.id_bengkel', 'left');
        $this->db->where("tanggal BETWEEN ('" . $data['startdate'] . "' and '" . $data['enddate'] . "') ");
        $this->db->where("pengeluaran.id_bengkel IS NOT NULL");
        $this->db->where("kendaraan.id_kendaraan", $id_kendaraan);
        $this->db->group_by('bengkel.id_bengkel');
        $hasil = $this->db->get('pengeluaran');

        return $hasil->result_array();
    }

    public function get_pengeluaran($id_kendaraan, $groups, $data)
    {
        
    }

    public function get_group_pemasukan($id_kendaraan, $data)
    {
        
    }

    public function get_pemasukan($id_kendaraan, $groups, $data)
    {
        
    }

}
