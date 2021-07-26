<?php

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('uri') !== $this->uri->segment(1))
        {
            $this->_unset_all();
            $this->session->set_userdata('uri', $this->uri->segment(1));
        }
        else
        {
            if ($this->session->userdata('uri2') !== $this->uri->segment(2))
            {
                $this->_unset_all();
                $this->session->set_userdata('uri2', $this->uri->segment(2));
            }
        }

        if ($this->uri->segment(2) !== 'edit')
        {
            $this->session->set_userdata('current', uri_string());
        }

        if ($this->is_logged_in() === FALSE)
        {
            redirect('login');
        }

        //$this->output->enable_profiler(TRUE);
    }

    public function is_logged_in()
    {
        if ($this->session->userdata('login') === TRUE)
            return TRUE;
        else
            return FALSE;
    }

    public function is_super_admin()
    {
        if ($this->session->userdata('tipe') == 2)
            return TRUE;
        else
            return FALSE;
    }

    public function print_pre($obj)
    {
        echo "<pre>";
        print_r($obj);
        echo "</pre>";
    }

    public function clear()
    {
        $this->_unset_all();

        if ($this->uri->segment(2) == 'carimuatan')
            redirect('invoice/carimuatan');
        else
            redirect($this->session->userdata('uri'));
    }

    public function cek_superadmin()
    {
        if ($this->is_super_admin() === FALSE)
        {
            $message_403 = "Anda tidak memiliki akses untuk membuka alamat ini.";
            show_error($message_403, 403, "Forbidden Access!!!");
        }
    }

    public function set_filter()
    {
        //Cek session untuk pencarian
        if (isset($_POST['cari']))
            $this->session->set_userdata('filter', $_POST['cari']);
        if (isset($_POST['startdate']))
            $this->session->set_userdata('startdate', $_POST['startdate']);
        if (isset($_POST['enddate']))
            $this->session->set_userdata('enddate', $_POST['enddate']);
        if (isset($_POST['nama_pengirim']))
            $this->session->set_userdata('nama_pengirim', $_POST['nama_pengirim']);
        if (isset($_POST['id_pengirim']))
            $this->session->set_userdata('id_pengirim', $_POST['id_pengirim']);

        $data['filter'] = isset($this->session->userdata['filter']) ? $this->session->userdata['filter'] : NULL;
        $data['startdate'] = isset($this->session->userdata['startdate']) ? $this->session->userdata['startdate'] : NULL;
        $data['enddate'] = isset($this->session->userdata['enddate']) ? $this->session->userdata['enddate'] : NULL;
        $data['nama_pengirim'] = isset($this->session->userdata['nama_pengirim']) ? $this->session->userdata['nama_pengirim'] : NULL;
        $data['id_pengirim'] = isset($this->session->userdata['id_pengirim']) ? $this->session->userdata['id_pengirim'] : NULL;
    }

    private function _unset_all()
    {
        $this->session->unset_userdata('filter');
        $this->session->unset_userdata('startdate');
        $this->session->unset_userdata('enddate');
        $this->session->unset_userdata('nama_pengirim');
        $this->session->unset_userdata('id_pengirim');
    }

}
