<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Alat_model $Alat_model
 * @property input $input
 * @property db $db
 * @property Detail_alat_model $Detail_alat_model
 * @property session $session
 * @property getDetailSupplier $getDetailSupplier
 */

class Master_data_alat extends CI_Controller
{

	/* ==============================
	 *  Controller : ALAT
	 * ============================== */
	public function __construct()
	{
		parent::__construct();

		// Load model utama (Alat_model)
		$this->load->model('Administrator/Master_data/Ubas_model/Alat/Alat_model');

		// Load model detail alat
		$this->load->model('Administrator/Master_data/Ubas_model/Alat/Detail_alat_model');
	}

	public function index()
	{
		$data['alat'] = $this->Alat_model->get_all_alat();
		$data['kode_otomatis'] = $this->Alat_model->generate_kode_alat();
		// alat persuplier kirim ke view
		$data_detail['alat_detail'] = $this->Detail_alat_model->get_all_detail_alat();
		$data_detail['kode_otomatis_persuplier'] = $this->Detail_alat_model->generate_kode_detail_alat('AL-1');

		foreach ($data['alat'] as &$al) {
			$this->load->model('Administrator/Master_data/Ubas_model/Alat/Detail_alat_model');
			$al->jumlah_supplier = $this->Detail_alat_model->count_supplier($al->kode_alat);
		}


		$this->load->view('Administrator/Master_data/Ubas_data/Master_alat/Js_header_alat');
		$this->load->view('Administrator/Master_data/template_menu/Navbar_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_alat/Data_alat', $data);
		$this->load->view('Administrator/Master_data/template_menu/Footer_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_alat/Js_footer_alat');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_alat/Ajax_alat');
	}

	// tambah
	public function tambah()
	{
		if ($this->input->method() !== 'post') {
			show_error('Invalid request method', 405);
		}

		$data = [
			'kode_alat'   => $this->Alat_model->generate_kode_alat(),
			'uraian_alat' => $this->input->post('uraian_alat'),
			'satuan_alat' => $this->input->post('satuan_alat'),
			'status_alat' => 'Active',
		];

		$this->Alat_model->insert_alat($data);
		redirect('Administrator/Master_data/Master_alat/Master_data_alat');
	}

	// togle aktif non aktif
	public function toggle_status()
	{
		$id = $this->input->post('id_alat');
		$status = $this->input->post('status');

		if ($id && $status) {
			$this->db->where('id_alat', $id);
			$this->db->update('tb_alat', ['status_alat' => $status]);

			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

	// detail
	public function get_detail_alat()
	{
		$id = $this->input->get('id_alat');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_alat', ['id_alat' => $id])->row_array();

		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}

	// Update/ubah
	public function update_alat()
	{
		$id_alat   = $this->input->post('id_alat');
		$uraian_alat = $this->input->post('uraian_alat');
		$satuan_alat = $this->input->post('satuan_alat');
		$sql = "CALL sp_update_master_alat(?, ?, ?)";
		$this->db->query($sql, [$id_alat, $uraian_alat, $satuan_alat]);
		mysqli_next_result($this->db->conn_id);
		echo json_encode([
			'status' => 'success',
			'csrf_token' => $this->security->get_csrf_hash()
		]);
	}


	/* ==============================
	 *  Controller : DETAIL ALAT
	 * ============================== */
	public function tambah_detail()
	{
		$kode_alat = $this->input->post('kode_alat');
		$harga_satuan = $this->input->post('harga_satuan');

		if (!$kode_alat || !$harga_satuan) {
			$this->session->set_flashdata('error', 'Data belum lengkap');
			redirect('Administrator/Master_data/Master_alat/Master_data_alat');
			return;
		}

		// pakai class Detail_alat_model yang disatukan
		$kode_detail_alat = $this->Detail_alat_model->generate_kode_detail_alat($kode_alat);

		$data = [
			'kode_alat'        => $kode_alat,
			'kode_detail_alat' => $kode_detail_alat,
			'harga_satuan'     => $harga_satuan,
		];

		$this->Detail_alat_model->insert($data);
		$this->session->set_flashdata('success', 'Detail alat berhasil ditambahkan');
		redirect('Administrator/Master_data/Master_alat/Master_data_alat');
	}

	// detail persuplier
	public function get_detail_persuplier()
	{
		$id = $this->input->get('id_alat');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_alat', ['id_alat' => $id])->row();


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

			'kode_alat_detail' => $this->Detail_alat_model->generate_kode_detail_alat($this->input->post('kode_alat')),
			'harga_satuan' => $this->input->post('harga_satuan'),

		];

		$this->Detail_alat_model->insert($data);
		redirect('Administrator/Master_data/Master_alat/Master_data_alat');
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

		$kode_alat     = $this->input->post('kode_alat');
		$kode_supplier = $this->input->post('kode_supplier');
		$harga_satuan  = $this->input->post('harga_satuan');

		if (empty($kode_alat) || empty($kode_supplier) || empty($harga_satuan)) {
			echo json_encode(['status' => 'error', 'message' => 'Semua kolom wajib diisi.']);
			return;
		}

		$kode_detail_alat = $this->Detail_alat_model->generate_kode_detail_alat($kode_alat);

		$data = [
			'kode_alat'         => $kode_alat,
			'kode_alat_detail'  => $kode_detail_alat,
			'kode_supplier'     => $kode_supplier,
			'harga_satuan'      => $harga_satuan,
		];

		$this->Detail_alat_model->insert($data);

		$supplier = $this->db->get_where(
			'vw_detail_master_alat',
			[
				'kode_alat_detail' => $kode_detail_alat,
				'kode_alat' => $kode_alat,
				'kode_supplier' => $kode_supplier,
			]
		)->row();
		$nama_supplier = $supplier ? $supplier->nama_supplier : '';
		echo json_encode([
			'status' => 'success',
			'message' => 'Data berhasil disimpan.',
			'data' => [
				'id_alat_detail' => $supplier->id_alat_detail,
				'kode_alat_detail' => $kode_detail_alat,
				'kode_supplier' => $kode_supplier,
				'nama_supplier' => $nama_supplier,
				'harga_satuan' => $harga_satuan,
			],
		]);
	}

	public function get_detail_tabel_persuplier()
	{
		$kode_alat = $this->input->get('kode_alat');

		if (!$kode_alat) {
			echo json_encode(['status' => 'error', 'message' => 'Kode alat tidak dikirim']);
			return;
		}

		$data = $this->Detail_alat_model->get_all_detail_with_supplier($kode_alat);
		if (!empty($data)) {
			echo json_encode(['status' => 'success', 'data' => $data]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
		}
	}

	public function hapus_detail_supplier()
	{
		$id_alat_detail = $this->input->post('id_alat_detail');

		if (!$id_alat_detail) {
			echo json_encode(['status' => 'error', 'message' => 'ID detail tidak dikirim']);
			return;
		}


		$deleted = $this->Detail_alat_model->hapus_detail($id_alat_detail);

		if ($deleted) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
		}
	}

	public function count_supplier($kode_alat)
	{
		if (empty($kode_alat)) {
			echo json_encode(['jumlah' => 0]);
			return;
		}
		$jumlah = $this->Detail_alat_model->count_supplier($kode_alat);
		echo json_encode(['jumlah' => $jumlah]);
	}
}
