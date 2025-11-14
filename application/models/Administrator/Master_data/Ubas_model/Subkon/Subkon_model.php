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


    // Kolom untuk order dan search
    private $column_order  = ['kode_subkon', 'uraian_subkon', 'satuan_subkon', null];
    private $column_search = ['kode_subkon', 'uraian_subkon', 'satuan_subkon'];

    private $order = ['id_subkon' => 'DESC'];



    // ==========================
    //  QUERY UTAMA DATATABLES
    // ==========================
    private function _get_datatables_query()
    {
        $this->db->select("
            a.id_subkon,
            a.kode_subkon,
            a.uraian_subkon,
            a.satuan_subkon,
            a.status_subkon,

            -- Hitung jumlah supplier per item
            (SELECT COUNT(*) FROM vw_master_subkon b 
             WHERE b.kode_subkon = a.kode_subkon) AS jumlah_supplier
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
    public function get_datatables_subkon()
    {
        $this->_get_datatables_query();

        if ($this->input->post('length') != -1)
            $this->db->limit(
                $this->input->post('length'),
                $this->input->post('start')
            );

        return $this->db->get()->result();
    }


    public function count_filtered_subkon()
    {
        $this->_get_datatables_query();
        return $this->db->get()->num_rows();
    }


    public function count_all_subkon()
    {
        return $this->db->count_all('vw_master_subkon');
    }

    public function insert_subkon($data)
    {
        $sql = "CALL sp_insert_master_subkon(?, ?, ?)";
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
    private $table = 'vw_detail_master_ubas';

    public function get_all_detail_subkon()
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
            '', // bahan
            '', // alat
            $data['kode_subkon'],
            $data['kode_supplier'],
            $data['harsat_detail_master_ubas']
        ]);
    }

    public function generate_kode_detail_subkon($kode_subkon)
    {
        if (empty($kode_subkon)) {
            return false;
        }

        $this->db->select('kd_detail_master_ubas');
        $this->db->from('tb_detail_master_ubas');
        $this->db->like('kd_detail_master_ubas', $kode_subkon . '.', 'after');
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

        return $kode_subkon . '.' . $next_number;
    }



    public function get_all_detail_with_supplier($kode_subkon = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_ubas');

        if ($kode_subkon !== null) {
            $this->db->where('kode_subkon', $kode_subkon);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id)
    {
        $this->db->where('id_detail_master_ubas', $id);
        return $this->db->delete('tb_detail_master_ubas');
    }

    public function count_supplier($kode_subkon)
    {
        if (empty($kode_subkon)) return 0;
        $this->db->from('tb_detail_master_ubas');
        $this->db->where('kode_subkon', $kode_subkon);
        $this->db->where('kd_detail_master_ubas IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
