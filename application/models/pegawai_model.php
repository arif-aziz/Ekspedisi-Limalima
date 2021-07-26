<?php

class Pegawai_Model extends MY_Model {

    private $table = "pegawai";

    public function __construct()
    {
        parent::__construct();
    }

    public function add_tabungan($id_pegawai)
    {
        $pegawai = $this->get_single($this->table, $id_pegawai, 'id_pegawai');
        
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->update($this->table, array("tabungan" => $pegawai['tabungan'] + 50000));
    }

    public function set_status($id_pegawai, $status)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->update($this->table, array("status" => $status));
    }

}
