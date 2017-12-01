<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('login_admin'))
			redirect($this->master->adminUrl('dashboard'));
		
		$this->load->library('form_validation');
		$this->load->model('M_loginadmin');

		if($this->input->post()){
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
			/** Validation **/
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/v_login');	
			} else {
				/** Cek Login Database **/
				$id = $this->input->post('email',true);
				$password = $this->encrypt->hash($this->input->post('password',true));
				if(!$this->M_loginadmin->cekLogin($id,$password)){
					$data['err_login'] = 'Username dan Password Anda Salah!';
					$this->load->view('admin/v_login',$data);
				} else {
					redirect($this->master->adminUrl('dashboard'));
				}
			}
		}else {
			$this->load->view('admin/v_login');	
		}
	}

	public function logout(){
		$this->load->model('M_loginadmin');
		$this->M_loginadmin->logout();
	}

	public function forgot(){
		if($this->input->post()){
			$this->load->model('M_loginadmin');
			$email = $this->input->post('email',true);
			if($this->M_loginadmin->forgot_password($email)){
				$sendEmail = $this->sendEmail($this->input->post('email'));
				if($sendEmail['status']){
					$data['msg'] = '<strong>Terima kasih, </strong>sistem sudah mengirimkan alamat perubahan kata sandi ke email anda.';
					$data['class'] = 'success';
				} else {
					$data['msg'] = '<strong>Ooopss, </strong>terjadi kesalahan saat mengirimkan email, hubungi administrator segera.';
					$data['class'] = 'warning';
				}
			} else {
				$data['msg'] = '<strong>Maaf, </strong> Email anda tidak ada di sistem kami.';
				$data['class'] = 'danger';
			}

			$this->load->view('admin/v_forgot_password',$data);
		} else {
			$this->load->view('admin/v_forgot_password');
		}
	}

	private function sendEmail($email){
		//cek expired, jika belum expired maka jangan dikirimkan email lagi
		$current_time = date('Y-m-d H:i:s');
		$this->db->order_by('created_at','desc');
		$this->db->where("expired > '$current_time'");
		$tmp = $this->db->get_where('forgot_password_admin',array('email'=>$email,'status'=>'0'))->row();

		if($tmp) {
			return array('status'=>true);
		}else {
			//input data ke tabel lupa password, generate token dan key
			$token = $this->generateString();
			$key   = $this->generateString();
			$url   = base_url('admin/login/recovery/?token='.$token.'&key='.$key);
			$this->db->insert('forgot_password_admin',array(
				'email'=>$email,
				'forgot_key'=>$key,
				'forgot_token'=>$token,
				'expired'=>date("Y-m-d H:i:s", strtotime("+120 minutes")),
				'status'=>'0'
			));


			$this->load->library('SendEmail');
			$mail = new SendEmail();
			$mail->to = $email;
			$mail->subject = "Recovery Password - Admin Bakti Pemuda Nusantara";
			$mail->msg = "Klik link berikut untuk mengatur ulang password anda: <a href='".$url."'> Link</a>";
			return $mail->sendMail();
		}
	}

	private function generateString($length=255){
		$str = "";
		$char = array_merge(range('A','Z'),range('a','z'),range('0','9'));
		$max = count($char) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $char[$rand];
		}
		return $str;
	}

	public function recovery(){
		$token = $this->input->get('token');
		$key = $this->input->get('key');
		$current_time = date('Y-m-d H:i:s');
		$this->db->order_by('created_at','desc');
		$this->db->where("expired > '$current_time'");
		$row = $this->db->get_where('forgot_password_admin',array('forgot_token'=>$token,'forgot_key'=>$key,'status'=>'0'))->row();
		if($row){
			if($_POST){
				//cek email apakah ada di forgot password atau tidak
				$row_post = $this->db->get_where('forgot_password_admin',array('forgot_token'=>$token,'forgot_key'=>$key,'status'=>'0','email'=>$this->input->post('email', true)))->row();
				if($row_post){
					if($this->input->post('password',true) != $this->input->post('repassword',true)){
						$this->load->view('admin/v_recovery',array(
							'err2'=>'Maaf, password yang anda masukkan tidak sesuai'
						));
					} else {
						$update_passwd = array(
							'password'=>$this->encrypt->hash($this->input->post('password', true))
						);
						$this->db->where('email',$this->input->post('email'));
						$this->db->update('admin',$update_passwd);

						//update dari tabel forgot_password_admin
						$this->db->where('forgot_token',$token);
						$this->db->where('forgot_key',$key);
						$this->db->update('forgot_password_admin',array(
							'status'=>'1',
							'date_update'=>date('Y-m-d H:i:s')
						));

						$this->load->view('admin/v_recovery',array(
							'success'=>'Terima kasih, password anda sudah diperbaharui.'
						));
					}
				} else {
					$this->load->view('admin/v_recovery',array(
						'err2'=>'Maaf, email yang anda masukkan salah.'
					));
				}
			} else {
				//update link menjadi sudah dibuka
				$data = array(
					'date_check' => date('Y-m-d H:i:s'),
				);
				$this->db->update('forgot_password_admin', $data);
				$this->load->view('admin/v_recovery', array());
			}
		} else{
			$this->load->view('admin/v_recovery',array(
				'err'=>'Maaf, URL tidak tersedia atau sudah kadaluarsa'
			));
		}
	}

}