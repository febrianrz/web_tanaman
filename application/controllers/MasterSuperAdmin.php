<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*	File ini di block oleh url
*/

class MasterSuperAdmin extends CI_Controller {

	private $baseAdmin;

	public function __construct()
	{
		parent::__construct();
		$this->baseAdmin = 'admin';

		/** Check if Login **/
		if(!$this->session->userdata('login_admin'))
			redirect($this->getBaseAdmin('login'));
		else
			redirect($this->getBaseAdmin('dashboard'));
	}

	
}