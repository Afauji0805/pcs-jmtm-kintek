<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ==============================
 *  MODEL: UPAH
 * ============================== */
class Upah_model extends CI_Model
{
    private $table = 'tb_upah';

    public function get_all_upah()
    {
        $this->db->select('*');
        $this->db->from('vw_master_upah'); // gunakan view biar ada status_proyek
        $this->db->order_by('id_upah', 'DESC'); // urut dari terbaru
        return $this->db->get()->result();
    }

    public function insert_upah($data)
    {
        $sql = "CALL sp_insert_tb_master_upah(?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_upah'],
            $data['uraian_upah'],
            $data['satuan_upah']
        ]);
    }

    public function generate_kode_upah()
    {
        $this->db->select('kode_upah');
        $this->db->from($this->table);
        $this->db->order_by('id_upah', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_upah, strrpos($row->kode_upah, '-') + 1);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        // Format: UP-1, UP-2, dst
        return 'UP-' . $new_number;
    }

    public function update_upah($id, $data)
    {

        return $this->db->where('id_upah', $id)->update($this->table, $data);
    }
}

/* ==============================
 *  MODEL: DETAIL UPAH
 * ============================== */
class Detail_upah_model extends CI_Model
{
    private $table = 'tb_upah_detail';

    public function get_all_detail_upah()
    {
        $this->db->order_by('id_upah_detail', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        $sql = "CALL sp_insert_detail_master_upah(?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_upah'],
            $data['kode_upah_detail'],
            $data['kode_supplier'],
            $data['harga_satuan']
        ]);
    }


    public function generate_kode_detail_upah($kode_upah)
    {
        if (empty($kode_upah)) {
            return false;
        }

        $this->db->select('kode_upah_detail');
        $this->db->from($this->table);
        $this->db->like('kode_upah_detail', $kode_upah . '.', 'after');
        $this->db->order_by('id_upah_detail', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_upah_detail, strrpos($row->kode_upah_detail, '.') + 1);
            $next_number = $last_number + 1;
        } else {
            $next_number = 1;
        }

        return $kode_upah . '.' . $next_number; // contoh: UP-1.1
    }



    public function get_all_detail_with_supplier($kode_upah = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_upah');

        if ($kode_upah !== null) {
            $this->db->where('kode_upah', $kode_upah);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id_upah_detail)
    {
        $this->db->where('id_upah_detail', $id_upah_detail);
        return $this->db->delete('tb_upah_detail');
    }

    public function count_supplier($kode_upah)
    {
        if (empty($kode_upah)) return 0;
        $this->db->from($this->table);
        $this->db->where('kode_upah', $kode_upah);
        $this->db->where('kode_upah_detail IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
