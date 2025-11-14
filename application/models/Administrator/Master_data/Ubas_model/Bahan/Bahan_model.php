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


    // Kolom untuk order dan search
    private $column_order  = ['kode_bahan', 'uraian_bahan', 'satuan_bahan', null];
    private $column_search = ['kode_bahan', 'uraian_bahan', 'satuan_bahan'];

    private $order = ['id_bahan' => 'DESC'];



    // ==========================
    //  QUERY UTAMA DATATABLES
    // ==========================
    private function _get_datatables_query()
    {
        $this->db->select("
            a.id_bahan,
            a.kode_bahan,
            a.uraian_bahan,
            a.satuan_bahan,
            a.status_bahan,

            -- Hitung jumlah supplier per item
            (SELECT COUNT(*) FROM vw_master_bahan b 
             WHERE b.kode_bahan = a.kode_bahan) AS jumlah_supplier
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
    public function get_datatables_bahan()
    {
        $this->_get_datatables_query();

        if ($this->input->post('length') != -1)
            $this->db->limit(
                $this->input->post('length'),
                $this->input->post('start')
            );

        return $this->db->get()->result();
    }


    public function count_filtered_bahan()
    {
        $this->_get_datatables_query();
        return $this->db->get()->num_rows();
    }


    public function count_all_bahan()
    {
        return $this->db->count_all('vw_master_bahan');
    }

    public function insert_bahan($data)
    {
        $sql = "CALL sp_insert_master_bahan(?, ?, ?)";
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
    private $table = 'vw_detail_master_ubas';

    public function get_all_detail_bahan()
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
            '', // upah
            $data['kode_bahan'],
            '', // alat
            '', // subkon
            $data['kode_supplier'],
            $data['harsat_detail_master_ubas']
        ]);
    }

    public function generate_kode_detail_bahan($kode_bahan)
    {
        if (empty($kode_bahan)) {
            return false;
        }

        $this->db->select('kd_detail_master_ubas');
        $this->db->from('tb_detail_master_ubas');
        $this->db->like('kd_detail_master_ubas', $kode_bahan . '.', 'after');
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

        return $kode_bahan . '.' . $next_number;
    }



    public function get_all_detail_with_supplier($kode_bahan = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_ubas');

        if ($kode_bahan !== null) {
            $this->db->where('kode_bahan', $kode_bahan);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id)
    {
        $this->db->where('id_detail_master_ubas', $id);
        return $this->db->delete('tb_detail_master_ubas');
    }

    public function count_supplier($kode_bahan)
    {
        if (empty($kode_bahan)) return 0;
        $this->db->from('tb_detail_master_ubas');
        $this->db->where('kode_bahan', $kode_bahan);
        $this->db->where('kd_detail_master_ubas IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
