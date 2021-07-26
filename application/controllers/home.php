<?php

class Home extends MY_Controller {

    var $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['base'] = 1;
    }

    public function index()
    {
//        if ($this->is_logged_in() === FALSE)
//            redirect('login');

        $this->data['content'] = "home";
        $this->load->view('template', $this->data);
    }

}

