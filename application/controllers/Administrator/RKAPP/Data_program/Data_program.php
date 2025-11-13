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
		$this->load->view('Administrator/Rkapp/Data_program/js_header_program');
		$this->load->view('Administrator/Master_data/template_menu/Navbar_ubas');
		$this->load->view('Administrator/Rkapp/Data_program/Data_program');
		$this->load->view('Administrator/Dashboard/template_menu/footer_dashboard');
		$this->load->view('Administrator/Rkapp/Data_program/js_footer_program');
		$this->load->view('Administrator/Rkapp/Data_program/ajax');
	}


	function indo_tanggal($tgl)
	{
		if (!$tgl || $tgl == "0000-00-00") return "-";

		$bulan = [
			1 => 'Januari', 'Februari', 'Maret', 'April',
			'Mei', 'Juni', 'Juli', 'Agustus',
			'September', 'Oktober', 'November', 'Desember'
		];

		$exp = explode('-', $tgl);
		return $exp[2] . ' ' . $bulan[(int) $exp[1]] . ' ' . $exp[0];
	}

	public function get_data_program()
	{
		$draw   = intval($this->input->post('draw'));
		$start  = intval($this->input->post('start'));

		$list = $this->Rkapp_model->get_datatables_program();

		$data = [];
		$no = $start;


		foreach ($list as $rs) {

			// STATUS BADGE
			if ($rs->status_proyek == 'Masa Pelaksanaan') {
				$status = '<span class="badge bg-success">Masa Pelaksanaan</span>';
			} elseif ($rs->status_proyek == 'Masa Pemeliharaan') {
				$status = '<span class="badge bg-warning text-dark">Masa Pemeliharaan</span>';
			} elseif ($rs->status_proyek == 'Pekerjaan Selesai') {
				$status = '<span class="badge bg-danger">Pekerjaan Selesai</span>';
			} else {
				$status = '<span class="badge bg-info">Masa Perencanaan</span>';
			}

			// AKSI
			$aksi = '
			<div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" 
                class="btn btn-sm btn-secondary btn-detail-program"
                data-id="' . $rs->id_program . '" 
                data-bs-toggle="modal" 
                data-bs-target="#staticBackdrop-detail-program">
                <i class="fa-solid fa-users-viewfinder"></i>
            </button>

            <a href="' . base_url('Administrator/Rkapp/Data_dkh_kontrak/Data_dkh_kontrak') . '"
                class="btn btn-sm btn-success">
                <i class="fa-solid fa-share-from-square"></i>
            </a>
			</div>
        ';


			// ROW SUDAH SAMLIN RAPI
			$row = [
				"<td class='text-center'><small>$rs->kode_program</small></td>",
				"<small>$rs->nama_program</small>",
				"<small>$rs->nilai_kontrak</small>",
				"<small>" . (
					(!empty($rs->tanggal_mulai_kontrak) && $rs->tanggal_mulai_kontrak != '0000-00-00'
						? date('d/m/Y', strtotime($rs->tanggal_mulai_kontrak))
						: '-'
					) . " || {$rs->durasi_kontrak} Hari"
				) . "</small>",
				"<small>" . (
					(!empty($rs->tanggal_mulai_pho) && $rs->tanggal_mulai_pho != '0000-00-00'
						? date('d/m/Y', strtotime($rs->tanggal_mulai_pho))
						: '-'
					) . " || {$rs->durasi_pho} Hari"
				) . "</small>",
				"{$status}",
				"<small>{$aksi}</small>"
			];			
			

			$data[] = $row;
		}

		$output = [
			"draw" => $draw,
			"recordsTotal" => $this->Rkapp_model->count_all_program(),
			"recordsFiltered" => $this->Rkapp_model->count_filtered_program(),
			"data" => $data
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
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
