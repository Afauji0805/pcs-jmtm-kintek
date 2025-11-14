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


    // Kolom untuk order dan search
    private $column_order  = ['kode_alat', 'uraian_alat', 'satuan_alat', null];
    private $column_search = ['kode_alat', 'uraian_alat', 'satuan_alat'];

    private $order = ['id_alat' => 'DESC'];



    // ==========================
    //  QUERY UTAMA DATATABLES
    // ==========================
    private function _get_datatables_query()
    {
        $this->db->select("
            a.id_alat,
            a.kode_alat,
            a.uraian_alat,
            a.satuan_alat,
            a.status_alat,

            -- Hitung jumlah supplier per item
            (SELECT COUNT(*) FROM vw_master_alat b 
             WHERE b.kode_alat = a.kode_alat) AS jumlah_supplier
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
    public function get_datatables_alat()
    {
        $this->_get_datatables_query();

        if ($this->input->post('length') != -1)
            $this->db->limit(
                $this->input->post('length'),
                $this->input->post('start')
            );

        return $this->db->get()->result();
    }


    public function count_filtered_alat()
    {
        $this->_get_datatables_query();
        return $this->db->get()->num_rows();
    }


    public function count_all_alat()
    {
        return $this->db->count_all('vw_master_alat');
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
    private $table = 'vw_detail_master_ubas';

    public function get_all_detail_alat()
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
            $data['kode_alat'],
            '', // subkon
            $data['kode_supplier'],
            $data['harsat_detail_master_ubas']
        ]);
    }

    public function generate_kode_detail_alat($kode_alat)
    {
        if (empty($kode_alat)) {
            return false;
        }

        $this->db->select('kd_detail_master_ubas');
        $this->db->from('tb_detail_master_ubas');
        $this->db->like('kd_detail_master_ubas', $kode_alat . '.', 'after');
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

        return $kode_alat . '.' . $next_number;
    }



    public function get_all_detail_with_supplier($kode_alat = null)
    {
        $this->db->select('*');
        $this->db->from('vw_detail_master_ubas');

        if ($kode_alat !== null) {
            $this->db->where('kode_alat', $kode_alat);
        }
        return $this->db->get()->result_array();
    }

    public function hapus_detail($id)
    {
        $this->db->where('id_detail_master_ubas', $id);
        return $this->db->delete('tb_detail_master_ubas');
    }

    public function count_supplier($kode_alat)
    {
        if (empty($kode_alat)) return 0;
        $this->db->from('tb_detail_master_ubas');
        $this->db->where('kode_alat', $kode_alat);
        $this->db->where('kd_detail_master_ubas IS NOT NULL', null, false);
        return $this->db->count_all_results();
    }
}
