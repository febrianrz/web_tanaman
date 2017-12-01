<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_super extends CI_Model {

	protected $table = '';

	public function getAll()
	{
		return $this->db->get($this->table);
	}

	public function insert($data)
	{
		try{
			if($this->db->insert($this->table,$data)){
				return true;
			} else {
				return false;
			}
		} catch(Exception $e) {
			print_r($e);die();
		}
	}

	public function getRow($id){
		$sql = '';
		if(!is_array($id)){
			$sql = $this->db->get_where($this->table,array('id'=>$id));
		} else {
			$sql = $this->db->get_where($this->table,$id);
		}
		if($sql->num_rows() == 0)
			return false;
		else 
			return $sql->row();

	}

	public function update($id,$data){
		$result = false;
		try {
			if (!is_array($id)) {
				$this->db->update($this->table, $data, array('id' => $id));
			} else {
				$this->db->update($this->table, $data, $id);
			}
			$result = true;
		} catch(Exception $e){
			print_r($e->getMessage());die();
		}

		return $result;
	}

	public function delete($id){
		if(!is_array($id)){
			$this->db->where('id', $id);
			$this->db->delete($this->table);
		} else {
			$this->db->where($id);
			$this->db->delete($this->table);
		}
		return true;
	}

}