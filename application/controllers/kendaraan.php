<?php

class Kendaraan extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Kendaraan_Model', '', TRUE);
        $this->data['base'] = 6;
    }

    function index()
    {
        $this->load->library('pagination');

        if (isset($_POST['cari']))
            $this->session->set_userdata('filter', $_POST['cari']);

        $filter = isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : NULL;

        $config['base_url'] = base_url() . 'kendaraan';
        $config['total_rows'] = $this->Kendaraan_Model->count_data('kendaraan', $filter);
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = '3';

        $this->data['kendaraan'] = $this->Kendaraan_Model->get_data('kendaraan', $config['per_page'], (int) $this->uri->segment(3), $filter);

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "kendaraan/index";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        if ($_POST)
        {
            $hasil = $this->Kendaraan_Model->tambah('kendaraan', $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('kendaraan');
            }
        }

        $this->data['content'] = "kendaraan/form";
        $this->load->view("template", $this->data);
    }

    function edit($id_kendaraan)
    {

        if ($_POST)
        {
            $hasil = $this->Kendaraan_Model->update('kendaraan', $id_kendaraan, $_POST, 'id_kendaraan');

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect('kendaraan');
            }
        }


        $this->data['kendaraan'] = $this->Kendaraan_Model->get_single('kendaraan', $id_kendaraan, 'id_kendaraan');
        $this->data['aksi'] = 1;
        $this->data['tinymce'] = 1;

        $this->data['content'] = "kendaraan/form";
        $this->load->view("template", $this->data);
    }

    function delete()
    {
        $id_kendaraan = $_POST['id'];

        $hasil = $this->Kendaraan_Model->delete('kendaraan', $id_kendaraan, 'id_kendaraan');

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function view($id_kendaraan)
    {
        $this->data['data'] = $this->Kendaraan_Model->get_single('kendaraan', $id_kendaraan, 'id_kendaraan');

        $this->data['content'] = "kendaraan/view";
        $this->load->view("template", $this->data);
    }

    function histori($id_kendaraan)
    {
        if ($_POST)
        {
            $this->data['grkeluar'] = $this->Kendaraan_Model->get_group_pengeluaran($id_kendaraan, $_POST);
            $this->data['pengeluaran'] = $this->Kendaraan_Model->get_pengeluaran($id_kendaraan, $this->data['grkeluar'], $_POST);

            $this->data['grmasuk'] = $this->Kendaraan_Model->get_group_pemasukan($id_kendaraan, $_POST);
            $this->data['pemasukan'] = $this->Kendaraan_Model->get_pemasukan($id_kendaraan, $this->data['grmasuk'], $_POST);

        }

        $this->data['kendaraan'] = $this->Kendaraan_Model->get_single('kendaraan', $id_kendaraan, 'id_kendaraan');

        $this->data['content'] = "kendaraan/histori";
        $this->load->view("template", $this->data);
    }

    function set_status($id_kendaraan)
    {
        $hasil = $this->Kendaraan_Model->set_status($id_kendaraan);
    }

}
