<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SendEmail {
	protected $CI;

	private $smtp_host;
	private $smtp_port;
	private $smtp_user;
	private $smtp_pass;
	private $username;

	public $to;
	public $msg;
	public $subject;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->setup();

	}

	private function setup(){
		$this->smtp_host = "mail.baktipemuda.org";
		$this->smtp_port = "25";
		$this->smtp_user = "bakti@baktipemuda.org";
		$this->smtp_pass = "baktipemuda123";
		$this->username	 = "Bakti Pemuda Nusantara";
	}

	public function sendMail(){
		$config = array();
		$config['useragent']           = "CodeIgniter";
		$config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
		$config['protocol']            = "smtp";
		$config['smtp_host']           = $this->smtp_host;
		$config['smtp_port']           = $this->smtp_port;
		$config['smtp_user'] 		   = $this->smtp_user;
		$config['smtp_pass'] 		   = $this->smtp_pass;
		$config['mailtype'] 		   = 'html';
		$config['charset']  		   = 'utf-8';
		$config['newline']             = "\r\n";
		$config['wordwrap']            = TRUE;

		$this->CI->load->library('email');

		$this->CI->email->initialize($config);
		$this->CI->email->from($this->smtp_user, $this->username);
		$this->CI->email->to($this->to);
		$this->CI->email->subject($this->subject);

		$this->CI->email->message($this->msg);
		if($this->CI->email->send()){
			return array('status'=>true,'msg'=>'berhasil');
		} else {
			return array('status'=>false,'msg'=>'gagal');
//			print_r($this->CI->email->print_debugger());
		}
	}

}