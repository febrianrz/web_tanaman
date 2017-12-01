<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin {
	protected $CI;
	private $baseAdmin;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->baseAdmin = 'admin';
	}

	public function getBaseAdmin($url=null)
	{
		return $this->baseAdmin.(!is_null($url)?'/'.$url:'');
	}

}