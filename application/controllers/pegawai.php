<?php

class Pegawai extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_Model', '', TRUE);
        $this->data['base'] = 6;
    }

    function index()
    {
        $this->load->library('pagination');

        if (isset($_POST['cari']))
            $this->session->set_userdata('filter', $_POST['cari']);

        $filter = isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : NULL;

        $config['base_url'] = base_url() . 'pegawai';
        $config['total_rows'] = $this->Pegawai_Model->count_data('pegawai', $filter);
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = '3';

        $this->data['pegawai'] = $this->Pegawai_Model->get_data('pegawai', $config['per_page'], (int) $this->uri->segment(3), $filter);

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "pegawai/index";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        if ($_POST)
        {
            $hasil = $this->Pegawai_Model->tambah('pegawai', $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('pegawai');
            }
        }

        $this->data['content'] = "pegawai/form";
        $this->load->view("template", $this->data);
    }

    function edit($id_pegawai)
    {

        if ($_POST)
        {
            $hasil = $this->Pegawai_Model->update('pegawai', $id_pegawai, $_POST, 'id_pegawai');

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect('pegawai');
            }
        }


        $this->data['pegawai'] = $this->Pegawai_Model->get_single('pegawai', $id_pegawai, 'id_pegawai');
        $this->data['aksi'] = 1;
        $this->data['tinymce'] = 1;

        $this->data['content'] = "pegawai/form";
        $this->load->view("template", $this->data);
    }

    function delete()
    {
        $id_pegawai = $_POST['id'];
       
        $hasil = $this->Pegawai_Model->delete('pegawai', $id_pegawai, 'id_pegawai');

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function view($id_pegawai)
    {
        $this->data['data'] = $this->Pegawai_Model->get_single('pegawai', $id_pegawai, 'id_pegawai');

        $this->data['content'] = "pegawai/view";
        $this->load->view("template", $this->data);
    }
    
    function histori($id_pegawai)
    {
        
    }

    function set_status($id_pegawai)
    {
        $hasil = $this->Pegawai_Model->set_status($id_pegawai);
    }

}
