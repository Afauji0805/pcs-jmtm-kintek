<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rkapp_model extends CI_Model
{

    public function insert_program($data)
    {
        $sql = "CALL sp_insert_tb_data_program(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['kode_program'],
            $data['tanggal_program'],
            $data['nama_program'],
            $data['unit_kerja'],
            $data['lokasi_pekerjaan'],
            $data['nilai_kontrak'],
            $data['tanggal_mulai_kontrak'],
            $data['tanggal_selesai_kontrak'],
            $data['durasi_kontrak'],
            $data['tanggal_mulai_pho'],
            $data['tanggal_selesai_pho'],
            $data['durasi_pho'],
            $data['date_fho'],
            $data['owner'],
            $data['pm_pusat'],
            $data['gs']
        ]);
    }

    public function generate_kode_program()
    {
        $tahun = date('y'); // contoh: 25
        $prefix = "PK.$tahun.";

        $this->db->like('kode_program', $prefix, 'after');
        $this->db->order_by('id_program', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_data_program');

        if ($query->num_rows() > 0) {
            $last_kode = $query->row()->kode_program; // contoh: PK.25.7
            $last_number = (int) substr($last_kode, strrpos($last_kode, '.') + 1); // ambil 7
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return "PK.$tahun.$new_number";
    }
}
