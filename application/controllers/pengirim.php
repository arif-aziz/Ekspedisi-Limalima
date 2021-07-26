<?php

class Pengirim extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengirim_Model', '', TRUE);
        $this->data['base'] = 6;
    }

    function index()
    {
        $this->load->library('pagination');

        if (isset($_POST['cari']))
            $this->session->set_userdata('filter', $_POST['cari']);

        $filter = isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : NULL;

        $config['base_url'] = base_url() . 'pengirim';
        $config['total_rows'] = $this->Pengirim_Model->count_data('pengirim', $filter);
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = '3';

        $this->data['pengirim'] = $this->Pengirim_Model->get_data('pengirim', $config['per_page'], (int) $this->uri->segment(3), $filter);

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "pengirim/index";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        if ($_POST)
        {
            $hasil = $this->Pengirim_Model->tambah('pengirim', $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('pengirim');
            }
        }
        
        $this->data['asal'] = $this->Pengirim_Model->get_all_data('asal');
        $this->data['content'] = "pengirim/form";
        $this->load->view("template", $this->data);
    }

    function edit($id_pengirim)
    {

        if ($_POST)
        {
            $hasil = $this->Pengirim_Model->update('pengirim', $id_pengirim, $_POST, 'id_pengirim');

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect('pengirim');
            }
        }

        $this->data['pengirim'] = $this->Pengirim_Model->get_single('pengirim', $id_pengirim, 'id_pengirim');
        $this->data['aksi'] = 1;
        $this->data['tinymce'] = 1;
        
        $this->data['asal'] = $this->Pengirim_Model->get_all_data('asal');
        $this->data['content'] = "pengirim/form";
        $this->load->view("template", $this->data);
    }

    function delete()
    {
        $id_pengirim = $_POST['id'];
       
        $hasil = $this->Pengirim_Model->delete('pengirim', $id_pengirim, 'id_pengirim');

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function view($id_pengirim)
    {
        $this->data['data'] = $this->Pengirim_Model->get_single('pengirim', $id_pengirim, 'id_pengirim');

        $this->data['content'] = "pengirim/view";
        $this->load->view("template", $this->data);
    }
    
    function histori($id_pengirim)
    {
        
    }

    function set_status($id_pengirim)
    {
        $hasil = $this->Pengirim_Model->set_status($id_pengirim);
    }

}
