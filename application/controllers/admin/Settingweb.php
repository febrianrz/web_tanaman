<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settingweb extends CI_Controller {

	private $dirview = 'settingweb';
	private $url = 'settingweb';
	private $title = 'Setting Website';
	private $model;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_settingweb');
		$this->model = new M_settingweb();
	}

	public function index()
	{
		//pengecualian untuk upload gambar dari tabel option_web berdasarkan id

		$this->load->view('admin/'.$this->dirview.'/v_index',array(
			'title'=>$this->title,
			'data'=>$this->model->getAll(),
			'url'=>$this->url,
		));
	}

	public function ubah($id=''){
		if($this->input->post()){
			$data = array(
				'nama'=>$this->input->post('nama', true),
				'option'=>$this->input->post('option', true)
			);
			if(!$this->model->update($id,$data)){
				$this->load->view('admin/' . $this->dirview . '/v_ubah', array(
					'title' => 'Ubah ' . $this->title,
					'err'=> 'Maaf, terjadi kesalahan saat akan melakukan perubahan',
					'row' => $this->model->getRow($id),
					'url' => $this->url
				));
			} else {
				redirect($this->master->adminUrl($this->url));
			}
		} else {
			$upload = array(2,3,4);
			$this->load->view('admin/' . $this->dirview . '/v_ubah', array(
				'title' => 'Ubah ' . $this->title,
				'row' => $this->model->getRow($id),
				'url' => $this->url,
				'upload'=>$upload
			));
		}
	}

	public function upload(){
		$config['upload_path'] = 'assets/images/option/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$data = array('status'=>false,'msg'=>$this->upload->display_errors());
		}
		else
		{
			$data = array('status'=>true,'msg'=>'Gambar Berhasil di Upload','filename'=>$this->upload->data('file_name'));
		}
		echo json_encode($data);
	}

}