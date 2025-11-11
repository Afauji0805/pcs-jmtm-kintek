<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Upah_model $Upah_model
 * @property input $input
 * @property db $db
 * @property Detail_upah_model $Detail_upah_model
 * @property session $session
 * @property getDetailSupplier $getDetailSupplier
 */

class Master_data_upah extends CI_Controller
{

	/* ==============================
	 *  Controller : UPAH
	 * ============================== */
	public function __construct()
	{
		parent::__construct();

		// Load model utama (Upah_model)
		$this->load->model('Administrator/Master_data/Ubas_model/Upah/Upah_model');

		// Load model detail upah
		$this->load->model('Administrator/Master_data/Ubas_model/Upah/Detail_upah_model');
	}

	public function index()
	{
		$data['upah'] = $this->Upah_model->get_all_upah();
		$data['kode_otomatis'] = $this->Upah_model->generate_kode_upah();
		// upah persuplier kirim ke view
		$data_detail['upah_detail'] = $this->Detail_upah_model->get_all_detail_upah();
		$data_detail['kode_otomatis_persuplier'] = $this->Detail_upah_model->generate_kode_detail_upah('UP-1');

		foreach ($data['upah'] as &$up) {
			$this->load->model('Administrator/Master_data/Ubas_model/Upah/Detail_upah_model');
			$up->jumlah_supplier = $this->Detail_upah_model->count_supplier($up->kode_upah);
		}


		$this->load->view('Administrator/Master_data/Ubas_data/Master_upah/Js_header_upah');
		$this->load->view('Administrator/Master_data/template_menu/Navbar_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_upah/Data_upah', $data);
		$this->load->view('Administrator/Master_data/template_menu/Footer_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_upah/Js_footer_upah');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_upah/Ajax_upah');
	}

	// tambah
	public function tambah()
	{
		if ($this->input->method() !== 'post') {
			show_error('Invalid request method', 405);
		}

		$data = [
			'kode_upah'   => $this->Upah_model->generate_kode_upah(),
			'uraian_upah' => $this->input->post('uraian_upah'),
			'satuan_upah' => $this->input->post('satuan_upah'),
			'status_upah' => 'Active',
		];

		$this->Upah_model->insert_upah($data);
		redirect('Administrator/Master_data/Master_upah/Master_data_upah');
	}

	// togle aktif non aktif
	public function toggle_status()
	{
		$id = $this->input->post('id_upah');
		$status = $this->input->post('status');

		if ($id && $status) {
			$this->db->where('id_upah', $id);
			$this->db->update('tb_upah', ['status_upah' => $status]);

			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

	// detail
	public function get_detail_upah()
	{
		$id = $this->input->get('id_upah');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_upah', ['id_upah' => $id])->row_array();

		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}

	// Update/ubah
	public function update_upah()
	{
		$id_upah   = $this->input->post('id_upah');
		$uraian_upah = $this->input->post('uraian_upah');
		$satuan_upah = $this->input->post('satuan_upah');
		$sql = "CALL sp_update_master_upah(?, ?, ?)";
		$this->db->query($sql, [$id_upah, $uraian_upah, $satuan_upah]);
		mysqli_next_result($this->db->conn_id);
		echo json_encode([
			'status' => 'success',
			'csrf_token' => $this->security->get_csrf_hash()
		]);
	}


	/* ==============================
	 *  Controller : DETAIL UPAH
	 * ============================== */
	public function tambah_detail()
	{
		$kode_upah = $this->input->post('kode_upah');
		$harga_satuan = $this->input->post('harga_satuan');

		if (!$kode_upah || !$harga_satuan) {
			$this->session->set_flashdata('error', 'Data belum lengkap');
			redirect('Administrator/Master_data/Master_upah/Master_data_upah');
			return;
		}

		// pakai class Detail_upah_model yang disatukan
		$kode_detail_upah = $this->Detail_upah_model->generate_kode_detail_upah($kode_upah);

		$data = [
			'kode_upah'        => $kode_upah,
			'kode_detail_upah' => $kode_detail_upah,
			'harga_satuan'     => $harga_satuan,
		];

		$this->Detail_upah_model->insert($data);
		$this->session->set_flashdata('success', 'Detail upah berhasil ditambahkan');
		redirect('Administrator/Master_data/Master_upah/Master_data_upah');
	}

	// detail persuplier
	public function get_detail_persuplier()
	{
		$id = $this->input->get('id_upah');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_upah', ['id_upah' => $id])->row();


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

			'kode_upah_detail' => $this->Detail_upah_model->generate_kode_detail_upah($this->input->post('kode_upah')),
			'harga_satuan' => $this->input->post('harga_satuan'),

		];

		$this->Detail_upah_model->insert($data);
		redirect('Administrator/Master_data/Master_upah/Master_data_upah');
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

		$kode_upah     = $this->input->post('kode_upah');
		$kode_supplier = $this->input->post('kode_supplier');
		$harga_satuan  = $this->input->post('harga_satuan');

		if (empty($kode_upah) || empty($kode_supplier) || empty($harga_satuan)) {
			echo json_encode(['status' => 'error', 'message' => 'Semua kolom wajib diisi.']);
			return;
		}

		$kode_detail_upah = $this->Detail_upah_model->generate_kode_detail_upah($kode_upah);

		$data = [
			'kode_upah'         => $kode_upah,
			'kode_upah_detail'  => $kode_detail_upah,
			'kode_supplier'     => $kode_supplier,
			'harga_satuan'      => $harga_satuan,
		];

		$this->Detail_upah_model->insert($data);

		$supplier = $this->db->get_where(
			'vw_detail_master_upah',
			[
				'kode_upah_detail' => $kode_detail_upah,
				'kode_upah' => $kode_upah,
				'kode_supplier' => $kode_supplier,
			]
		)->row();
		$nama_supplier = $supplier ? $supplier->nama_supplier : '';
		echo json_encode([
			'status' => 'success',
			'message' => 'Data berhasil disimpan.',
			'data' => [
				'id_upah_detail' => $supplier->id_upah_detail,
				'kode_upah_detail' => $kode_detail_upah,
				'kode_supplier' => $kode_supplier,
				'nama_supplier' => $nama_supplier,
				'harga_satuan' => $harga_satuan,
			],
		]);
	}

	public function get_detail_tabel_persuplier()
	{
		$kode_upah = $this->input->get('kode_upah');

		if (!$kode_upah) {
			echo json_encode(['status' => 'error', 'message' => 'Kode upah tidak dikirim']);
			return;
		}

		$data = $this->Detail_upah_model->get_all_detail_with_supplier($kode_upah);
		if (!empty($data)) {
			echo json_encode(['status' => 'success', 'data' => $data]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
		}
	}

	public function hapus_detail_supplier()
	{
		$id_upah_detail = $this->input->post('id_upah_detail');

		if (!$id_upah_detail) {
			echo json_encode(['status' => 'error', 'message' => 'ID detail tidak dikirim']);
			return;
		}


		$deleted = $this->Detail_upah_model->hapus_detail($id_upah_detail);

		if ($deleted) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
		}
	}

	public function count_supplier($kode_upah)
	{
		if (empty($kode_upah)) {
			echo json_encode(['jumlah' => 0]);
			return;
		}
		$jumlah = $this->Detail_upah_model->count_supplier($kode_upah);
		echo json_encode(['jumlah' => $jumlah]);
	}
}
