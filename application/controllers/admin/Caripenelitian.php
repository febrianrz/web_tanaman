<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Caripenelitian extends CI_Controller {
    private $dirview = 'cari_penelitian';
    private $url = 'caripenelitian';
    private $title = 'Pencarian Penelitian';
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tanaman');
        $this->model = new M_tanaman();
    }
    public function index()
    {
        $data = null;

        if($this->input->get('judul_penelitian')){
            $judul      = $this->input->get('judul_penelitian');
            $result     = (object) $this->curl_data('search',['judul_penelitian'=>$judul]);
            $data       = $result->data; 

        }

        $this->load->view('admin/'.$this->dirview.'/v_index',array(
            'title'=>$this->title,
            'url'=>$this->url,
            'data'=>$data
        ));
    }

    public function result()
    {
        $this->db->select('famili_tanaman.nama as nama_famili, master_tanaman.*');
        $this->db->join('famili_tanaman','famili_tanaman.id = master_tanaman.id_famili');
        $data = $this->model->getAll();
        $this->load->view('admin/'.$this->dirview.'/v_result',array(
            'title'=>$this->title,
            'data'=>$data,
            'url'=>$this->url
        ));
    }
   
    
    private function curl_data($endpoint,$data){
        $string_param = "id_source=".$this->config->item("id_source");
        foreach($data as $key => $val){
            if($key != 'status_simpan'){
                if($key=='id_famili'){
                    $famili = $this->db->get_where('famili_tanaman',['id'=>$val])->row();
                    $string_param .= "&famili=$famili->nama";
                } else {
                    $string_param .= "&$key=$val";
                }
            }
            
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->config->item("url_main_server").$endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string_param);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $server_output = curl_exec ($ch);
        
        curl_close ($ch);
        $arr_ouput      = json_decode($server_output);
        
        return $arr_ouput;
    }
    
    public function detail($id=0){
           //detail tanaman
            $result     = (object) $this->curl_data('detail',['id'=>1]);
            

            if(!$result){
                show_404();
            } else {
                $data       = $result->data; 
                $this->load->view('admin/tanaman/v_detail',array(
                    'title'=>'Detail '.$this->title,
                    'row' => $data,
                    'url' => $this->url,
                    'famili' => $data
                ));    
            }
    }
}