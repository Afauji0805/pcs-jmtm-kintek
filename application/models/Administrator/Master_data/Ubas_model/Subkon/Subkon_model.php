<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ==============================
 *  MODEL: SUBKON
 * ============================== */
class Subkon_model extends CI_Model
{
    private $table = 'tb_subkon';

    public function get_all_subkon()
    {
        $this->db->select('*');
        $this->db->from('vw_master_subkon'); // gunakan view biar ada status_proyek
        $this->db->order_by('id_subkon', 'DESC'); // urut dari terbaru
        return $this->db->get()->result();
    }

    public function insert_subkon($data)
    {
        $sql = "CALL sp_insert_tb_master_subkon(?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_subkon'],
            $data['uraian_subkon'],
            $data['satuan_subkon']
        ]);
    }

    public function generate_kode_subkon()
    {
        $this->db->select('kode_subkon');
        $this->db->from($this->table);
        $this->db->order_by('id_subkon', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_subkon, strrpos($row->kode_subkon, '-') + 1);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        // Format: SK-1, SK-2, dst
        return 'SK-' . $new_number;
    }

    public function update_subkon($id, $data)
    {

        return $this->db->where('id_subkon', $id)->update($this->table, $data);
    }
}

/* ==============================
 *  MODEL: DETAIL SUBKON
 * ============================== */
class Detail_subkon_model extends CI_Model
{
    private $table = 'tb_subkon_detail';

    public function get_all_detail_subkon()
    {
        $this->db->order_by('id_subkon_detail', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        $sql = "CALL sp_insert_detail_master_subkon(?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_subkon'],
            $data['kode_subkon_detail'],
            $data['kode_supplier'],
            $data['harga_satuan']
        ]);
    }


    public function generate_kode_detail_subkon($kode_subkon)
    {
        if (empty($kode_subkon)) {
            return false;
        }

        $this->db->select('kode_subkon_detail');
        $this->db->from($this->table);
        $this->db->like('kode_subkon_detail', $kode_subkon . '.', 'after');
        $this->db->order_by('id_subkon_detail', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_subkon_detail, strrpos($row->kode_subkon_detail, '.') + 1);
            $next_number = $last_number + 1;
        } else {
            $next_number = 1;
        }

        return $kode_subkon . '.' . $next_number; // contoh: SK-1.1
    }



    public function get_all_detail_with_supplier($kode_subkon = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_subkon');

        if ($kode_subkon !== null) {
            $this->db->where('kode_subkon', $kode_subkon);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id_subkon_detail)
    {
        $this->db->where('id_subkon_detail', $id_subkon_detail);
        return $this->db->delete('tb_subkon_detail');
    }

    public function count_supplier($kode_subkon)
    {
        if (empty($kode_subkon)) return 0;
        $this->db->from($this->table);
        $this->db->where('kode_subkon', $kode_subkon);
        $this->db->where('kode_subkon_detail IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
