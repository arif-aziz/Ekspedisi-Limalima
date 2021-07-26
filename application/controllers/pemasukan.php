<?php

class Pemasukan extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Pemasukan_Model', '', TRUE);
        $this->load->helper('date');
        $this->data['base'] = 3;
    }

    function index($offset = 0)
    {
        $this->load->library('pagination');
  
        $this->set_filter();

        $config['base_url'] = base_url() . 'pemasukan';
        $config['total_rows'] = $this->Pemasukan_Model->count_data('pemasukan');
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = 2;

        $this->data['pemasukan'] = $this->Pemasukan_Model->get_data('pemasukan', $config['per_page'], (int) $this->uri->segment(2));

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "pemasukan/index";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        if ($_POST)
        {
            $_POST['tanggal'] = date('Y-m-d h:i:s', now());
            $_POST['hidden'] = 0;
            $_POST['username'] = $this->session->userdata['username'];
            $hasil = $this->Pemasukan_Model->tambah('pemasukan', $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('pemasukan');
            }
        }

        $this->data['content'] = "pemasukan/form";
        $this->load->view("template", $this->data);
    }

    function edit($id_pemasukan)
    {

        if ($_POST)
        {
            $_POST['username'] = $this->session->userdata['username'];
            $hasil = $this->Pemasukan_Model->update('pemasukan', $id_pemasukan, $_POST, 'id_pemasukan');

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect('pemasukan');
            }
        }

        $this->data['pemasukan'] = $this->Pemasukan_Model->get_single('pemasukan', $id_pemasukan, 'id_pemasukan');
        $this->data['aksi'] = 1;
        $this->data['tinymce'] = 1;

        $this->data['content'] = "pemasukan/form";
        $this->load->view("template", $this->data);
    }

    function delete()
    {
        $id_pemasukan = $_POST['id'];

        $hasil = $this->Pemasukan_Model->delete('pemasukan', $id_pemasukan, 'id_pemasukan');

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function view($id_pemasukan)
    {
        $this->data['data'] = $this->Pemasukan_Model->get_single('pemasukan', $id_pemasukan, 'id_pemasukan');

        $this->data['content'] = "pemasukan/view";
        $this->load->view("template", $this->data);
    }

    function set_hidden()
    {
        $this->cek_superadmin();

        $id_pemasukan = $_POST['id'];
        $hasil = $this->Pemasukan_Model->set_hidden($id_pemasukan);

        echo $hasil;
    }

}
