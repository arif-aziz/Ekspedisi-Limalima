<?php

class Muatan extends MY_Controller {

    var $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muatan_Model', '', TRUE);
        $this->data['base'] = 2;
    }

    public function index()
    {
        $this->data['aksi'] = 0;
        $this->load->view("muatan/form", $this->data);
    }

    public function tambah()
    {
        if ($_POST)
        {
            $_POST['id_ekspedisi'] = $this->session->userdata('id_ekspedisi');
            $hasil = $this->Muatan_Model->tambah('muatan', $_POST);

            echo $hasil;
        }
    }

    function delete()
    {
        $id_muatan = $_POST['id'];

        $hasil = $this->Muatan_Model->delete('muatan', $id_muatan, 'id_muatan');

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    public function tambah_dt()
    {
        if ($_POST)
        {
            $hasil = $this->Muatan_Model->tambah('muatan_dt', $_POST);

            echo $hasil;
        }
    }

    public function get_muatan()
    {
        $hasil = $this->Muatan_Model->get_muatan($this->session->userdata('id_ekspedisi'));

        echo json_encode($hasil);
    }

    function cek_sm()
    {
        $sm = $_GET['no_sm'];
        $hasil = $this->Muatan_Model->cek_sm($sm);
        echo $hasil;
    }

    public function view($id_muatan)
    {
        $this->data['muatan'] = $this->Muatan_Model->get_single($id_muatan);
        $this->data['muatandt'] = $this->Muatan_Model->get_muatandt($id_muatan);

        $this->data['content'] = "muatan/view";
        $this->load->view("template", $this->data);
    }

}
