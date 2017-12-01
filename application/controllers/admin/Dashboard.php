<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// $this->db->where('tgl_daftar between "'.date('Y-m-01 00:00:00').'" and "'.date('Y-m-t 23:59:59').'"');
		// $user = $this->db->get('donatur');

		// $konfirmasi = $this->db->get_where('bukti_transfer', array('status'=>'Pending'));
		$this->db->select('famili_tanaman.nama as nama_famili, master_tanaman.*');
        $this->db->join('famili_tanaman','famili_tanaman.id = master_tanaman.id_famili');
        $data = $this->db->get('master_tanaman');
		$this->load->view('admin/v_dashboard',array(
			'data'=>$data
		));
	}

}
