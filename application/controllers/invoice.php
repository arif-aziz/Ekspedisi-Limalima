<?php

class Invoice extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Invoice_Model', '', TRUE);
        $this->load->model('Muatan_Model', '', TRUE);
        $this->load->model('Pengirim_Model', '', TRUE);
        $this->data['base'] = 5;
    }

    function index()
    {
        $this->load->library('pagination');

        $this->set_filter();

        $config['base_url'] = base_url() . 'invoice';
        $config['total_rows'] = $this->Invoice_Model->count_data('invoice');
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = '3';

        $this->data['invoice'] = $this->Invoice_Model->get_data('invoice', $config['per_page'], (int) $this->uri->segment(3));

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "invoice/index";
        $this->load->view("template", $this->data);
    }

    function edit($id_invoice)
    {

        if ($_POST)
        {
            $hasil = $this->Invoice_Model->update($id_invoice, $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect('invoice');
            }
        }


        $this->data['invoice'] = $this->Invoice_Model->get_invoice($id_invoice);
        $this->data['aksi'] = 1;

        $this->data['content'] = "invoice/form";
        $this->load->view("template", $this->data);
    }

    function delete($id_invoice)
    {
        $hasil = $this->Invoice_Model->delete($id_invoice);

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function set_status($id_invoice)
    {
        $hasil = $this->Invoice_Model->set_status($id_invoice);
    }

    function carimuatan()
    {
        $this->set_filter();

        if ($_POST)
        {
            if (!empty($_POST['id_pengirim']))
                $this->data['muatan'] = $this->Muatan_Model->get_muat_invoice();
            else
            {
                $this->session->set_flashdata('message', '<div id="message">Pilih Pengirim</div>');
                redirect('invoice/carimuatan');
            }
        }

        $this->data['content'] = "invoice/muatan";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        if ($_POST)
        {
            $this->data['tujuan'] = $this->Muatan_Model->get_group_tujuan($_POST['checkmuatan']);
            $this->data['muatan'] = $this->Muatan_Model->get_muat_per_tujuan($this->data['tujuan'], $_POST['checkmuatan']);
            $this->data['nilai'] = $this->Muatan_Model->get_nilai($_POST['checkmuatan']);
            $this->data['id_pengirim'] = $_POST['id_pengirim'];
            $this->data['nama_pengirim'] = $this->Pengirim_Model->get_nama($_POST['id_pengirim']);
            $this->session->set_userdata("muatan", $_POST['checkmuatan']);
        }
        else
        {
            redirect('invoice/carimuatan');
        }

        $this->data['aksi'] = 0;
        $this->data['content'] = "invoice/form";
        $this->load->view("template", $this->data);
    }

    function simpan()
    {
        $_POST['user_input'] = $this->session->userdata('username');
        $_POST['status'] = 0;
        $_POST['hidden'] = 0;
        $id_invoice = $this->Invoice_Model->tambah('invoice', $_POST);
        
        foreach($this->session->userdata('muatan') as $muatan)
        {
            $id = $this->Invoice_Model->tambah('invoice_dt', array('id_invoice' => $id_invoice, 'id_muatan' => $muatan));
            $this->Muatan_Model->set_status($id_muatan, '1');
        }
        
        redirect('invoice');
    }

}
