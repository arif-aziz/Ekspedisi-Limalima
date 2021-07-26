<?php

class User_Model extends MY_Model {
    
    var $tabel = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    function cek_user($username, $password)
    {
        $data = $this->get_user($username);
        $hasil = array();
        $hasil['ada'] = FALSE;
        if($data)
        {
            if($this->encrypt->decode($data['password']) == $password)
            {
                $hasil['ada'] = TRUE;
            }
        }

        return $hasil;
    }

    function get_user($username)
    {
        $query = $this->db->get_where($this->tabel, array('username' => $username), 1, 0);
        return $query->row_array();
    }

}
