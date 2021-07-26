<?php

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model', '', TRUE);
        $this->load->library('encrypt');
        
        //$this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        if ($this->is_logged_in())
            redirect('/');
        else
            $this->load->view('login');
    }

    public function cek_login()
    {
        if (!isset($_POST['username']))
            redirect('/');

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $hasil = $this->User_Model->cek_user($username, $password);
        if ($hasil['ada'])
        {
            $user = $this->User_Model->get_user($username);
            $data = array('username' => $user['username'], 'tipe' => $user['tipe'], 'login' => TRUE);
            $this->session->set_userdata($data);
            redirect('/'.$this->session->userdata['current']);
        }
        else
        {
            $this->session->set_flashdata('message', 'Username / Password salah.<br /> Mohon diulangi');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function is_logged_in()
    {
        if ($this->session->userdata('login') === TRUE)
            return TRUE;
        else
            return FALSE;
    }

}
