<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CekAdminLogin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect($this->master->adminUrl('login'));
	}

}