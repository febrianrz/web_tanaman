<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('login_donatur'))
            redirect(base_url('login'));
    }

    public function profile()
    {
        if($this->input->get('donasi') != null) {
            $this->load->model('M_donatur');
            //cek dulu, donasi ini adalah donatur ini atau bukan
            $donasi = $this->M_donatur->getDonasiDonatur($this->session->userdata('id'), $this->input->get('donasi'))->row();
            //kalau tidak ada, di riderect ke halaman utama
            if(count($donasi) == 0)
                redirect(base_url());

            $user = $this->db->get_where('donatur', array('id' => $this->session->userdata('id')));
            $this->db->select('donasi_donatur.id, donasi_donatur.periode ,donatur_jenis_anak_asuh.total_anak_asuh ,jenis_anak_asuh.nama, jenis_anak_asuh.nominal, donasi_donatur.nominal as totalnominal');
            $this->db->join('jenis_anak_asuh','jenis_anak_asuh.id = donatur_jenis_anak_asuh.id_jenis_anak_asuh');
            $this->db->join('donasi_donatur','donasi_donatur.id = donatur_jenis_anak_asuh.id_donasi_donatur');
            $this->db->where('donasi_donatur.id_donatur = '.$this->session->userdata('id'));
            $this->db->where('donasi_donatur.id = '.$this->input->get('donasi'));
            $detailota = $this->db->get('donatur_jenis_anak_asuh');

            $this->db->order_by('anak_asuh.nama','asc');
            $anakasuh = $this->M_donatur->getDonasiAnakAsuh($this->input->get('donasi'));
            $this->load->view('front/v_user_profile_detail_donasi', array(
                'row' => $user->row(),
                'donasi' => $donasi,
                'anakasuh'=> $anakasuh,
                'pembayaran'=>$this->M_donatur->getPembayaranDonatur($this->input->get('donasi')),
                'detailota'=>$detailota
            ));
        } else {
            $this->load->model('M_donatur');
            $user = $this->db->get_where('donatur', array('id' => $this->session->userdata('id')));
            $this->db->select('donasi_donatur.id, donasi_donatur.periode,donatur_jenis_anak_asuh.total_anak_asuh ,jenis_anak_asuh.nama, jenis_anak_asuh.nominal, donasi_donatur.nominal as totalnominal');
            $this->db->join('jenis_anak_asuh','jenis_anak_asuh.id = donatur_jenis_anak_asuh.id_jenis_anak_asuh');
            $this->db->join('donasi_donatur','donasi_donatur.id = donatur_jenis_anak_asuh.id_donasi_donatur');
            $this->db->where('donasi_donatur.id_donatur = '.$this->session->userdata('id'));
            $detailota = $this->db->get('donatur_jenis_anak_asuh');
            $this->load->view('front/v_user_profile', array(
                'row' => $user->row(),
                'donasi' => $this->M_donatur->getDonasi($this->session->userdata('id')),
                'detailota'=>$detailota
            ));
        }
    }

    public function anakasuh(){
        if($this->input->get('id',true) == null)
            show_404();

        $this->load->model('M_anakasuh');
        $data['row'] = $this->M_anakasuh->getRow($this->input->get('id',true));
        $this->load->view('front/v_user_anak_asuh',$data);
    }

    public function konfirmasi(){
        if($this->input->post() == null) {
            $this->load->view('front/v_user_konfirmasi');
        } else {
            //jika berhasil upload, maka simpan kedalam database
            $upload = $this->do_upload();
            if(!$upload['status']){
                $this->load->view('front/v_user_konfirmasi',array(
                    'err'=>$upload['msg']
                ));
            } else {
                //simpan ke tabel bukti transaksi
                $data = array(
                    'id_donatur'=>$this->session->userdata('id'),
                    'tgl_transfer'=>date('Y-m-d', strtotime($this->input->post('tgl_transfer', true))),
                    'bank'=>$this->input->post('bank',true),
                    'nama_pemilik'=>$this->input->post('nama_pemilik',true),
                    'nominal'=>$this->input->post('nominal', true),
                    'status'=>'Pending',
                    'keterangan'=>$this->input->post('keterangan', true),
                    'gambar'=>$upload['msg']
                );
                $this->db->insert('bukti_transfer',$data);
                redirect(base_url('user/sukses'));
            }
        }
    }

    public function sukses(){
        $this->load->view('front/v_user_sukses_konfirmasi');
    }

    private function do_upload(){
        $namafile = date('YmdHis').time().rand(1000,9999);
        $config['upload_path'] = 'assets/upload/bukti_transfer';
        $config['file_name'] = $namafile;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '2048';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data = array('status'=>false, 'msg'=>$this->upload->display_errors());
        }
        else
        {
            $data = array('status'=>true, 'msg'=>$this->upload->data('file_name'));
        }
        return $data;
    }
}