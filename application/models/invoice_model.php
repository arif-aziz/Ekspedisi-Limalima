<?php

class Invoice_Model extends MY_Model {
    
    private $table = "invoice";

    public function __construct()
    {
        parent::__construct();
    }

    function cek_invoice($invoice)
    {
        $query = $this->db->get_where($this->table, array('no_invoice' => $invoice));
        return $query->num_rows() > 0 ? 'false' : 'true';
    }
    
}
