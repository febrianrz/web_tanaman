<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanaman extends CI_Controller {

    private $dirview = 'tanaman';
    private $url = 'tanaman';
    private $title = 'Master Tanaman';
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tanaman');
        $this->model = new M_tanaman();
    }

    public function index()
    {
        $this->db->select('famili_tanaman.nama as nama_famili, master_tanaman.*');
        $this->db->join('famili_tanaman','famili_tanaman.id = master_tanaman.id_famili');
        $data = $this->model->getAll();

        $this->load->view('admin/'.$this->dirview.'/v_index',array(
            'title'=>$this->title,
            'data'=>$data,
            'url'=>$this->url
        ));
    }

    public function tambah()
    {
       if($this->input->post()){ 
            if($this->input->post('status_simpan') == 1){
                $dataExist = $this->isExistOnMainServer();
                if($dataExist->status){
                    $dataTanamanExist = "";
                    foreach($dataExist->data as $dt){
                        $dataTanamanExist .= "$dt->nama_tanaman pada $dt->source";
                    }
                    echo json_encode(['status'=>false,'msg'=>$dataTanamanExist,'data'=>$dataExist->data,'code'=>101]);
                    exit();     
                }
            } 
            
            $status_insert_server = $this->sendToMainServer();
            // print_r($status_insert_server);die();
            if(!$status_insert_server->status){
                echo json_encode(['status'=>false,'msg'=>"Gagal Menyimpan Data",'code'=>102]);
                exit();
            } else {
                $status_save = $this->saveToDB();
                if(!$status_save){
                    echo json_encode(['status'=>false,'msg'=>"Gagal Menyimpan Data",'code'=>102]);
                    exit();
                }    
                echo json_encode(['status'=>true,'msg'=>"Berhasil Menyimpan Data",'code'=>100]);
                exit();
            }
            
        } 
        else {
            $this->load->model('M_famili');
            $this->load->view('admin/'.$this->dirview.'/v_tambah',array(
                'title'=>'Tambah '.$this->title,
                'famili'=> $this->M_famili->getAll(),
                'url'=>$this->url
            ));
        }
    }

    private function isExistOnMainServer(){
        return $this->curl_data("is_exist",['nama_tanaman'=>$this->input->post('nama_tanaman',true)]);
    }

    private function sendToMainServer(){
        // print_r($this->input->post());die();
        return $this->curl_data("insert",$this->input->post());
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

    public function tes(){
        print_r($this->curl_data("is_exist",['nama_tanaman'=>'luwak']));
    }

    private function saveToDB(){
            $data = array(
                'nama_tanaman'=>$this->input->post('nama_tanaman',true),
                'nama_ilmiah'=>$this->input->post('nama_ilmiah',true),
                'id_famili'=>$this->input->post('id_famili',true),
                'pemanfaatan'=>$this->input->post('pemanfaatan',true),
                'latitude'=>$this->input->post('latitude',true),
                'longitude'=>$this->input->post('longitude',true),
                'peneliti'=>$this->input->post('peneliti',true),
                'nama_lembaga'=>$this->input->post('nama_lembaga',true),
                'tempat_penelitian'=>$this->input->post('tempat_penelitian',true),
                'nama_etnis'=>$this->input->post('nama_etnis',true),
                'tujuan'=>$this->input->post('tujuan',true),
                'waktu_penelitian'=>$this->input->post('waktu_penelitian',true),
                'metode_penelitian'=>$this->input->post('metode_penelitian',true),
                'ketinggian_lokasi'=>$this->input->post('ketinggian_lokasi',true),
                'bentuk_pemanfaatan'=>$this->input->post('bentuk_pemanfaatan',true),
                'kandungan'=>$this->input->post('kandungan',true),
                'cara_penggunaan'=>$this->input->post('cara_penggunaan',true),
                'khasiat'=>$this->input->post('khasiat',true),
                'media_tanam'=>$this->input->post('media_tanam',true),
                'ciri_fisik'=>$this->input->post('ciri_fisik',true)
            );
            $this->db->trans_start();
            $this->model->insert($data);
            if($this->db->trans_status()){
                $this->db->trans_commit();
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
            
    }


    public function ubah($id=''){
        if($this->input->post()){

            if(!$this->model->update($id,$this->input->post())){
                $data = $this->model->getRow($id);
                $this->db->where('id_provinsi',$data->id_provinsi);
                $kabupaten = $this->M_kabupatenkota->getAll();
                $this->load->view('admin/' . $this->dirview . '/v_ubah', array(
                    'title' => 'Ubah ' . $this->title,
                    'err'=> 'Maaf, terjadi kesalahan saat akan melakukan perubahan',
                    'row' => $data,
                    'url' => $this->url
                ));
            } else {
                redirect($this->master->adminUrl($this->url));
            }
        } else {
            $data = $this->model->getRow($id);
            $this->load->model('M_famili');
            $this->load->view('admin/' . $this->dirview . '/v_ubah', array(
                'title' => 'Ubah ' . $this->title,
                'row' => $data,
                'url' => $this->url,
                'famili'=>$this->M_famili->getAll()
            ));
        }
    }

    public function detail($id=0){
           //detail tanaman
            $this->db->select('famili_tanaman.*');
            $this->db->join('master_tanaman','famili_tanaman.id = master_tanaman.id_famili');
            $this->db->where('master_tanaman.id ='.$id);
            $famili = $this->db->get('famili_tanaman');

            $this->load->view('admin/'.$this->dirview.'/v_detail',array(
                'title'=>'Detail '.$this->title,
                'row' => $this->model->getRow($id),
                'url' => $this->url,
                'famili' => $famili->row()
            ));
    }

    //setanakasuh
    public function set(){
        if(!isset($_GET['donasi']) || !isset($_GET['donatur']))
            show_404();

        $donasi = $this->model->getDonasiDonatur($this->input->get('donatur'), $this->input->get('donasi'))->row();
        if(!count($donasi))
            show_404();

        $this->db->select('anak_asuh.*');
        $this->db->join('donasi_anak_asuh', 'donasi_anak_asuh.id_anak_asuh = anak_asuh.id');
        $this->db->join('donasi_donatur', 'donasi_donatur.id = donasi_anak_asuh.id_donasi_donatur');
        $this->db->where('donasi_donatur.id_donatur',$this->input->get('donatur'));
        $anakasuh = $this->db->get('anak_asuh');
        $this->load->view('admin/'.$this->dirview.'/v_set_anakasuh',array(
            'title'=>'Detail '.$this->title,
            'title2'=>'Anak Asuh',
            'row' => $this->model->getRow($this->input->get('donatur', true)),
            'donasi'=>$donasi,
            'anakasuh'=>$anakasuh,

        ));
    }

    //ambil data anak asuh yang belum dipilih atau sudah dipilih
    public function getAnakAsuhDonatur(){
//        if(!isset($_POST))
//            show_404();

        $donatur = $this->input->post('id');
        if($this->input->post('status') == 'all'){
            $this->db->select('anak_asuh.*');
            $this->db->join('donasi_anak_asuh', 'donasi_anak_asuh.id_anak_asuh = anak_asuh.id');
            $this->db->join('donasi_donatur', 'donasi_donatur.id = donasi_anak_asuh.id_donasi_donatur');
            $this->db->where('donasi_donatur.id_donatur',$donatur);
            $anakasuh = $this->db->get('anak_asuh');
            echo json_encode($anakasuh->result_array());
        } else {
            $this->db->select('anak_asuh.*');
            $this->db->join('donasi_anak_asuh', 'donasi_anak_asuh.id_anak_asuh = anak_asuh.id');
            $this->db->join('donasi_donatur', 'donasi_donatur.id = donasi_anak_asuh.id_donasi_donatur');
            $this->db->where('donasi_donatur.id_donatur',$donatur);
            $anakasuhdipilih = $this->db->get('anak_asuh');

            $not = array(0);
            foreach($anakasuhdipilih->result() as $key){
                array_push($not, $key->id);
            }
            $this->db->where_not_in('id', $not);
            $anakasuh = $this->db->get('anak_asuh');
            echo json_encode($anakasuh->result_array());
        }
    }

    //simpan donatur dan anak asuh
    public function storeAnakAsuh(){
        if(!isset($_POST))
            show_404();

        $donatur = $this->input->post('donatur', true);
        $donasi = $this->input->post('donasi', true);
        $anakasuh = $this->input->post('anakasuh', true);

        //masukkan ke tabel donasi anak asuh
        if($this->model->insertDonasiAnakAsuh($donasi,$anakasuh))
            echo json_encode(array('status'=>true,'msg'=>''));
        else
            echo json_encode(array('status'=>false,'msg'=>'Terjadi Kesalahan Saat Penyimpanan'));

    }

    public function deleteAnakAsuh(){
        $donatur = $this->input->post('donatur', true);
        $donasi = $this->input->post('donasi', true);
        $anakasuh = $this->input->post('anakasuh', true);

        //delete data
        if($this->model->deleteDonasiAnakAsuh($donasi,$anakasuh))
            echo json_encode(array('status'=>true,'msg'=>''));
        else
            echo json_encode(array('status'=>false,'msg'=>'Terjadi Kesalahan Saat Penghapusan'));
    }

    //simpan pembayaran donatur
    public function storePembayaran(){
        $data = array(
            'id'=>date('YmdHis').time().rand(100,999),
            'id_donasi_donatur'=>$this->input->post('donasi', true),
            'keterangan'=>$this->input->post('keterangan', true),
            'nominal'=>$this->input->post('nominal')
        );

        if($this->model->insertPembayaran($data)){
            echo json_encode(array('status'=>true,'msg'=>'Data Berhasil Disimpan'));
        } else {
            echo json_encode(array('status'=>false,'msg'=>'Ooopsss!!! Terjadi kesalahan saat menghapus'));
        }
    }

    public function deletePembayaran(){
        if(!isset($_POST['id']))
            show_404();

        if($this->model->deletePembayaran($this->input->post('id'))){
            echo json_encode(array('status'=>true,'msg'=>''));
        } else {
            echo json_encode(array('status'=>false,'msg'=>'Ooopsss!!! Terjadi kesalahan saat menghapus'));
        }
    }

    public function printpdf(){
        $this->load->library('FPDF');

        if($this->input->get('like') != null){
          $id = $this->input->get('like');
          $this->db->like('donatur.nama',$id);
          $this->db->or_like('donatur.id',$id);
          $this->db->or_like('jenis_donasi.nama',$id);
          if(strtolower($id) == "aktif*"){
            $this->db->or_where('donatur.status = "Aktif"');
          } else {
            $this->db->or_like('donatur.status',$id);
          }
        }
        $this->db->order_by('donatur.nama','asc');
        $query = $this->model->getAll2();


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);

        //header
        $pdf->Image(base_url('assets/frontend/uploads/logobakti.png'),10,6,23);
        // Arial bold 15
        $pdf->SetFont('Arial','B',17);
        // Move to the right
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Yayasan Bakti Pemuda Nusantara',0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(80);
        $pdf->Cell(30,2,'Jl. Pahlawan No 8. Rempoa. Ciputat',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(80);
        $pdf->Cell(30,7,'Tangerang Selatan. Telp. 0813-1901-9065',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(190,3,'','B',0,'C');

        //isinya
        $pdf->Ln();
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Daftar Donatur',0,0,'C');

        $pdf->SetFont('Arial','B',10);
        $pdf->Ln(10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(35,6,'Nama',1,0,'C');
        $pdf->Cell(7,6,'L/P',1,0,'C');
        $pdf->Cell(25,6,'Tanggal Lahir',1,0,'C');
        $pdf->Cell(28,6,'Telepon',1,0,'C');
        $pdf->Cell(15,6,'Status',1,0,'C');
        $pdf->Cell(45,6,'Jenis Donasi',1,0,'C');
        $pdf->Cell(28,6,'Tanggal Daftar',1,0,'C');

        //looping
        $pdf->SetFont('Arial','B',8);
        $no = 1;
        foreach($query->result() as $key){
            $pdf->Ln();
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(35,6,$key->nama,1,0,'L');
            $pdf->Cell(7,6,($key->jkel=='Laki-laki'?'L':'P'),1,0,'C');
            $pdf->Cell(25,6,date('d-m-Y',strtotime($key->tgl_lahir)),1,0,'C');
            $pdf->Cell(28,6,$key->telepon,1,0,'C');
            $pdf->Cell(15,6,substr($key->status,0,1),1,0,'C');
            $pdf->CellFitScale(45,6,$key->jenis,1,0,'C');
            $pdf->Cell(28,6,date('d-m-Y',strtotime($key->tgl_daftar)),1,0,'C');
            $no++;
        }

        //footer
        $pdf->SetY(-1);
        $pdf->SetFont('Arial','I',8);
        $pdf->SetTextColor(128);
        $pdf->Cell(0,10,'Halaman '.$pdf->PageNo(),0,0,'C');

        $pdf->Output();
    }
}
