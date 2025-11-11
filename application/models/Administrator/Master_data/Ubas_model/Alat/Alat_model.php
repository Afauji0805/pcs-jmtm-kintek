<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ==============================
 *  MODEL: ALAT
 * ============================== */
class Alat_model extends CI_Model
{
    private $table = 'tb_alat';

    public function get_all_alat()
    {
        $this->db->select('*');
        $this->db->from('vw_master_alat'); // gunakan view biar ada status_proyek
        $this->db->order_by('id_alat', 'DESC'); // urut dari terbaru
        return $this->db->get()->result();
    }

    public function insert_alat($data)
    {
        $sql = "CALL sp_insert_master_alat(?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_alat'],
            $data['uraian_alat'],
            $data['satuan_alat']
        ]);
    }

    public function generate_kode_alat()
    {
        $this->db->select('kode_alat');
        $this->db->from($this->table);
        $this->db->order_by('id_alat', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_alat, strrpos($row->kode_alat, '-') + 1);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        // Format: AL-1, AL-2, dst
        return 'AL-' . $new_number;
    }

    public function update_alat($id, $data)
    {

        return $this->db->where('id_alat', $id)->update($this->table, $data);
    }
}

/* ==============================
 *  MODEL: DETAIL ALAT
 * ============================== */
class Detail_alat_model extends CI_Model
{
    private $table = 'tb_alat_detail';

    public function get_all_detail_alat()
    {
        $this->db->order_by('id_alat_detail', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        $sql = "CALL sp_insert_detail_master_alat(?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_alat'],
            $data['kode_alat_detail'],
            $data['kode_supplier'],
            $data['harga_satuan']
        ]);
    }


    public function generate_kode_detail_alat($kode_alat)
    {
        if (empty($kode_alat)) {
            return false;
        }

        $this->db->select('kode_alat_detail');
        $this->db->from($this->table);
        $this->db->like('kode_alat_detail', $kode_alat . '.', 'after');
        $this->db->order_by('id_alat_detail', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kode_alat_detail, strrpos($row->kode_alat_detail, '.') + 1);
            $next_number = $last_number + 1;
        } else {
            $next_number = 1;
        }

        return $kode_alat . '.' . $next_number; // contoh: AL-1.1
    }



    public function get_all_detail_with_supplier($kode_alat = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_alat');

        if ($kode_alat !== null) {
            $this->db->where('kode_alat', $kode_alat);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id_alat_detail)
    {
        $this->db->where('id_alat_detail', $id_alat_detail);
        return $this->db->delete('tb_alat_detail');
    }

    public function count_supplier($kode_alat)
    {
        if (empty($kode_alat)) return 0;
        $this->db->from($this->table);
        $this->db->where('kode_alat', $kode_alat);
        $this->db->where('kode_alat_detail IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
