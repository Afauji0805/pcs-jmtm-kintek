<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Subkon_model $Subkon_model
 * @property input $input
 * @property db $db
 * @property Detail_subkon_model $Detail_subkon_model
 * @property session $session
 * @property getDetailSupplier $getDetailSupplier
 */

class Master_data_subkon extends CI_Controller
{

	/* ==============================
	 *  Controller : SUBKON
	 * ============================== */
	public function __construct()
	{
		parent::__construct();

		// Load model utama (Subkon_model)
		$this->load->model('Administrator/Master_data/Ubas_model/Subkon/Subkon_model');

		// Load model detail subkon
		$this->load->model('Administrator/Master_data/Ubas_model/Subkon/Detail_subkon_model');
	}

	public function index()
	{
		$data['subkon'] = $this->Subkon_model->get_all_subkon();
		$data['kode_otomatis'] = $this->Subkon_model->generate_kode_subkon();
		// subkon persuplier kirim ke view
		$data_detail['subkon_detail'] = $this->Detail_subkon_model->get_all_detail_subkon();
		$data_detail['kode_otomatis_persuplier'] = $this->Detail_subkon_model->generate_kode_detail_subkon('SK-1');

		foreach ($data['subkon'] as &$sk) {
			$this->load->model('Administrator/Master_data/Ubas_model/Subkon/Detail_subkon_model');
			$sk->jumlah_supplier = $this->Detail_subkon_model->count_supplier($sk->kode_subkon);
		}


		$this->load->view('Administrator/Master_data/Ubas_data/Master_subkon/Js_header_subkon');
		$this->load->view('Administrator/Master_data/template_menu/Navbar_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_subkon/Data_subkon', $data);
		$this->load->view('Administrator/Master_data/template_menu/Footer_ubas');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_subkon/Js_footer_subkon');
		$this->load->view('Administrator/Master_data/Ubas_data/Master_subkon/Ajax_subkon');
	}

	// tambah
	public function tambah()
	{
		if ($this->input->method() !== 'post') {
			show_error('Invalid request method', 405);
		}

		$data = [
			'kode_subkon'   => $this->Subkon_model->generate_kode_subkon(),
			'uraian_subkon' => $this->input->post('uraian_subkon'),
			'satuan_subkon' => $this->input->post('satuan_subkon'),
			'status_subkon' => 'Active',
		];

		$this->Subkon_model->insert_subkon($data);
		redirect('Administrator/Master_data/Master_subkon/Master_data_subkon');
	}

