<?php

class Pengeluaran_Model extends MY_Model {

    var $tabel = "pengeluaran";

    public function __construct()
    {
        parent::__construct();
    }

    function count_data($tabel = 'pengeluaran')
    {
        $fields = $this->db->list_fields($tabel);
        $filter = $this->session->userdata('filter');
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');
        //$this->db->where('status', '1');

        $awal = true;
        $num = count($fields);
        $where = "";
        foreach ($fields as $field)
        {
            if ($awal)
            {
                $where .= "(pengeluaran." . $field . " LIKE '%" . $filter . "%' ";
                $awal = false;
            }
            else
            {
                $where .= "OR pengeluaran." . $field . " LIKE '%" . $filter . "%' ";
            }
        }

        $where .= "OR bengkel.nama_bengkel LIKE '%" . $filter . "%' ";
        $where .= "OR kendaraan.nopol LIKE '%" . $filter . "%' ";
        $where .= "OR pegawai.nama_pegawai LIKE '%" . $filter . "%') ";

        $this->db->join('pegawai', 'pegawai.id_pegawai = pengeluaran.id_pegawai', 'left');
        $this->db->join('kendaraan', 'kendaraan.id_kendaraan = pengeluaran.id_pengeluaran', 'left');
        $this->db->join('bengkel', 'bengkel.id_bengkel = pengeluaran.id_bengkel', 'left');
        $this->db->where($where);
        if (!empty($startdate) && !empty($enddate))
            $this->db->where("tanggal BETWEEN '$startdate' and '$enddate'");

        $this->db->from($tabel);
        return $this->db->count_all_results();
    }

    function get_data($tabel = 'pengeluaran', $limit = NULL, $offset = NULL)
    {
        $fields = $this->db->list_fields($tabel);
        $filter = $this->session->userdata('filter');
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');
        //$this->db->where('status', '1');

        $awal = true;
        $num = count($fields);
        $where = "";
        foreach ($fields as $field)
        {
            if ($awal)
            {
                $where .= "(pengeluaran." . $field . " LIKE '%" . $filter . "%' ";
                $awal = false;
            }
            else
            {
                $where .= "OR pengeluaran." . $field . " LIKE '%" . $filter . "%' ";
            }
        }
        $where .= "OR bengkel.nama_bengkel LIKE '%" . $filter . "%' ";
        $where .= "OR kendaraan.nopol LIKE '%" . $filter . "%' ";
        $where .= "OR pegawai.nama_pegawai LIKE '%" . $filter . "%') ";

        $this->db->select('pengeluaran.*, pegawai.nama_pegawai, bengkel.nama_bengkel, kendaraan.nopol');
        $this->db->join('pegawai', 'pegawai.id_pegawai = pengeluaran.id_pegawai', 'left');
        $this->db->join('kendaraan', 'kendaraan.id_kendaraan = pengeluaran.id_kendaraan', 'left');
        $this->db->join('bengkel', 'bengkel.id_bengkel = pengeluaran.id_bengkel', 'left');
        $this->db->where($where);
        if (!empty($startdate) && !empty($enddate))
            $this->db->where("tanggal BETWEEN '$startdate' and '$enddate'");
        $this->db->order_by("tanggal", "DESC");
        $this->db->limit($limit, $offset);

        $query = $this->db->get($tabel);
        $data = $query->result_array();

        return $data;
    }

    function set_hidden($id_pengeluaran)
    {
        $pengeluaran = $this->get_single($id_pengeluaran, 'id_pengeluaran', $this->tabel);
        $id = $pengeluaran['hidden'] ? 0 : 1;

        $this->db->where('id_pengeluaran', $id_pengeluaran);
        $this->db->update('pengeluaran', array('hidden' => $id));

        return $this->db->affected_rows();
    }

    function get_single($id, $field, $tabel = 'pengeluaran')
    {
        $data = array();

        $this->db->select('pengeluaran.*, pegawai.nama_pegawai, bengkel.nama_bengkel, kendaraan.nopol');
        $this->db->join('pegawai', 'pegawai.id_pegawai = pengeluaran.id_pegawai', 'left');
        $this->db->join('kendaraan', 'kendaraan.id_kendaraan = pengeluaran.id_kendaraan', 'left');
        $this->db->join('bengkel', 'bengkel.id_bengkel = pengeluaran.id_bengkel', 'left');

        $query = $this->db->get_where($tabel, array($field => $id));
        $data = $query->row_array();

        return $data;
    }

    function _get_no_invoice($id_invoice)
    {
        $query = $this->db->get_where('invoice', array('id_invoice' => $id_invoice));
        $hasil = $query->row_array();

        return $hasil['no_invoice'];
    }

}
