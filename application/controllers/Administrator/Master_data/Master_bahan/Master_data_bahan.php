<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Bahan_model $Bahan_model
 * @property input $input
 * @property db $db
 * @property Detail_bahan_model $Detail_bahan_model
 * @property session $session
 * @property getDetailSupplier $getDetailSupplier
 */

class Master_data_bahan extends CI_Controller
{

	/* ==============================
	 *  Controller : BAHAN
	 * ============================== */
	public function __construct()
	{
		parent::__construct();

		// Load model utama (Bahan_model)
		$this->load->model('Administrator/Master_data/Ubas_model/Bahan/Bahan_model');

		// Load model detail bahan
		$this->load->model('Administrator/Master_data/Ubas_model/Bahan/Detail_bahan_model');
	}

	public function index()
	{
		$data['bahan'] = $this->Bahan_model->get_all_bahan();
		$data['kode_otomatis'] = $this->Bahan_model->generate_kode_bahan();
		// bahan persuplier kirim ke view
		$data_detail['bahan_detail'] = $this->Detail_bahan_model->get_all_detail_bahan();
		$data_detail['kode_otomatis_persuplier'] = $this->Detail_bahan_model->generate_kode_detail_bahan('BH-1');

		foreach ($data['bahan'] as &$bh) {
			$this->load->model('Administrator/Master_data/Ubas_model/Bahan/Detail_bahan_model');
			$bh->jumlah_supplier = $this->Detail_bahan_model->count_supplier($bh->kode_bahan);
		}


		$this->load->view('Administrator/Master_data/Ubas_data/Master_bahan/Js_header_bahan');
		$this->load->view('Administrator/Master_data/template_menu/Navbar_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_bahan/Data_bahan', $data);
		$this->load->view('Administrator/Master_data/template_menu/Footer_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_bahan/Js_footer_bahan');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_bahan/Ajax_bahan');
	}

	// tambah
	public function tambah()
	{
		if ($this->input->method() !== 'post') {
			show_error('Invalid request method', 405);
		}

		$data = [
			'kode_bahan'   => $this->Bahan_model->generate_kode_bahan(),
			'uraian_bahan' => $this->input->post('uraian_bahan'),
			'satuan_bahan' => $this->input->post('satuan_bahan'),
			'status_bahan' => 'Active',
		];

		$this->Bahan_model->insert_bahan($data);
		redirect('Administrator/Master_data/Master_bahan/Master_data_bahan');
	}

