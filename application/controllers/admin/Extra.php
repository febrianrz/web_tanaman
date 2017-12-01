<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extra extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function export()
	{
		if($this->input->post()){
			$this->load->dbutil();
			$this->load->helper(array('file','download'));
			$namafile = 'backupBPM_'.time().'.gz';

			$prefs = array(
		        'tables'        => $this->input->post('tables',true),
		        'ignore'        => array(),                    
		        'format'        => 'zip',                       
		        'filename'      => $namafile,              
		        'add_drop'      => FALSE,                        
		        'add_insert'    => TRUE,                        
		        'newline'       => "\n"                         
			);
			$backup = $this->dbutil->backup($prefs);
			
			write_file('/backup/'.$namafile, $backup);
			force_download($namafile, $backup);
		} else {
			$data['tables']	= $this->db->list_tables();
			$this->load->view('admin/extra/v_export',$data);	
		}
		
	}

	public function import()
	{
		$data['tables']	= $this->db->list_tables();
		$this->load->view('admin/extra/v_import',$data);	
	}

}