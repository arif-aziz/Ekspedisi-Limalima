<?php

class Muatan_Model extends MY_Model {

    private $table = "muatan";

    public function __construct()
    {
        parent::__construct();
    }

    function get_single($id_muatan)
    {
        $data = array();

        $this->db->select('muatan.*, pengirim.nama_pengirim');
        $this->db->join('pengirim', 'pengirim.id_pengirim = muatan.id_pengirim', 'left');
        $query = $this->db->get_where($this->table, array('id_muatan' => $id_muatan));
        $data = $query->row_array();

        return $data;
    }

    function get_muatandt($id_muatan)
    {
        $data = array();

        $this->db->select('muatan_dt.*');
        $this->db->join('muatan', 'muatan.id_muatan = muatan_dt.id_muatan', 'left');
        $query = $this->db->get_where('muatan_dt', array('muatan.id_muatan' => $id_muatan));
        $data = $query->result_array();

        return $data;
    }

    public function get_muatan($id_ekspedisi)
    {
        $data = array();

        $query = $this->db->get_where('muatan', array('id_ekspedisi' => $id_ekspedisi));
        $data = $query->result_array();

        $iterasi = 0;

        foreach ($query->result() as $muatan)
        {
            $data[$iterasi]['nama_pengirim'] = $this->_get_nama_pengirim($muatan->id_pengirim);
            $iterasi++;
        }

        return $data;
    }

    function _get_nama_pengirim($id_pengirim)
    {
        $query = $this->db->get_where('pengirim', array('id_pengirim' => $id_pengirim));
        $hasil = $query->row_array();

        return $hasil['nama_pengirim'];
    }

    function get_muat_ekspedisi($id_ekspedisi)
    {
        $data = array();

        $this->db->select('muatan.*, pengirim.nama_pengirim, ekspedisi.tgl_muat, asal.kota_asal, asal.alias, tujuan.kota_tujuan, tujuan.alias');
        $this->db->join('pengirim', 'pengirim.id_pengirim = muatan.id_pengirim', 'left');
        $this->db->join('ekspedisi', 'ekspedisi.id_ekspedisi = muatan.id_ekspedisi', 'left');
        $this->db->join('asal', 'asal.id_asal = ekspedisi.id_asal', 'left');
        $this->db->join('tujuan', 'tujuan.id_tujuan = ekspedisi.id_tujuan', 'left');
        $this->db->where('ekspedisi.id_ekspedisi', $id_ekspedisi);

        $query = $this->db->get('muatan');
        $data = $query->result_array();

        return $data;
    }

    function get_muat_invoice($muatan = NULL)
    {
        $data = array();

        $fields = $this->db->list_fields('muatan');
        $filter = $this->session->userdata('filter');
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');
        $nama_pengirim = $this->session->userdata('nama_pengirim');
        $id_pengirim = $this->session->userdata('id_pengirim');

        $iterasi = 1;
        $num = count($fields);
        $where = "";
        foreach ($fields as $field)
        {
            if ($iterasi == 1)
            {
                $where .= "(muatan." . $field . " LIKE '%" . $filter . "%' ";
            }
            else
            {
                $where .= "OR muatan." . $field . " LIKE '%" . $filter . "%' ";
            }

            $iterasi++;
        }

        $where .= "OR tujuan.kota_tujuan LIKE '%" . $filter . "%' ";
        $where .= "OR asal.kota_asal LIKE '%" . $filter . "%' ";
        $where .= "OR tujuan.alias LIKE '%" . $filter . "%' ";
        $where .= "OR asal.alias LIKE '%" . $filter . "%' ";
        $where .= "OR pengirim.nama_pengirim LIKE '%" . $filter . "%') ";

        $this->db->select('muatan.*, pengirim.nama_pengirim, ekspedisi.tgl_muat, asal.kota_asal, asal.alias, tujuan.kota_tujuan, tujuan.alias');
        $this->db->join('pengirim', 'pengirim.id_pengirim = muatan.id_pengirim', 'left');
        $this->db->join('ekspedisi', 'ekspedisi.id_ekspedisi = muatan.id_ekspedisi', 'left');
        $this->db->join('asal', 'asal.id_asal = ekspedisi.id_asal', 'left');
        $this->db->join('tujuan', 'tujuan.id_tujuan = ekspedisi.id_tujuan', 'left');
        $this->db->where($where);
        $this->db->where('muatan.status', '0');
        $this->db->where('ekspedisi.status', '2');

        if (!empty($id_pengirim))
            $this->db->where("muatan.id_pengirim", $id_pengirim);
        if (!empty($startdate) && !empty($enddate))
            $this->db->where("tgl_muat BETWEEN '$startdate' and '$enddate' ");
        if (!empty($muatan))
            $this->db->where_in("muatan.id_muatan", $muatan);


        $query = $this->db->get('muatan');
        $data = $query->result_array();

        return $data;
    }

