<?php

class Pemasukan_Model extends MY_Model {

    var $tabel = 'pemasukan';

    public function __construct()
    {
        parent::__construct();
    }

    function count_data($tabel = 'pemasukan')
    {
        $fields = $this->db->list_fields($tabel);
        //$this->db->where('hidden', '1');

        $filter = $this->session->userdata('filter');
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');

        $awal = true;
        $num = count($fields);
        $where = "";
        foreach ($fields as $field)
        {
            if ($awal)
            {
                $where .= "(pemasukan." . $field . " LIKE '%" . $filter . "%' ";
                $awal = false;
            }
            else
            {
                $where .= "OR pemasukan." . $field . " LIKE '%" . $filter . "%' ";
            }
        }

        $where .= "OR invoice.no_invoice LIKE '%" . $filter . "%') ";

        $this->db->join('invoice', 'invoice.id_invoice = pemasukan.id_invoice', 'left');
        $this->db->where($where);
        if (!empty($startdate) && !empty($enddate))
            $this->db->where("pemasukan.tanggal BETWEEN '$startdate' and '$enddate'");

        $this->db->from($tabel);
        return $this->db->count_all_results();
    }

    function get_data($tabel = 'pemasukan', $limit = NULL, $offset = NULL)
    {
        $fields = $this->db->list_fields($tabel);
        //$this->db->where('hidden', '1');

        $filter = $this->session->userdata('filter');
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');

        $awal = true;
        $num = count($fields);
        $where = "";
        foreach ($fields as $field)
        {
            if ($awal)
            {
                $where .= "(pemasukan." . $field . " LIKE '%" . $filter . "%' ";
                $awal = false;
            }
            else
            {
                $where .= "OR pemasukan." . $field . " LIKE '%" . $filter . "%' ";
            }
        }

        $where .= "OR invoice.no_invoice LIKE '%" . $filter . "%') ";

        $this->db->select('pemasukan.*, invoice.no_invoice');
        $this->db->join('invoice', 'invoice.id_invoice = pemasukan.id_invoice', 'left');
        $this->db->where($where);
        if (!empty($startdate) && !empty($enddate))
            $this->db->where("pemasukan.tanggal BETWEEN '$startdate' and '$enddate'");
        $this->db->limit($limit, $offset);

        $query = $this->db->get($tabel);
        $data = $query->result_array();

        return $data;
    }

    function set_hidden($id_pemasukan)
    {
        $pemasukan = $this->get_single($this->tabel, $id_pemasukan, 'id_pemasukan');
        $id = $pemasukan['hidden'] ? 0 : 1;

        $this->db->where('id_pemasukan', $id_pemasukan);
        $this->db->update('pemasukan', array('hidden' => $id));

        return $this->db->affected_rows();
    }

    function get_single($tabel = 'pemasukan', $id, $field)
    {
        $data = array();

        $this->db->select('pemasukan.*, invoice.no_invoice');
        $this->db->join('invoice', 'invoice.id_invoice = pemasukan.id_invoice', 'left');

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
