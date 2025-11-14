<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_dkh_kontrak extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// load model di sini
		$this->load->model('Administrator/RKAPP/Dkh_model');
	}

	public function dkh_kontrak($kode_program)
	{
		// panggil store procedure
		$data['row_program'] = $this->Dkh_model->get_program_by_kode($kode_program);
		$this->load->view('Administrator/Rkapp/Dkh_kontrak/js_header_dkh_kontrak');
		$this->load->view('Administrator/Dashboard/template_menu/navbar_dashboard');
		$this->load->view('Administrator/Rkapp/Dkh_kontrak/data_dkh_kontrak', $data);
		$this->load->view('Administrator/Dashboard/template_menu/footer_dashboard');
		$this->load->view('Administrator/Rkapp/Dkh_kontrak/js_footer_dkh_kontrak');
	}
}
