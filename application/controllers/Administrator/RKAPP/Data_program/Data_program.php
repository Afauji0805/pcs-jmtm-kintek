<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_program extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Administrator/RKAPP/Rkapp_model');
	}

	public function index()
	{
		$this->load->view('Administrator/RKAPP/Data_program/js_header_program');
		$this->load->view('Administrator/Master_data/template_menu/Navbar_ubas');
		$this->load->view('Administrator/RKAPP/Data_program/Data_program');
		$this->load->view('Administrator/Dashboard/template_menu/footer_dashboard');
		$this->load->view('Administrator/RKAPP/Data_program/js_footer_program');
		$this->load->view('Administrator/RKAPP/Data_program/ajax');
	}

	public function get_data_program()
	{
		$this->db->select('*');
		$this->db->from('tb_data_program_view'); // gunakan view biar ada status_proyek
		$this->db->order_by('id_program', 'DESC'); // urut dari terbaru
		$query = $this->db->get();
		$data = $query->result_array();

		echo json_encode(['data' => $data]);
	}

	public function get_kode_program()
	{
		$this->load->model('Rkapp_model');
		$kode = $this->Rkapp_model->generate_kode_program();
		echo json_encode(['kode_program' => $kode]);
	}


	private function convertToYMD($date)
	{
		if (!$date || $date === 'dd/mm/yyyy') return null;
		$parts = explode('/', $date); // [dd, mm, yyyy]
		if (count($parts) !== 3) return null;
		return "{$parts[2]}-{$parts[1]}-{$parts[0]}"; // yyyy-mm-dd
	}

	public function insert()
	{
		$data = [
			'kode_program'              => $this->input->post('kd_prg'),
			'tanggal_program'           => $this->input->post('date_prg'),
			'nama_program'              => $this->input->post('nd_prg'),
			'unit_kerja'                => $this->input->post('unit_prg'),
			'lokasi_pekerjaan'          => $this->input->post('lokasi_prg'),
			'nilai_kontrak'             => $this->input->post('nilai_prg'),
			'tanggal_mulai_kontrak'     => $this->input->post('date_awal_kontrak_prg'),
			'tanggal_selesai_kontrak'   => $this->convertToYMD($this->input->post('date_akhir_kontrak_prg')),
			'durasi_kontrak'            => $this->input->post('durasi_kontrak_prg'),
			'tanggal_mulai_pho'         => $this->input->post('date_awal_pho_prg'),
			'tanggal_selesai_pho'       => $this->convertToYMD($this->input->post('date_akhir_pho_prg')),
			'durasi_pho'                => $this->input->post('durasi_pho_prg'),
			'date_fho'                  => $this->input->post('date_awal_fho_prg'),
			'owner'                     => $this->input->post('owner_prg'),
			'pm_pusat'                  => $this->input->post('pusat_prg'),
			'gs'                        => $this->input->post('gs'),
		];

		$this->Rkapp_model->insert_program($data);
		$new_token = $this->security->get_csrf_hash();
		echo json_encode([
			'status' => 'success',
			'message' => 'Data berhasil disimpan!',
			'csrf_token' => $new_token
		]);
	}

	// ================================================================================
	public function get_detail_program($id_program)
	{
	    $this->db->select('*');
	    $this->db->from('tb_data_program_tanpa_curent_date_view'); // gunakan view agar lengkap
	    $this->db->where('id_program', $id_program);
	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
	        echo json_encode([
	            'status' => 'success',
	            'data' => $query->row_array()
	        ]);
	    } else {
	        echo json_encode([
	            'status' => 'error',
	            'message' => 'Data program tidak ditemukan.'
	        ]);
	    }
	}

public function update_program()
{
    // pastikan model ter-load; biasanya sudah di __construct, tapi aman kita load
    $this->load->model('Administrator/RKAPP/Rkapp_model');

    $id_program = $this->input->post('id_program');
    if (empty($id_program)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID program tidak ditemukan.',
            'csrf_token' => $this->security->get_csrf_hash()
        ]);
        return;
    }

    // ambil data dari request
    $data = [
        'kode_program' => $this->input->post('kode_program'),
        'tanggal_program' => $this->input->post('tanggal_program'),
        'nama_program' => $this->input->post('nama_program'),
        'unit_kerja' => $this->input->post('unit_kerja'),
        'lokasi_pekerjaan' => $this->input->post('lokasi_pekerjaan'),
        'nilai_kontrak' => $this->input->post('nilai_kontrak'),
        'tanggal_mulai_kontrak' => $this->input->post('tanggal_mulai_kontrak'),
        'tanggal_selesai_kontrak' => $this->input->post('tanggal_selesai_kontrak'),
        'durasi_kontrak' => $this->input->post('durasi_kontrak'),
        'tanggal_mulai_pho' => $this->input->post('tanggal_mulai_pho'),
        'tanggal_selesai_pho' => $this->input->post('tanggal_selesai_pho'),
        'durasi_pho' => $this->input->post('durasi_pho'),
        'date_fho' => $this->input->post('date_fho'),
        'owner' => $this->input->post('owner'),
        'pm_pusat' => $this->input->post('pm_pusat'),
        'gs' => $this->input->post('gs')
    ];

    // Panggil model (Rkapp_model)
    $success = $this->Rkapp_model->update_program($id_program, $data);

    if ($success) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Data program berhasil diperbarui!',
            'csrf_token' => $this->security->get_csrf_hash()
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal memperbarui data program.',
            'csrf_token' => $this->security->get_csrf_hash()
        ]);
    }
}




	// ======================================================================================
}

