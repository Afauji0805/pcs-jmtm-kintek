<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Supplier_model $Supplier_model
 * @property input $input
 * @property db $db
 */

class Master_data_supplier extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Administrator/Master_data/Supplier/Supplier_model');
	}

	public function index()
	{
		$data['supplier'] = $this->Supplier_model->get_all_supplier();
		$data['kode_otomatis'] = $this->Supplier_model->generate_kode_supplier();

		$this->load->view('Administrator/Master_data/Supplier_data/Js_header_supplier');
		$this->load->view('Administrator/Master_data/template_menu/Navbar_ubas');
		$this->load->view('Administrator/Master_data/Supplier_data/Data_supplier', $data);
		$this->load->view('Administrator/Master_data/template_menu/Footer_ubas');
		$this->load->view('Administrator/Master_data/Supplier_data/Js_footer_supplier');
		$this->load->view('Administrator/Master_data/Supplier_data/Ajax_supplier');
	}

	// tambah
	public function tambah()
	{
		if ($this->input->method() !== 'post') {
			show_error('Invalid request method', 405);
		}

		$data = [
			'kode_supplier'   => $this->Supplier_model->generate_kode_supplier(),
			'nama_supplier' => $this->input->post('nama_supplier'),
			'pic_supplier' => $this->input->post('pic_supplier'),
			'alamat_supplier' => $this->input->post('alamat_supplier'),
			'status_supplier' => 'Active',
		];

		$this->Supplier_model->insert_supplier($data);
		redirect('Administrator/Master_data/Master_supplier/Master_data_supplier');
	}

	// togle aktif non aktif
	public function toggle_status()
	{
		$id = $this->input->post('id_supplier');
		$status = $this->input->post('status');

		if ($id && $status) {
			$this->db->where('id_supplier', $id);
			$this->db->update('tb_supplier', ['status_supplier' => $status]);

			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

	// detail
	public function get_detail_supplier()
	{
		$id = $this->input->get('id_supplier');

		if (!$id) {
			echo json_encode(['error' => 'ID tidak dikirim']);
			return;
		}

		$data = $this->db->get_where('tb_supplier', ['id_supplier' => $id])->row();

		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}

	// Update/ubah
	public function update_supplier()
	{
		$id = $this->input->post('id_supplier');

		$data = [
			'nama_supplier' => $this->input->post('nama_supplier'),
			'pic_supplier' => $this->input->post('pic_supplier'),
			'alamat_supplier' => $this->input->post('alamat_supplier'),
		];

		$this->db->where('id_supplier', $id);
		$this->db->update('tb_supplier', $data);

		echo json_encode(['status' => 'success']);
	}
}
