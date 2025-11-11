<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    public function get_all_supplier()
    {
        // Ambil semua data 
        return $this->db->get('tb_supplier')->result();
    }

    // tambah data
    public function insert_supplier($data)
    {
        return $this->db->insert('tb_supplier', $data);
    }

    // kode otomatis
    public function generate_kode_supplier()
    {
        $this->db->select('kode_supplier');
        $this->db->from('tb_supplier');
        $this->db->order_by('id_supplier', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) explode('-', $row->kode_supplier)[1];
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return 'SUP-' . str_pad($new_number, 1, '0', STR_PAD_LEFT);
    }

    // update
    public function update_supplier($id, $data)
    {
        return $this->db->where('id_supplier', $id)->update('tb_supplier', $data);
    }
}
