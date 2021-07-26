<?php

class Pengirim_Model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function get_data($tabel, $limit = NULL, $offset = NULL, $filter = NULL)
    {
        $fields = $this->db->list_fields($tabel);

        $awal = true;
        foreach ($fields as $field)
        {
            if ($awal)
            {
                $this->db->like($field, $filter);
                $awal = false;
            }
            else
            {
                $this->db->or_like($field, $filter);
            }
        }

        $this->db->limit($limit, $offset);
        $query = $this->db->get($tabel);
        $data = $query->result_array();

        return $data;
    }
    
    function get_nama($id_pengirim)
    {
        $this->db->where("id_pengirim", $id_pengirim);
        $hasil = $this->db->get('pengirim')->row_array();
        
        return $hasil['nama_pengirim'];
    }
}
