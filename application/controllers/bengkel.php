<?php

class Bengkel extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Bengkel_Model', '', TRUE);
        $this->data['base'] = 6;
    }

    function index()
    {
        $this->load->library('pagination');

        if (isset($_POST['cari']))
            $this->session->set_userdata('filter', $_POST['cari']);

        $filter = isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : NULL;

        $config['base_url'] = base_url() . 'bengkel';
        $config['total_rows'] = $this->Bengkel_Model->count_data('bengkel', $filter);
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = '3';

        $this->data['bengkel'] = $this->Bengkel_Model->get_data('bengkel', $config['per_page'], (int) $this->uri->segment(3), $filter);

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "bengkel/index";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        if ($_POST)
        {
            $hasil = $this->Bengkel_Model->tambah('bengkel', $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('bengkel');
            }
        }

        $this->data['content'] = "bengkel/form";
        $this->load->view("template", $this->data);
    }

    function edit($id_bengkel)
    {

        if ($_POST)
        {
            $hasil = $this->Bengkel_Model->update('bengkel', $id_bengkel, $_POST, 'id_bengkel');

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect('bengkel');
            }
        }


        $this->data['bengkel'] = $this->Bengkel_Model->get_single('bengkel', $id_bengkel, 'id_bengkel');
        $this->data['aksi'] = 1;
        $this->data['tinymce'] = 1;

        $this->data['content'] = "bengkel/form";
        $this->load->view("template", $this->data);
    }

    function delete()
    {
        $id_bengkel = $_POST['id'];
       
        $hasil = $this->Bengkel_Model->delete('bengkel', $id_bengkel, 'id_bengkel');

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function view($id_bengkel)
    {
        $this->data['data'] = $this->Bengkel_Model->get_single('bengkel', $id_bengkel, 'id_bengkel');

        $this->data['content'] = "bengkel/view";
        $this->load->view("template", $this->data);
    }
    
    function histori($id_bengkel)
    {
        
    }

    function set_status($id_bengkel)
    {
        $hasil = $this->Bengkel_Model->set_status($id_bengkel);
    }

}
