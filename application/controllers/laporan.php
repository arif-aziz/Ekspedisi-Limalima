<?php

class Laporan extends MY_Controller {

    var $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Invoice_Model');
        $this->load->model('Ekspedisi_Model');
        $this->load->model('Pengirim_Model');
        $this->load->library('cezpdf');
        $this->load->helper('pdf');
        $this->data['base'] = 7;
    }

    function index()
    {
        $this->data['content'] = "laporan/index";
        $this->data['month'] = $this->Invoice_Model->getMonth();
        $this->data['year'] = $this->Invoice_Model->getYear();
        $this->load->view("template", $this->data);
    }

    function getLaporan()
    {
        $this->data['content'] = "laporan/index";
        $this->data['laporan'] = $this->input->post('laporan');
        $this->data['customer'] = $this->input->post('customer');
        $this->data['bulan'] = $this->input->post('bulan');
        $this->data['tahun'] = $this->input->post('tahun');
        switch ($this->data['laporan'])
        {
            case 'ekspedisi' : $this->data['data'] = $this->Ekspedisi_Model->getEkspedisiReport($this->data['customer'], $this->data['bulan'], $this->data['tahun']);
                break;
            case 'invoice' : $this->data['data'] = $this->Invoice_Model->getInvoiceReport($this->data['customer'], $this->data['bulan'], $this->data['tahun']);
                break;
        }
        $this->data['month'] = $this->Invoice_Model->getMonth();
        $this->data['year'] = $this->Invoice_Model->getYear();
        $this->load->view("template", $this->data);
    }

    function excelLaporan($laporan, $cust, $bln, $thn, $qty)
    {
        if ($qty > 0)
        {
            switch ($laporan)
            {
                case 'ekspedisi' : $data = $this->ekspedisi_model->getEkspedisiReport($cust, $bln, $thn);
                    $array = array(array('ID EKSPEDISI', 'TGL BERANGKAT', 'TGL SAMPAI', 'NOPOL', 'SOPIR', 'KERNET', 'KOTA TUJUAN'));
                    $loop = 0;
                    foreach ($data->result() as $row)
                    {
                        $content[$loop] = array($row->id_ekspedisi, $row->tgl_berangkat,
                            $row->tgl_sampai, $row->nopol, $row->sopir,
                            $row->kernet, $row->kota_tujuan);

                        array_push($array, $content[$loop]);
                        $loop++;
                    }
                    break;
                case 'invoice' : $data = $this->invoice_model->getInvoiceReport($cust, $bln, $thn);
                    $array = array(array('ID INVOICE', 'TANGGAL', 'KETERANGAN', 'TANGGAL BAYAR', 'JUMLAH', 'NAMA PARTNER'));
                    $loop = 0;
                    foreach ($data->result() as $row)
                    {
                        $content[$loop] = array($row->id_invoice, $row->tanggal,
                            $row->keterangan, $row->tanggal_bayar, $row->jumlah,
                            $row->nama_pengirim);

                        array_push($array, $content[$loop]);
                        $loop++;
                    }
                    break;
            }

            $this->load->helper('to_excel');
            array_to_excel($array, 'Menu');
        }
    }

    function pdfLaporan($laporan, $cust, $bln, $thn, $qty)
    {
        $bentuk = 'landscape';
        $array = array();
        if ($qty > 0)
        {
            switch ($laporan)
            {
                case 'ekspedisi' : $data = $this->ekspedisi_model->ekspedisiReport(1);
                    $header = array('No. S.A', 'Pengirim', 'Penerima', 'Banyaknya', 'Nama Barang', 'Berat', 'Jumlah', 'Franco', 'Ongefr.', 'Tebusan Gd.', 'Keterangan');
                    $loop = 0;
                    $jumlah1 = $jumlah2 = 0;
                    foreach ($data->result() as $row)
                    {
                        $content[$loop] = array($row->no_surat, $row->nama_pengirim,
                            $row->nama_penerima, $row->jumlah, $row->merk,
                            $row->bruto, "", "", "", "", "");

                        array_push($array, $content[$loop]);
                        $jumlah1 += $row->jumlah;
                        $jumlah2 += $row->bruto;
                        $loop++;
                    }
                    array_push($array, array("- - -", "- - -", "- Total -", $jumlah1, "- - -", $jumlah2, "- - -", "- - -", "- - -", "- - -", "- - -"));

                    $this->cezpdf = new Cezpdf('LEGAL', $bentuk);
                    page_number();
                    header_pdf();
                    footer_pdf();
                    $this->cezpdf->ezTable($array, $header, "", array('width' => 900));

                    break;
                case 'invoice' : $data = $this->invoice_model->getInvoiceReport($cust, $bln, $thn);
                    $header = array('ID INVOICE', 'TANGGAL', 'KETERANGAN', 'TANGGAL BAYAR', 'JUMLAH', 'NAMA PARTNER');
                    $loop = 0;
                    foreach ($data->result() as $row)
                    {
                        $content[$loop] = array($row->id_invoice, $row->tanggal,
                            $row->keterangan, $row->tanggal_bayar, $row->jumlah,
                            $row->nama_pengirim);

                        array_push($array, $content[$loop]);
                        $loop++;
                    }
                    $this->cezpdf = new Cezpdf('LEGAL', $bentuk);
                    page_number();
                    $bln = $this->invoice_model->getMonthName($bln);
                    $customer = $this->pengirim_model->getNamePengirim($cust)->result();
                    foreach ($customer as $row)
                    {
                        $cust = $row->nama_pengirim;
                    }
                    $title = "Perincian INVOICE untuk $cust $bln $thn";
                    $this->cezpdf->ezTable($array, $header, $title, array('width' => 900));
                    break;
            }
            $option['Content-Disposition'] = "Laporan";
            $this->cezpdf->ezStream($option);
        }
    }

}

?>