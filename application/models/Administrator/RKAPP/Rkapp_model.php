<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rkapp_model extends CI_Model
{


    var $table_program = 'tb_data_program_view';

    var $column_order_program = [
        'kode_program',
        'nama_program',
        'nilai_kontrak',
        'tanggal_mulai_kontrak',
        'tanggal_mulai_pho',
        'status_proyek'
    ];

    var $column_search_program = [
        'kode_program',
        'nama_program',
        'status_proyek'
    ];

    var $order_program = ['id_program' => 'DES'];

    private function _get_datatables_query_program()
    {
        $this->db->from($this->table_program);

        // search global
        $search = $_POST['search']['value'];
        if ($search) {
            $this->db->group_start();
            foreach ($this->column_search_program as $item) {
                $this->db->or_like($item, $search);
            }
            $this->db->group_end();
        }

        // ordering
        if (isset($_POST['order'])) {
            $col = $_POST['order'][0]['column'];
            $dir = $_POST['order'][0]['dir'];
            $this->db->order_by($this->column_order_program[$col], $dir);
        } else {
            $this->db->order_by(
                key($this->order_program),
                $this->order_program[key($this->order_program)]
            );
        }
    }

    public function get_datatables_program()
    {
        $this->_get_datatables_query_program();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    public function count_filtered_program()
    {
        $this->_get_datatables_query_program();
        return $this->db->count_all_results();
    }

    public function count_all_program()
    {
        return $this->db->count_all($this->table_program);
    }


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
    // =================================================================================================================

    public function update_program($id, $data)
    {
        $sql = "CALL sp_update_tb_data_program(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($sql, [
            $id,
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

        if ($query === false) {
            return false;
        }

        if (is_object($query)) {
            if (method_exists($query, 'next_result')) {
                $query->next_result();
            }
            if (method_exists($query, 'free_result')) {
                $query->free_result();
            }
        }

        return true;
    }
}
