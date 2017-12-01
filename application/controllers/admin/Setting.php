<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    private $dirview = 'donatur';
    private $url = '';
    private $title = 'Donatur';
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->model = new M_admin();
    }

    public function ubahpassword(){
        if($this->input->post('old', true) != null){
            //cek password baru dulu
            $user = $this->model->getRow(array('email'=>$this->session->userdata('email')));
            $old = $this->encrypt->hash($this->input->post('old'));
            $new = $this->encrypt->hash($this->input->post('new'));
            $re = $this->encrypt->hash($this->input->post('re'));

            //kalau password lama tidak sesuai
            if($old != $user->password){
                $status = array("status"=>false,"msg"=>"Maaf, password lama tidak sesuai");
            } else {
                //cek password baru dan re password
                if($new != $re){
                    $status = array("status"=>false,"msg"=>"Maaf, password baru tidak sama");
                } else {
                    $this->model->update(array('email'=>$this->session->userdata('email')),array(
                        'password'=>$new
                    ));
                    $status = array("status"=>true,"msg"=>"Berhasil, Terima kasih password anda sudah diperbarui");

                }

            }

            $this->load->view('admin/v_ubahpassword', array(
                'title' => $this->title,
                'url' => $this->url,
                'msg'=>$status
            ));
        } else {
            $this->load->view('admin/v_ubahpassword', array(
                'title' => $this->title,
                'url' => $this->url
            ));
        }
    }

}