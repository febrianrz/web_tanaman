<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_loginadmin extends CI_Model {

	private $table = 'admin';
	private $id = 'email';
	private $pass = 'password';

	public function cekLogin($id,$password)
	{
		$status = false;
		
		$row = $this->db->get_where($this->table,array(
			$this->id=>$id,
			$this->pass=>$password))->row();
			
		if($row){
			$this->session->set_userdata('login_admin',true);
			// print_r($this->session->userdata());die();
			$this->session->set_userdata('id',$row->id);
			$this->session->set_userdata('email',$row->email);
			$this->session->set_userdata('nama',$row->nama);
			$this->session->set_userdata('password',$row->password);
			$this->session->set_userdata('status',$row->status);
			$status = true;
		}
		
		return $status;	
	}

	public function logout()
	{
		if($this->session->userdata('login_admin')){
			$this->session->sess_destroy();
			redirect(base_url($this->master->getBaseAdmin('login')));
		} else {
			show_404();
		}
	}

	public function forgot_password($id){
		$sql = $this->db->get_where($this->table,array('email'=>$id))->row();
		if($sql){
			return true;
		} else {
			return false;
		}
	}
}