    function get_nilai($muatan)
    {
        $this->db->select("SUM(biaya) as nilai");
        $this->db->where_in("id_muatan", $muatan);
        $hasil = $this->db->get('muatan')->row_array();

        return $hasil['nilai'];
    }

    function get_group_tujuan($muatan)
    {
        $this->db->select('ekspedisi.id_tujuan, SUM(muatan.berat) as berat_total, SUM(muatan.biaya) as total, tujuan.kota_tujuan, tujuan.alias');
        $this->db->distinct();
        $this->db->join('muatan', 'muatan.id_ekspedisi = ekspedisi.id_ekspedisi', 'left');
        $this->db->join('tujuan', 'tujuan.id_tujuan = ekspedisi.id_tujuan', 'left');
        $this->db->where_in('muatan.id_muatan', $muatan);
        $this->db->group_by('ekspedisi.id_tujuan');
        $hasil = $this->db->get('ekspedisi');

        return $hasil->result_array();
    }

    function get_muat_per_tujuan($groups, $muatan = NULL)
    {
        $data = array();

        foreach ($groups as $group)
        {

            $fields = $this->db->list_fields('muatan');
            $filter = $this->session->userdata('filter');
            $startdate = $this->session->userdata('startdate');
            $enddate = $this->session->userdata('enddate');
            $nama_pengirim = $this->session->userdata('nama_pengirim');
            $id_pengirim = $this->session->userdata('id_pengirim');

            $iterasi = 1;
            $num = count($fields);
            $where = "";
            foreach ($fields as $field)
            {
                if ($iterasi == 1)
                {
                    $where .= "(muatan." . $field . " LIKE '%" . $filter . "%' ";
                }
                else
                {
                    $where .= "OR muatan." . $field . " LIKE '%" . $filter . "%' ";
                }

                $iterasi++;
            }

            $where .= "OR tujuan.kota_tujuan LIKE '%" . $filter . "%' ";
            $where .= "OR asal.kota_asal LIKE '%" . $filter . "%' ";
            $where .= "OR tujuan.alias LIKE '%" . $filter . "%' ";
            $where .= "OR asal.alias LIKE '%" . $filter . "%' ";
            $where .= "OR pengirim.nama_pengirim LIKE '%" . $filter . "%') ";

            $this->db->select('muatan.*, pengirim.nama_pengirim, ekspedisi.tgl_muat, asal.kota_asal, asal.alias, tujuan.kota_tujuan, tujuan.alias');
            $this->db->join('pengirim', 'pengirim.id_pengirim = muatan.id_pengirim', 'left');
            $this->db->join('ekspedisi', 'ekspedisi.id_ekspedisi = muatan.id_ekspedisi', 'left');
            $this->db->join('asal', 'asal.id_asal = ekspedisi.id_asal', 'left');
            $this->db->join('tujuan', 'tujuan.id_tujuan = ekspedisi.id_tujuan', 'left');
            $this->db->where($where);
            $this->db->where('muatan.status', '0');
            $this->db->where('ekspedisi.status', '2');
            $this->db->where('ekspedisi.id_tujuan', $group['id_tujuan']);

            if (!empty($id_pengirim))
                $this->db->where("muatan.id_pengirim", $id_pengirim);
            if (!empty($startdate) && !empty($enddate))
                $this->db->where("tgl_muat BETWEEN '$startdate' and '$enddate' ");
            if (!empty($muatan))
                $this->db->where_in("muatan.id_muatan", $muatan);

            $query = $this->db->get('muatan');
            $data[$group['id_tujuan']] = $query->result_array();
        }
        return $data;
    }

    function cek_sm($sm)
    {
        $query = $this->db->get_where($this->table, array('no_sm' => $sm));
        return $query->num_rows() > 0 ? 'false' : 'true';
    }

    function clean()
    {
        $this->db->query("DELETE muatan_dt.* FROM muatan_dt 
            LEFT JOIN muatan ON muatan.id_muatan = muatan_dt.id_muatan 
            LEFT JOIN ekspedisi ON ekspedisi.id_ekspedisi = muatan.id_ekspedisi 
            WHERE ekspedisi.status = 0 AND ekspedisi.id_ekspedisi <> " . $this->session->userdata('id_ekspedisi'));

        $this->db->query("DELETE muatan.* FROM muatan LEFT JOIN ekspedisi ON ekspedisi.id_ekspedisi = muatan.id_ekspedisi 
            WHERE ekspedisi.status = 0 AND ekspedisi.id_ekspedisi <> " . $this->session->userdata('id_ekspedisi'));
    }

    function tambah($tabel, $data)
    {
        $this->db->insert($tabel, $data);

        return $this->db->insert_id();
    }

    public function set_status($id_muatan, $status)
    {
        $this->db->where('id_muatan', $id_muatan);
        $this->db->update($this->table, array("status" => $status));
    }

}
