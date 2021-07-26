<?php

class Pengeluaran extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengeluaran_Model', '', TRUE);
        $this->load->helper('date');
        $this->data['base'] = 4;
    }

    function index()
    {
        $this->load->library('pagination');
        
        $this->set_filter();

        $config['base_url'] = base_url() . 'pengeluaran';
        $config['total_rows'] = $this->Pengeluaran_Model->count_data('pengeluaran');
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = 2;

        $this->data['pengeluaran'] = $this->Pengeluaran_Model->get_data('pengeluaran', $config['per_page'], (int) $this->uri->segment(2));

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "pengeluaran/index";
        $this->load->view("template", $this->data);
    }

    function edit($id_pengeluaran)
    {

        if ($_POST)
        {
            $_POST['username'] = $this->session->userdata['username'];
            unset($_POST['nama_pegawai']);
            unset($_POST['nopol']);
            unset($_POST['nama_bengkel']);
            $hasil = $this->Pengeluaran_Model->update('pengeluaran', $id_pengeluaran, $_POST, 'id_pengeluaran');

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect($this->session->userdata('current'));
            }
            else
                redirect($this->session->userdata('current'));
        }


        $this->data['pengeluaran'] = $this->Pengeluaran_Model->get_single($id_pengeluaran, 'id_pengeluaran');
        $this->data['aksi'] = 1;
        $this->data['tinymce'] = 1;

        $this->data['content'] = "pengeluaran/form";
        $this->load->view("template", $this->data);
    }

    function delete($id_pengeluaran)
    {
        $hasil = $this->Pengeluaran_Model->delete($id_pengeluaran);

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        if ($_POST)
        {
            $_POST['tanggal'] = date('Y-m-d h:i:s', now());
            $_POST['hidden'] = 0;
            $_POST['username'] = $this->session->userdata['username'];
            unset($_POST['nama_pegawai']);
            unset($_POST['nopol']);
            unset($_POST['nama_bengkel']);
            $hasil = $this->Pengeluaran_Model->tambah('pengeluaran', $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('pengeluaran');
            }
        }

        $this->data['content'] = "pengeluaran/form";
        $this->load->view("template", $this->data);
    }
    
    function view($id_pengeluaran)
    {
        $this->data['data'] = $this->Pengeluaran_Model->get_single($id_pengeluaran, 'id_pengeluaran');

        $this->data['content'] = "pengeluaran/view";
        $this->load->view("template", $this->data);
    }
    

    function set_hidden()
    {
        $this->cek_superadmin();

        $id_pengeluaran = $_POST['id'];
        $hasil = $this->Pengeluaran_Model->set_hidden($id_pengeluaran);

        echo $hasil;
    }

}
