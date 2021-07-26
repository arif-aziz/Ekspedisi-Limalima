<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('cek_admin'))
{
    function cek_admin($tipe, $html)
    {
        $CI =& get_instance();
        echo $CI->session->userdata('tipe') < $tipe ? "" : $html;
    }
}