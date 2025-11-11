<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller
{
	// angga
	public function index()
	{
		$this->load->view('Administrator/Dashboard/template_menu/js_header_dashboard');
		$this->load->view('Administrator/Dashboard/template_menu/navbar_dashboard');
		$this->load->view('Administrator/Dashboard/template/admin_dashboard');
		$this->load->view('Administrator/Dashboard/template_menu/footer_dashboard');
		$this->load->view('Administrator/Dashboard//template_menu/js_footer_dashboard');
	}
}
