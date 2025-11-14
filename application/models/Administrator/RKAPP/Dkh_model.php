<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dkh_model extends CI_Model
{
    public function get_program_by_kode($kode_program)
    {
        // panggil store procedure
        $this->db->select('*');
        $this->db->from('tb_data_program_view');
        $this->db->where('kode_program', $kode_program);
        $query =  $this->db->get();
        return $query->row_array();
    }
}
