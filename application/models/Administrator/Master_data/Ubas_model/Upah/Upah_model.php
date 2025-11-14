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


    // Kolom untuk order dan search
    private $column_order  = ['kode_upah', 'uraian_upah', 'satuan_upah', null];
    private $column_search = ['kode_upah', 'uraian_upah', 'satuan_upah'];

    private $order = ['id_upah' => 'DESC'];



    // ==========================
    //  QUERY UTAMA DATATABLES
    // ==========================
    private function _get_datatables_query()
    {
        $this->db->select("
            a.id_upah,
            a.kode_upah,
            a.uraian_upah,
            a.satuan_upah,
            a.status_upah,

            -- Hitung jumlah supplier per item
            (SELECT COUNT(*) FROM vw_master_upah b 
             WHERE b.kode_upah = a.kode_upah) AS jumlah_supplier
        ");

        $this->db->from($this->table . " a");


        // =============== SEARCHING ===============
        $search = $this->input->post('search')['value'];
        $i = 0;

        if ($search) {
            foreach ($this->column_search as $item) {
                if ($i == 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search);
                } else {
                    $this->db->or_like($item, $search);
                }
                if (($i + 1) == count($this->column_search))
                    $this->db->group_end();
                $i++;
            }
        }


        // =============== ORDERING ===============
        if ($this->input->post('order')) {
            $this->db->order_by(
                $this->column_order[$this->input->post('order')[0]['column']],
                $this->input->post('order')[0]['dir']
            );
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }



    // ==========================
    //  DATATABLES OUTPUT
    // ==========================
    public function get_datatables_upah()
    {
        $this->_get_datatables_query();

        if ($this->input->post('length') != -1)
            $this->db->limit(
                $this->input->post('length'),
                $this->input->post('start')
            );

        return $this->db->get()->result();
    }


    public function count_filtered_upah()
    {
        $this->_get_datatables_query();
        return $this->db->get()->num_rows();
    }


    public function count_all_upah()
    {
        return $this->db->count_all('vw_master_upah');
    }

    public function insert_upah($data)
    {
        $sql = "CALL sp_insert_master_upah(?, ?, ?)";
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
    private $table = 'vw_detail_master_ubas';

    public function get_all_detail_upah()
    {
        $this->db->order_by('kd_detail_master_ubas', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        // return $this->db->insert('tb_detail_master_ubas', $data);

        $sql = "CALL sp_insert_detail_master_ubas(?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['kd_detail_master_ubas'],
            $data['kode_upah'],
            '', // bahan
            '', // alat
            '', // subkon
            $data['kode_supplier'],
            $data['harsat_detail_master_ubas']
        ]);
    }

    public function generate_kode_detail_upah($kode_upah)
    {
        if (empty($kode_upah)) {
            return false;
        }

        $this->db->select('kd_detail_master_ubas');
        $this->db->from('tb_detail_master_ubas');
        $this->db->like('kd_detail_master_ubas', $kode_upah . '.', 'after');
        $this->db->order_by('id_detail_master_ubas', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_number = (int) substr($row->kd_detail_master_ubas, strrpos($row->kd_detail_master_ubas, '.') + 1);
            $next_number = $last_number + 1;
        } else {
            $next_number = 1;
        }

        return $kode_upah . '.' . $next_number; // contoh: UP-1.1
    }



    public function get_all_detail_with_supplier($kode_upah = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_ubas');

        if ($kode_upah !== null) {
            $this->db->where('kode_upah', $kode_upah);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id)
    {
        $this->db->where('id_detail_master_ubas', $id);
        return $this->db->delete('tb_detail_master_ubas');
    }

    public function count_supplier($kode_upah)
    {
        if (empty($kode_upah)) return 0;
        $this->db->from('tb_detail_master_ubas');
        $this->db->where('kode_upah', $kode_upah);
        $this->db->where('kd_detail_master_ubas IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
