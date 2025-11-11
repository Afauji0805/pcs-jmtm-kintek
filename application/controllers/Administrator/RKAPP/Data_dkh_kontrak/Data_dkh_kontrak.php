<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_dkh_kontrak extends CI_Controller
{
	
	public function index()
	{
		$this->load->view('Administrator/RKAPP/Dkh_kontrak/js_header_dkh_kontrak');
		$this->load->view('Administrator/Dashboard/template_menu/navbar_dashboard');
		$this->load->view('Administrator/RKAPP/Dkh_kontrak/data_dkh_kontrak');
		$this->load->view('Administrator/Dashboard/template_menu/footer_dashboard');
		$this->load->view('Administrator/RKAPP/Dkh_kontrak/js_footer_dkh_kontrak');
	}
}