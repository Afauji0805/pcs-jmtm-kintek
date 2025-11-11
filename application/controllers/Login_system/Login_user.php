<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {
	public function index()
	{
		$this->load->view('Login_system/template_menu/js_header_login');
        $this->load->view('Login_system/template_menu/navbar_login');
        $this->load->view('Login_system/template/login_system');
		$this->load->view('Login_system/template_menu/footer_login');
        $this->load->view('Login_system/template_menu/js_footer_login');
	}
}