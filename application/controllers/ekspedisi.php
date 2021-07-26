<?php

class Ekspedisi extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Ekspedisi_Model', '', TRUE);
        $this->load->model('Muatan_Model', '', TRUE);
        $this->load->model('Pegawai_Model', '', TRUE);
        $this->load->model('Kendaraan_Model', '', TRUE);
        $this->load->helper('date');
        $this->data['base'] = 2;
    }

    function index()
    {
        $this->load->library('pagination');

        $filter = $this->set_filter();

        //pagination config
        $config['base_url'] = base_url() . 'ekspedisi';
        $config['total_rows'] = $this->Ekspedisi_Model->count_data();
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = '3';

        $this->data['ekspedisi'] = $this->Ekspedisi_Model->get_data($config['per_page'], (int) $this->uri->segment(3));
        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        //tampilkan
        $this->data['content'] = "ekspedisi/index";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        //Cek ekspedisi session
        if (isset($this->session->userdata['id_ekspedisi']))
        {
            $hasil = $this->Ekspedisi_Model->get_status($this->session->userdata['id_ekspedisi']);
            if ($hasil)
            {
                $id_ekspedisi = $this->Ekspedisi_Model->create();
                $this->session->set_userdata('id_ekspedisi', $id_ekspedisi);
            }
            $this->data['muatan'] = $this->Muatan_Model->get_muat_ekspedisi($this->session->userdata('id_ekspedisi'));
        }
        else
        {
            $id_ekspedisi = $this->Ekspedisi_Model->create();
            $this->session->set_userdata('id_ekspedisi', $id_ekspedisi);
        }

        $this->Muatan_Model->clean();

        if ($_POST)
        {
            unset($_POST['nopol']);
            unset($_POST['kota_asal']);
            unset($_POST['kota_tujuan']);
            unset($_POST['nama_sopir']);
            unset($_POST['nama_kernet']);

            $_POST['tgl_input'] = date('Y-m-d h:i:s', now());
            $_POST['status'] = 1;
            $_POST['hidden'] = 0;
            $_POST['username'] = $this->session->userdata('username');
            $hasil = $this->Ekspedisi_Model->update('ekspedisi', $this->session->userdata('id_ekspedisi'), $_POST, 'id_ekspedisi');

            $this->Pegawai_Model->add_tabungan($_POST['sopir']);
            $this->Pegawai_Model->add_tabungan($_POST['kernet']);
            $this->Pegawai_Model->set_status($_POST['sopir'], 1);
            $this->Pegawai_Model->set_status($_POST['kernet'], 1);
            $this->Kendaraan_Model->set_status($_POST['id_kendaraan'], 1);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('ekspedisi');
            }
        }

        $this->data['content'] = "ekspedisi/form";
        $this->load->view("template", $this->data);
    }

    function view($id_ekspedisi)
    {
        $this->data['ekspedisi'] = $this->Ekspedisi_Model->get_single($id_ekspedisi, 'ekspedisi.id_ekspedisi');
        $this->data['muatan'] = $this->Muatan_Model->get_muat_ekspedisi($id_ekspedisi);

        $this->data['content'] = "ekspedisi/view";
        $this->load->view("template", $this->data);
    }

    function complete($id_ekspedisi)
    {
        $ekspedisi = $this->Ekspedisi_Model->get_single($id_ekspedisi, 'id_ekspedisi');
        
        $this->Pegawai_Model->set_status($ekspedisi['sopir'], 0);
        $this->Pegawai_Model->set_status($ekspedisi['kernet'], 0);
        $this->Kendaraan_Model->set_status($ekspedisi['id_kendaraan'], 0);
        
        $this->Ekspedisi_Model->update('ekspedisi', $id_ekspedisi, 
                array(
                    "status" => "2",
                    "user_complete" => $this->session->userdata('username'), 
                    "tgl_complete" => date('Y-m-d h:i:s', now())
                    ), 'id_ekspedisi');
        
            redirect("ekspedisi");
        
    }

    function set_hidden()
    {
        $this->cek_superadmin();

        $id_ekspedisi = $_POST['id'];
        $hasil = $this->Ekspedisi_Model->set_hidden($id_ekspedisi);

        echo $hasil;
    }

    function cek_dm()
    {
        $dm = $_GET['no_dm'];
        $hasil = $this->Ekspedisi_Model->cek_dm($dm);
        echo $hasil;
    }

}
