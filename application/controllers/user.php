<?php

class User extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        if ($this->is_super_admin() === FALSE)
        {
            $message_403 = "Anda tidak memiliki akses untuk membuka alamat ini.";
            show_error($message_403, 403, "Forbidden Access!!!");
        }

        $this->load->model('User_Model', '', TRUE);
        $this->data['base'] = 6;
        $this->load->library('encrypt');
    }

    function index()
    {
        $this->load->library('pagination');

        if (isset($_POST['cari']))
            $this->session->set_userdata('filter', $_POST['cari']);

        $filter = isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : NULL;

        $config['base_url'] = base_url() . 'user';
        $config['total_rows'] = $this->User_Model->count_data('user', $filter);
        $config['per_page'] = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
        $config['uri_segment'] = '3';

        $this->data['user'] = $this->User_Model->get_data('user', $config['per_page'], (int) $this->uri->segment(3), $filter);

        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();

        $this->data['content'] = "user/index";
        $this->load->view("template", $this->data);
    }

    function tambah()
    {
        $this->data['aksi'] = 0;

        if ($_POST)
        {
            $_POST['password'] = $this->encrypt->encode(md5($_POST['password']));
            $hasil = $this->User_Model->tambah('user', $_POST);

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil dimasukkan.</div>');
                redirect('user');
            }
        }

        $this->data['content'] = "user/form";
        $this->load->view("template", $this->data);
    }

    function edit($username)
    {

        if ($_POST)
        {
            $hasil = $this->User_Model->update('user', $username, $_POST, 'username');

            if ($hasil)
            {
                $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                redirect('user');
            }
        }


        $this->data['user'] = $this->User_Model->get_single('user', $username, 'username');
        $this->data['aksi'] = 1;
        $this->data['tinymce'] = 1;

        $this->data['content'] = "user/form";
        $this->load->view("template", $this->data);
    }

    function delete()
    {
        $username = $_POST['id'];

        $hasil = $this->User_Model->delete('user', $username, 'username');

        if ($hasil)
        {
            $this->session->set_flashdata('message', '<div id="message">Data berhasil dihapus.</div>');
        }
    }

    function gantipass($username)
    {
        if ($_POST)
        {
            if ($_POST['password'] == $_POST['confirm'])
            {
                unset($_POST['confirm']);
                $_POST['password'] = $this->encrypt->encode(md5($_POST['password']));

                $hasil = $this->User_Model->update('user', $username, $_POST, 'username');

                if ($hasil)
                {
                    $this->session->set_flashdata('message', '<div id="message">Data berhasil diupdate.</div>');
                    redirect('user');
                }
            }
        }

        $this->data['user'] = $this->User_Model->get_single('user', $username, 'username');

        $this->data['content'] = "user/gantipass";
        $this->load->view("template", $this->data);
    }

    function view($username)
    {
        $this->data['data'] = $this->User_Model->get_single('user', $username, 'username');

        $this->data['content'] = "user/view";
        $this->load->view("template", $this->data);
    }

    function histori($username)
    {
        
    }

    function set_status($username)
    {
        $hasil = $this->User_Model->set_status($username);
    }

}