	// togle aktif non aktif
	public function toggle_status()
	{
		$id = $this->input->post('id_subkon');
		$status = $this->input->post('status');

		if ($id && $status) {
			$this->db->where('id_subkon', $id);
			$this->db->update('tb_subkon', ['status_subkon' => $status]);

			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

	// detail
	public function get_detail_subkon()
	{
		$id = $this->input->get('id_subkon');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_subkon', ['id_subkon' => $id])->row_array();

		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}

	// Update/ubah
	public function update_subkon()
	{
		$id_subkon   = $this->input->post('id_subkon');
		$uraian_subkon = $this->input->post('uraian_subkon');
		$satuan_subkon = $this->input->post('satuan_subkon');
		$sql = "CALL sp_update_master_subkon(?, ?, ?)";
		$this->db->query($sql, [$id_subkon, $uraian_subkon, $satuan_subkon]);
		mysqli_next_result($this->db->conn_id);
		echo json_encode([
			'status' => 'success',
			'csrf_token' => $this->security->get_csrf_hash()
		]);
	}


	/* ==============================
	 *  Controller : DETAIL SUBKON
	 * ============================== */
	public function tambah_detail()
	{
		$kode_subkon = $this->input->post('kode_subkon');
		$harga_satuan = $this->input->post('harga_satuan');

		if (!$kode_subkon || !$harga_satuan) {
			$this->session->set_flashdata('error', 'Data belum lengkap');
			redirect('Administrator/Master_data/Master_subkon/Master_data_subkon');
			return;
		}

		// pakai class Detail_subkon_model yang disatukan
		$kode_detail_subkon = $this->Detail_subkon_model->generate_kode_detail_subkon($kode_subkon);

		$data = [
			'kode_subkon'        => $kode_subkon,
			'kode_detail_subkon' => $kode_detail_subkon,
			'harga_satuan'     => $harga_satuan,
		];

		$this->Detail_subkon_model->insert($data);
		$this->session->set_flashdata('success', 'Detail subkon berhasil ditambahkan');
		redirect('Administrator/Master_data/Master_subkon/Master_data_subkon');
	}

	// detail persuplier
	public function get_detail_persuplier()
	{
		$id = $this->input->get('id_subkon');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_subkon', ['id_subkon' => $id])->row();


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

			'kode_subkon_detail' => $this->Detail_subkon_model->generate_kode_detail_subkon($this->input->post('kode_subkon')),
			'harga_satuan' => $this->input->post('harga_satuan'),

		];

		$this->Detail_subkon_model->insert($data);
		redirect('Administrator/Master_data/Master_subkon/Master_data_subkon');
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

		$kode_subkon     = $this->input->post('kode_subkon');
		$kode_supplier = $this->input->post('kode_supplier');
		$harga_satuan  = $this->input->post('harga_satuan');

		if (empty($kode_subkon) || empty($kode_supplier) || empty($harga_satuan)) {
			echo json_encode(['status' => 'error', 'message' => 'Semua kolom wajib diisi.']);
			return;
		}

		$kode_detail_subkon = $this->Detail_subkon_model->generate_kode_detail_subkon($kode_subkon);

		$data = [
			'kode_subkon'         => $kode_subkon,
			'kode_subkon_detail'  => $kode_detail_subkon,
			'kode_supplier'     => $kode_supplier,
			'harga_satuan'      => $harga_satuan,
		];

		$this->Detail_subkon_model->insert($data);

		$supplier = $this->db->get_where(
			'vw_detail_master_subkon',
			[
				'kode_subkon_detail' => $kode_detail_subkon,
				'kode_subkon' => $kode_subkon,
				'kode_supplier' => $kode_supplier,
			]
		)->row();
		$nama_supplier = $supplier ? $supplier->nama_supplier : '';
		echo json_encode([
			'status' => 'success',
			'message' => 'Data berhasil disimpan.',
			'data' => [
				'id_subkon_detail' => $supplier->id_subkon_detail,
				'kode_subkon_detail' => $kode_detail_subkon,
				'kode_supplier' => $kode_supplier,
				'nama_supplier' => $nama_supplier,
				'harga_satuan' => $harga_satuan,
			],
		]);
	}

	public function get_detail_tabel_persuplier()
	{
		$kode_subkon = $this->input->get('kode_subkon');

		if (!$kode_subkon) {
			echo json_encode(['status' => 'error', 'message' => 'Kode subkon tidak dikirim']);
			return;
		}

		$data = $this->Detail_subkon_model->get_all_detail_with_supplier($kode_subkon);
		if (!empty($data)) {
			echo json_encode(['status' => 'success', 'data' => $data]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
		}
	}

	public function hapus_detail_supplier()
	{
		$id_subkon_detail = $this->input->post('id_subkon_detail');

		if (!$id_subkon_detail) {
			echo json_encode(['status' => 'error', 'message' => 'ID detail tidak dikirim']);
			return;
		}


		$deleted = $this->Detail_subkon_model->hapus_detail($id_subkon_detail);

		if ($deleted) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
		}
	}

	public function count_supplier($kode_subkon)
	{
		if (empty($kode_subkon)) {
			echo json_encode(['jumlah' => 0]);
			return;
		}
		$jumlah = $this->Detail_subkon_model->count_supplier($kode_subkon);
		echo json_encode(['jumlah' => $jumlah]);
	}
}
