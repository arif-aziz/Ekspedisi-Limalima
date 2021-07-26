<?php

class Proses extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proses_Model', '', TRUE);
    }

    public function get_data()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = isset($_GET['rows']) ? $_GET['rows'] : 10;
        $sidx = isset($_GET['sidx']) ? $_GET['sidx'] : '';
        $sord = isset($_GET['sidx']) ? $_GET['sord'] : 'asc'; // get the direction
        $table = $_GET['table'];
        $status = isset($_GET['status']) ? $_GET['status'] : 0;
        $field = isset($_GET['field']) ? $_GET['field'] : 'nama';

        $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

        if (!$sidx)
            $sidx = 1;

        if ($searchTerm !== "")
        {
            $searchTerm = "%" . $searchTerm . "%";
        }

        $count = $this->Proses_Model->count_cb_data($searchTerm, $table, $field, $status)->count;

        if ($count > 0)
        {
            $total_pages = ceil($count / $limit);
        }
        else
        {
            $total_pages = 1;
        }

        if ($page > $total_pages)
            $page = $total_pages;
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)

        $res = $this->Proses_Model->get_data($searchTerm, $sidx, $sord, $start, $limit, $table, $field, $status);

        $response->page = $page;
        $response->total = $total_pages;
        $response->records = $count;
        $response->rows = $res;

        echo json_encode($response);
    }

}
