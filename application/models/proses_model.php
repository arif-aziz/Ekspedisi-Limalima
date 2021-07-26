<?php

class Proses_Model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function count_cb_data($searchTerm, $table, $field, $status = 0)
    {
        $sql = "SELECT COUNT(*) AS count FROM $table";

        if ($searchTerm !== '')
        {
            $sql .= " WHERE $field like '$searchTerm'";
            if ($status)
                $sql .= " AND status = 0";
        }
        else
        {
            if ($status)
                $sql .= " WHERE status = 0";
        }


        $query = $this->db->query($sql);

        return $query->row();
    }

    public function get_data($searchTerm, $sidx, $sord, $start, $limit, $table, $field, $status = 0)
    {
        $sql = "SELECT * FROM $table";

        if ($searchTerm !== '')
        {
            $sql .= " WHERE $field like '$searchTerm'";
            if ($status)
                $sql .= " AND status = 0";
        }
        else
        {
            if ($status)
                $sql .= " WHERE status = 0";
        }

        if ($sidx !== '')
            $sql .= " ORDER BY $sidx $sord";

        $sql .= " LIMIT $start , $limit";

        $query = $this->db->query($sql);

        return $query->result();
    }

}
