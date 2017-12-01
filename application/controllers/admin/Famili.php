<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Famili extends CI_Controller {

    private $dirview = 'famili';
    private $url = 'famili';
    private $title = 'Famili Tanaman';
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_famili');
        $this->model = new M_famili();
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
        if($this->input->post()){
            if(!$this->model->insert($this->input->post())){
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
                'nama'=>$this->input->post('nama',true)
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
}
