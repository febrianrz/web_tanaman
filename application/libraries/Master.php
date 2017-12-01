<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master {
	protected $CI;
	private $key;
	private $table;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->table = 'option_web';
		$this->key = 'id';
		$this->CI->load->library('Admin');
	}
	
	public function getOption($id=''){
		$value = '';
		$row = $this->CI->db->get_where($this->table,array($this->key=>$id))->row();
		if($row)
			$value = $row->option;

		return $value;
	}

	public function getBaseAdmin($url=null)
	{
		return $this->CI->admin->getBaseAdmin($url);
	}

	public function adminUrl($url=null)
	{
		return base_url($this->CI->admin->getBaseAdmin($url));
	}

	public function getInfoWeb($id=1){
		return $this->CI->db->get_where('info_web',array('id'=>$id))->row();
	}

	public function getProgram($id=1){
		return $this->CI->db->get_where('program',array('id'=>$id))->row();
	}

	public function getFirstImage($text){
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $text, $image);

		return (isset($image['src'])?$image['src']:base_url("assets/images/noimage.jpg"));
	}
}