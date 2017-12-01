<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

    private $dirview = 'admins';
    private $url = 'admins';
    private $title = 'Admin';
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->model = new M_admin();
    }

    public function index()
    {
        $this->load->view('admin/'.$this->dirview.'/v_index',array(
            'title'=>$this->title,
            'data'=>$this->model->getAll(),
            'url'=>$this->url
        ));
    }

    public function tambah()
    {
        //if($this->session->userdata('id') != "masteradminbakti")
           //show_404();

        if($this->input->post()){
            $data = array(
                'nama'=>$this->input->post('nama',true),
                'email'=>$this->input->post('email',true),
                'password'=>$this->encrypt->hash($this->input->post('password',true)),
                'status'=>$this->input->post('status',true),
            );
            if(!$this->model->insert($data)){
                $this->load->view('admin/'.$this->dirview.'/v_tambah',array(
                    'title'=>'Tambah '.$this->title,
                    'err'=>'Maaf, terjadi kesalahan saat melakukan penyimpanan.',
                    'url'=>$this->url
                ));
            } else {
                redirect($this->master->adminUrl($this->url));
            }
        } else {
            $this->load->view('admin/'.$this->dirview.'/v_tambah',array(
                'title'=>'Tambah '.$this->title,
                'url'=>$this->url
            ));
        }
    }

    public function ubah($id=''){
        if($this->input->post()){
            $data = array(
                'nama'=>$this->input->post('nama',true),
                'email'=>$this->input->post('email',true),
                'status'=>$this->input->post('status',true),
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
            $this->load->view('admin/' . $this->dirview . '/v_ubah', array(
                'title' => 'Ubah ' . $this->title,
                'row' => $this->model->getRow($id),
                'url' => $this->url
            ));
        }
    }

    public function delete(){
        if(!isset($_POST['id']))
            echo json_encode(array('status'=>false,'msg'=>'Method Not Allowed'));

        $data = array('id'=>$this->input->post('id',true));
        $this->db->where($data);
        $this->db->delete('berita');
        echo json_encode(array('status'=>true,'msg'=>'Data Berhasil Dihapus'));
    }
}