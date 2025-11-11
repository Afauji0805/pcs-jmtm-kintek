<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ==============================
 *  MODEL: BAHAN
 * ============================== */
class Bahan_model extends CI_Model
{
    private $table = 'tb_bahan';

    public function get_all_bahan()
    {
        $this->db->select('*');
        $this->db->from('vw_master_bahan'); // gunakan view biar ada status_proyek
        $this->db->order_by('id_bahan', 'DESC'); // urut dari terbaru
        return $this->db->get()->result();
    }

    public function insert_bahan($data)
    {
        $sql = "CALL sp_insert_tb_master_bahan(?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_bahan'],
            $data['uraian_bahan'],
            $data['satuan_bahan']
        ]);
    }

    public function generate_kode_bahan()
    {
        $this->db->select('kode_bahan');
        $this->db->from($this->table);
        $this->db->order_by('id_bahan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_bahan, strrpos($row->kode_bahan, '-') + 1);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        // Format: BH-1, BH-2, dst
        return 'BH-' . $new_number;
    }

    public function update_bahan($id, $data)
    {

        return $this->db->where('id_bahan', $id)->update($this->table, $data);
    }
}

/* ==============================
 *  MODEL: DETAIL BAHAN
 * ============================== */
class Detail_bahan_model extends CI_Model
{
    private $table = 'tb_bahan_detail';

    public function get_all_detail_bahan()
    {
        $this->db->order_by('id_bahan_detail', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        $sql = "CALL sp_insert_detail_master_bahan(?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_bahan'],
            $data['kode_bahan_detail'],
            $data['kode_supplier'],
            $data['harga_satuan']
        ]);
    }


    public function generate_kode_detail_bahan($kode_bahan)
    {
        if (empty($kode_bahan)) {
            return false;
        }

        $this->db->select('kode_bahan_detail');
        $this->db->from($this->table);
        $this->db->like('kode_bahan_detail', $kode_bahan . '.', 'after');
        $this->db->order_by('id_bahan_detail', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_bahan_detail, strrpos($row->kode_bahan_detail, '.') + 1);
            $next_number = $last_number + 1;
        } else {
            $next_number = 1;
        }

        return $kode_bahan . '.' . $next_number; // contoh: BH-1.1
    }



    public function get_all_detail_with_supplier($kode_bahan = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_bahan');

        if ($kode_bahan !== null) {
            $this->db->where('kode_bahan', $kode_bahan);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id_bahan_detail)
    {
        $this->db->where('id_bahan_detail', $id_bahan_detail);
        return $this->db->delete('tb_bahan_detail');
    }

    public function count_supplier($kode_bahan)
    {
        if (empty($kode_bahan)) return 0;
        $this->db->from($this->table);
        $this->db->where('kode_bahan', $kode_bahan);
        $this->db->where('kode_bahan_detail IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
