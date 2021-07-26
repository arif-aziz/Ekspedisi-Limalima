<?php

class Ekspedisi_Model extends MY_Model {

    private $table = "ekspedisi";

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $this->db->insert($this->table, array("status" => 0));
        return $this->db->insert_id();
    }

    function count_data()
    {
        $fields = $this->db->list_fields($this->table);
        $filter = $this->session->userdata('filter');
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');

        //if ($tabel == 'ekspedisi' || $tabel == 'pemasukan' || $tabel == 'pengeluaran')
        //   $this->db->where('status', '1');

        $iterasi = 1;
        $num = count($fields);
        $where = "";
        foreach ($fields as $field)
        {
            if ($iterasi == 1)
            {
                $where .= "(ekspedisi." . $field . " LIKE '%" . $filter . "%' ";
            }
            else
            {
                $where .= "OR ekspedisi." . $field . " LIKE '%" . $filter . "%' ";
            }

            $iterasi++;
        }

        $where .= "OR asal.kota_asal LIKE '%" . $filter . "%' ";
        $where .= "OR tujuan.kota_tujuan LIKE '%" . $filter . "%' ";
        $where .= "OR kendaraan.nopol LIKE '%" . $filter . "%')";

        $this->db->where($where);
        $this->db->where_in('ekspedisi.status', array('1', '2'));
        if (!empty($startdate) && !empty($enddate))
            $this->db->where("tgl_muat BETWEEN '$startdate' and '$enddate'");

        $this->db->join('kendaraan', 'kendaraan.id_kendaraan = ekspedisi.id_kendaraan', 'left');
        $this->db->join('asal', 'asal.id_asal = ekspedisi.id_asal', 'left');
        $this->db->join('tujuan', 'tujuan.id_tujuan = ekspedisi.id_tujuan', 'left');

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_data($limit = NULL, $offset = NULL)
    {
        $fields = $this->db->list_fields($this->table);
        $filter = $this->session->userdata('filter');
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');

        //if ($tabel == 'ekspedisi' || $tabel == 'pemasukan' || $tabel == 'pengeluaran')
        //    $this->db->where('status', '1');

        $iterasi = 1;
        $num = count($fields);
        $where = "";
        foreach ($fields as $field)
        {
            if ($iterasi == 1)
            {
                $where .= "(ekspedisi." . $field . " LIKE '%" . $filter . "%' ";
            }
            else
            {
                $where .= "OR ekspedisi." . $field . " LIKE '%" . $filter . "%' ";
            }

            $iterasi++;
        }

        $where .= "OR asal.kota_asal LIKE '%" . $filter . "%' ";
        $where .= "OR tujuan.kota_tujuan LIKE '%" . $filter . "%' ";
        $where .= "OR kendaraan.nopol LIKE '%" . $filter . "%')";

        $this->db->select('ekspedisi.id_ekspedisi, ekspedisi.no_dm, ekspedisi.tgl_muat, ekspedisi.tgl_sampai, ekspedisi.ongkos, 
            ekspedisi.status, ekspedisi.hidden, tmuatan.total, asal.kota_asal, tujuan.kota_tujuan, tujuan.alias, kendaraan.nopol, 
            p1.nama_pegawai as nama_sopir, p2.nama_pegawai as nama_kernet');
        $this->db->join('(SELECT ekspedisi.id_ekspedisi, SUM(muatan.biaya) as total FROM ekspedisi, muatan 
            WHERE muatan.id_ekspedisi = ekspedisi.id_ekspedisi GROUP BY ekspedisi.id_ekspedisi) AS tmuatan', 'tmuatan.id_ekspedisi = ekspedisi.id_ekspedisi', 'left');
        $this->db->join('pegawai as p1', 'p1.id_pegawai = ekspedisi.sopir', 'left');
        $this->db->join('pegawai as p2', 'p2.id_pegawai = ekspedisi.kernet', 'left');
        $this->db->join('kendaraan', 'kendaraan.id_kendaraan = ekspedisi.id_kendaraan', 'left');
        $this->db->join('asal', 'asal.id_asal = ekspedisi.id_asal', 'left');
        $this->db->join('tujuan', 'tujuan.id_tujuan = ekspedisi.id_tujuan', 'left');
        $this->db->where($where);
        $this->db->where_in('ekspedisi.status', array('1', '2'));
        if (!empty($startdate))
            $this->db->where("tgl_muat BETWEEN '$startdate' and '$enddate'");

        $this->db->limit($limit, $offset);
        $query = $this->db->get($this->table);
        $data = $query->result_array();

        return $data;
    }

    function get_status($id_ekspedisi)
    {
        $data = array();

        $query = $this->db->get_where($this->table, array('id_ekspedisi' => $id_ekspedisi));
        $data = $query->row_array();

        return $data['status'];
    }

    function get_single($id, $field)
    {
        $data = array();

        $this->db->select('ekspedisi.*, asal.kota_asal, tujuan.kota_tujuan, tujuan.alias, kendaraan.nopol, p1.nama_pegawai as nama_sopir, p2.nama_pegawai as nama_kernet');
        $this->db->join('pegawai as p1', 'p1.id_pegawai = ekspedisi.sopir', 'left');
        $this->db->join('pegawai as p2', 'p2.id_pegawai = ekspedisi.kernet', 'left');
        $this->db->join('kendaraan', 'kendaraan.id_kendaraan = ekspedisi.id_kendaraan', 'left');
        $this->db->join('asal', 'asal.id_asal = ekspedisi.id_asal', 'left');
        $this->db->join('tujuan', 'tujuan.id_tujuan = ekspedisi.id_tujuan', 'left');

        $query = $this->db->get_where($this->table, array($field => $id));
        $data = $query->row_array();

        return $data;
    }

    function set_hidden($id_ekspedisi)
    {
        $pengeluaran = $this->get_single($id_ekspedisi, "id_ekspedisi");
        $id = $pengeluaran['hidden'] ? 0 : 1;

        $this->db->where('id_ekspedisi', $id_ekspedisi);
        $this->db->update($this->table, array('hidden' => $id));

        $this->db->flush_cache();

        $this->db->where('muatan.id_ekspedisi', $id_ekspedisi);
        $this->db->update('muatan', array('hidden' => $id));

        $this->db->flush_cache();

        $sql = "UPDATE invoice
                LEFT JOIN invoice_dt ON invoice_dt.id_invoice = invoice.id_invoice
                LEFT JOIN muatan ON muatan.id_muatan = invoice_dt.id_muatan
                SET invoice.hidden = $id WHERE muatan.status = 1 AND muatan.id_ekspedisi = $id_ekspedisi;";

        $query = $this->db->query($sql);

        return $this->db->affected_rows();
    }

    function cek_dm($dm)
    {
        $query = $this->db->get_where($this->table, array('no_dm' => $dm));
        return $query->num_rows() > 0 ? 'false' : 'true';
    }

    public function set_status($id_ekspedisi, $status)
    {
        $this->db->where('id_ekspedisi', $id_ekspedisi);
        $this->db->update($this->table, array("status" => $status));
    }

}