	// togle aktif non aktif
	public function toggle_status()
	{
		$id = $this->input->post('id_bahan');
		$status = $this->input->post('status');

		if ($id && $status) {
			$this->db->where('id_bahan', $id);
			$this->db->update('tb_bahan', ['status_bahan' => $status]);

			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

	// detail
	public function get_detail_bahan()
	{
		$id = $this->input->get('id_bahan');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_bahan', ['id_bahan' => $id])->row_array();

		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}

	// Update/ubah
	public function update_bahan()
	{
		$id_bahan   = $this->input->post('id_bahan');
		$uraian_bahan = $this->input->post('uraian_bahan');
		$satuan_bahan = $this->input->post('satuan_bahan');
		$sql = "CALL sp_update_master_bahan(?, ?, ?)";
		$this->db->query($sql, [$id_bahan, $uraian_bahan, $satuan_bahan]);
		mysqli_next_result($this->db->conn_id);
		echo json_encode([
			'status' => 'success',
			'csrf_token' => $this->security->get_csrf_hash()
		]);
	}


	/* ==============================
	 *  Controller : DETAIL BAHAN
	 * ============================== */
	public function tambah_detail()
	{
		$kode_bahan = $this->input->post('kode_bahan');
		$harga_satuan = $this->input->post('harga_satuan');

		if (!$kode_bahan || !$harga_satuan) {
			$this->session->set_flashdata('error', 'Data belum lengkap');
			redirect('Administrator/Master_data/Master_bahan/Master_data_bahan');
			return;
		}

		// pakai class Detail_bahan_model yang disatukan
		$kode_detail_bahan = $this->Detail_bahan_model->generate_kode_detail_bahan($kode_bahan);

		$data = [
			'kode_bahan'        => $kode_bahan,
			'kode_detail_bahan' => $kode_detail_bahan,
			'harga_satuan'     => $harga_satuan,
		];

		$this->Detail_bahan_model->insert($data);
		$this->session->set_flashdata('success', 'Detail bahan berhasil ditambahkan');
		redirect('Administrator/Master_data/Master_bahan/Master_data_bahan');
	}

	// detail persuplier
	public function get_detail_persuplier()
	{
		$id = $this->input->get('id_bahan');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_bahan', ['id_bahan' => $id])->row();


		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}

	// tambah persuplier
	public function tambah_persuplier()
	{
		if ($this->input->method() !== 'post') {
			show_error('Invalid request method', 405);
		}

		$data = [

			'kode_bahan_detail' => $this->Detail_bahan_model->generate_kode_detail_bahan($this->input->post('kode_bahan')),
			'harga_satuan' => $this->input->post('harga_satuan'),

		];

		$this->Detail_bahan_model->insert($data);
		redirect('Administrator/Master_data/Master_bahan/Master_data_bahan');
	}

	// ambil data supplier dari tb_supplier
	public function get_supplier_list()
	{
		$query = $this->db->select('kode_supplier, nama_supplier')
			->from('tb_supplier')
			->order_by('kode_supplier', 'ASC')
			->get();

		$result = $query->result_array();

		echo json_encode($result);
	}


	// sini yan
	public function simpan_detail_tabel_persupplier()
	{
		if ($this->input->method() !== 'post') {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
			return;
		}

		$kode_bahan     = $this->input->post('kode_bahan');
		$kode_supplier = $this->input->post('kode_supplier');
		$harga_satuan  = $this->input->post('harga_satuan');

		if (empty($kode_bahan) || empty($kode_supplier) || empty($harga_satuan)) {
			echo json_encode(['status' => 'error', 'message' => 'Semua kolom wajib diisi.']);
			return;
		}

		$kd_detail_master_ubas = $this->Detail_bahan_model->generate_kode_detail_bahan($kode_bahan);

		$data = [
			'kode_bahan'         => $kode_bahan,
			'kd_detail_master_ubas'  => $kd_detail_master_ubas,
			'kode_supplier'     => $kode_supplier,
			'harsat_detail_master_ubas'      => $harga_satuan,
		];

		$this->Detail_bahan_model->insert($data);

		$supplier = $this->db->get_where(
			'vw_detail_master_ubas',
			[
				'kd_detail_master_ubas' => $kd_detail_master_ubas,
				'kode_bahan' => $kode_bahan,
				'kode_supplier' => $kode_supplier,
			]
		)->row();
		$nama_supplier = $supplier ? $supplier->nama_supplier : '';
		echo json_encode([
			'status' => 'success',
			'message' => 'Data berhasil disimpan.',
			'data' => [
				'id_bahan_detail' => $supplier->id_bahan_detail,
				'kode_bahan_detail' => $kd_detail_master_ubas,
				'kode_supplier' => $kode_supplier,
				'nama_supplier' => $nama_supplier,
				'harga_satuan' => $harga_satuan,
			],
		]);
	}

	public function get_detail_tabel_persuplier()
	{
		$kode_bahan = $this->input->get('kode_bahan');

		if (!$kode_bahan) {
			echo json_encode(['status' => 'error', 'message' => 'Kode bahan tidak dikirim']);
			return;
		}

		$data = $this->Detail_bahan_model->get_all_detail_with_supplier($kode_bahan);
		if (!empty($data)) {
			echo json_encode(['status' => 'success', 'data' => $data]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
		}
	}

	public function hapus_detail_supplier()
	{
		$id_bahan_detail = $this->input->post('id_bahan_detail');

		if (!$id_bahan_detail) {
			echo json_encode(['status' => 'error', 'message' => 'ID detail tidak dikirim']);
			return;
		}


		$deleted = $this->Detail_bahan_model->hapus_detail($id_bahan_detail);

		if ($deleted) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
		}
	}

	public function count_supplier($kode_bahan)
	{
		if (empty($kode_bahan)) {
			echo json_encode(['jumlah' => 0]);
			return;
		}
		$jumlah = $this->Detail_bahan_model->count_supplier($kode_bahan);
		echo json_encode(['jumlah' => $jumlah]);
	}
}
