<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $redirect = 'user/profile';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('login_donatur')) {
            redirect(base_url($this->redirect));
        }

        if (!$this->input->post()) {
            $this->load->view('front/v_login');
        } else {
            $this->load->model('M_logindonatur');
            //cek login user
            $data = array(
                'email'=>$this->input->post('email', true),
                'password'=>$this->encrypt->hash($this->input->post('password', true))
            );
            if ($this->M_logindonatur->cekLogin($data)) {
                //redirect kehalaman utama user
                redirect(base_url($this->redirect));
            } else {
                $this->load->view('front/v_login', array(
                    'err'=>'Username dan Password Salah'
                ));
            }
        }
    }

    public function register()
    {
        $this->load->model(array('M_provinsi','M_jenisdonasi','M_donatur','M_jenisanakasuh'));
        if (!$this->input->post()) {
            $this->db->where('status', 'Aktif');
            $data['jenis'] = $this->M_jenisdonasi->getAll();
            $data['provinsi'] = $this->M_provinsi->getAll();
            $this->db->where('status', 'Aktif');
            $data['anak_asuh'] = $this->M_jenisanakasuh->getAll();

            $this->load->view('front/v_register', $data);
        } else {
            //cek email dulu, sudah ada atau belum
            $cek_donatur = $this->db->get_where('donatur', array('email'=>$this->input->post('email', true)));
            if ($cek_donatur->num_rows()) {
                $status = array('status'=>false,'msg'=>'Maaf, email tersebut sudah terdaftar.');
            } else {
                //Data Donatur
                $id_donatur = $this->genID(1);
                $token = $this->generateString();
                $data = array(
                    'id' => $id_donatur,
                    'nama' => $this->input->post('nama', true),
                    'email' => $this->input->post('email', true),
                    'password' => $this->encrypt->hash($this->input->post('password', true)),
                    'tgl_lahir' => date('Y-m-d', strtotime($this->input->post('tgl_lahir', true))),
                    'jkel' => $this->input->post('jkel', true),
                    'profesi' => $this->input->post('pekerjaan', true),
                    'alamat' => $this->input->post('alamat', true),
                    'id_provinsi' => $this->input->post('provinsi', true),
                    'id_kabupaten' => $this->input->post('kabupaten', true),
                    'kodepos' => $this->input->post('kodepos', true),
                    'agama' => $this->input->post('agama', true),
                    'telepon' => $this->input->post('telepon', true),
                    'status' => 'Pending',
                    'nama_marketing'=>$this->input->post('nama_marketing',true),
                    'token'=>$token
                );

                $this->M_donatur->insert($data);
                //$this->input->post('periode', true);
                if ($this->input->post('periode', true) == 'bulan') {
                    $periode = 1;
                } elseif ($this->input->post('periode', true) == 'tahun') {
                    $periode = 12;
                } elseif (($this->input->post('periode', true) == 'semester')) {
                    $periode = 6;
                }

                foreach ($this->input->post('jenis_donasi') as $key => $value):
                    $id_donasi_donatur = date('YmdHis') . time() . $value;
                    //donasi_donatur
                    $donasi = array(
                        'id' => $id_donasi_donatur,
                        'id_donatur' => $id_donatur,
                        'id_jenis_donasi' => $value,
                        'status' => 'Terdaftar',
                        'periode' => $this->input->post('periode', true),
                        'mekanisme_donasi' => $this->input->post('mekanisme', true),
                    );
                    //jenis donasi

                    switch ($value) {
                        case 1:
                            //perulangan OTA
                            $total_anak_asuh = $this->input->post('total_asuh_anak', true);
                            $total_bayar_ota = 0;
                            $total_anak_ota = 0;
                            foreach ($this->input->post('anakasuh', true) as $key => $value):
                                //ambil nominal anak asuh
                                $nominal = $this->M_jenisanakasuh->getRow($value)->nominal;
                                $totalnominal = $periode * $nominal * $total_anak_asuh[$key];
                                $total_bayar_ota += $totalnominal;
                                $total_anak_ota += $total_anak_asuh[$key];
                                $anakasuh = array(
                                    'id_donasi_donatur' => $id_donasi_donatur,
                                    'id_jenis_anak_asuh' => $value,
                                    'total_anak_asuh' => $total_anak_asuh[$key],
                                    'nominal' => $totalnominal
                                );
                                //masukkan ke tabel donatur_jenis_anak_asuh
                                $this->db->insert('donatur_jenis_anak_asuh', $anakasuh);
                            endforeach;
                            $donasi['keterangan_1'] = $total_anak_ota;
//                        $donasi['keterangan_2'] = $total_anak_ota;
                            $donasi['nominal'] = $total_bayar_ota;
                            break;
                        case 2:
                            if ($this->input->post('reguler_nominal', true) == 0) {
                                if ($this->input->post('periode', true) == 'bulan') {
                                    $donasi['nominal'] = $this->input->post('reguler_nominal_lainnya', true);
                                } elseif ($this->input->post('periode', true) == 'tahun') {
                                    $donasi['nominal'] = $this->input->post('reguler_nominal_lainnya', true) * 12;
                                } elseif (($this->input->post('periode', true) == 'semester')) {
                                    $donasi['nominal'] = $this->input->post('reguler_nominal_lainnya', true) * 6;
                                }
                            } else {
                                if ($this->input->post('periode', true) == 'bulan') {
                                    $donasi['nominal'] = $this->input->post('reguler_nominal', true);
                                } elseif ($this->input->post('periode', true) == 'tahun') {
                                    $donasi['nominal'] = $this->input->post('reguler_nominal', true) * 12;
                                } elseif (($this->input->post('periode', true) == 'semester')) {
                                    $donasi['nominal'] = $this->input->post('reguler_nominal', true) * 6;
                                }
                            }
                            break;
                        case 3:
                            $donasi['nominal'] = 0;
                            break;
                    }
                $this->db->insert('donasi_donatur', $donasi);
                endforeach;

                // kirim email setelah register
                $this->sendEmailRegister($this->input->post('email', true), $token);
                $status = array('status'=>true,'msg'=>time());
            }
            echo json_encode($status);
        }
    }

    private function genID($id)
    {
        $this->db->where('tgl_daftar between "'.date('Y-m-01 00:00:00').'" and "'.date('Y-m-t 23:59:59').'"');
        $nomor_urut = $this->M_donatur->getAll()->num_rows()+1;

        //nomor_urut
        if ($nomor_urut < 10) {
            $urut = '00'.$nomor_urut;
        } elseif ($nomor_urut < 100) {
            $urut = '0'.$nomor_urut;
        } else {
            $urut = $nomor_urut;
        }

        $kode = date('ym').$urut;
        return $kode;
    }

    public function sukses_register($id)
    {
        $this->load->view('front/v_sukses_registrasi');
    }

    public function sukses_recovery($id)
    {
        $this->load->view('front/v_sukses_recovery');
    }

    public function logout()
    {
        if (!$this->session->userdata('login_donatur')) {
            redirect(base_url());
        }

        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function forgot()
    {
        if ($this->input->post()) {
            $this->load->model('M_logindonatur');
            $email = $this->input->post('email', true);
            if ($this->M_logindonatur->forgot_password($email)) {
                $sendEmail = $this->sendEmail($this->input->post('email'));
                if ($sendEmail['status']) {
                    $data['msg'] = '<strong>Terima kasih, </strong>sistem sudah mengirimkan alamat perubahan kata sandi ke email anda.';
                    $data['class'] = 'success';
                } else {
                    $data['msg'] = '<strong>Ooopss, </strong>terjadi kesalahan saat mengirimkan email, hubungi administrator segera.';
                    $data['class'] = 'warning';
                }
                $this->load->view('front/v_forgot_password', $data);
            } else {
                $data['msg'] = '<strong>Maaf, </strong> Email anda tidak ada di sistem kami.';
                $data['class'] = 'danger';
            }
            $this->load->view('front/v_forgot_password', $data);
        } else {
            $this->load->view('front/v_forgot_password', array());
        }
    }

    private function sendEmail($email)
    {
        //cek expired, jika belum expired maka jangan dikirimkan email lagi
        $current_time = date('Y-m-d H:i:s');
        $this->db->order_by('created_at', 'desc');
        $this->db->where("expired > '$current_time'");
        $tmp = $this->db->get_where('forgot_password_donatur', array('email'=>$email,'status'=>'0'))->row();

        if ($tmp) {
            return array('status'=>true);
        } else {
            //input data ke tabel lupa password, generate token dan key
            $token = $this->generateString();
            $key   = $this->generateString();
            $url   = base_url('login/recovery/?token='.$token.'&key='.$key);
            $this->db->insert('forgot_password_donatur', array(
                'email'=>$email,
                'forgot_key'=>$key,
                'forgot_token'=>$token,
                'expired'=>date("Y-m-d H:i:s", strtotime("+120 minutes")),
                'status'=>'0'
            ));

            $this->load->library('SendEmail');
            $mail = new SendEmail();
            $mail->to = $email;
            $mail->subject = "Recovery Password Bakti Pemuda Nusantara";
            $mail->msg = "Klik link berikut untuk mengatur ulang password anda: <a href='".$url."'> Link</a>";
            return $mail->sendMail();
        }
    }

    private function sendEmailRegister($email, $token)
    {
        $this->load->library('SendEmail');
        $mail = new SendEmail();
        $mail->to = $email;
        $mail->subject = "Konfirmasi Pendaftaran";
        $mail->msg = "Terimakasih telah bergabung dengan Bakti Pemuda Nusantara. Silahkan klik link berikut untuk melakukan konfirmasi.<br/>
            <a href='".base_url('konfirmasi/?key='.$token)."'>KONFIRMASI</a>";
        return $mail->sendMail();
    }

    private function generateString($length=241)
    {
        $str = "";
        $char = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($char) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $char[$rand];
        }
        return $str.date('YdmiHs');
    }

    public function recovery()
    {
        $token = $this->input->get('token');
        $key = $this->input->get('key');
        $current_time = date('Y-m-d H:i:s');
        $this->db->order_by('created_at', 'desc');
        $this->db->where("expired > '$current_time'");
        $row = $this->db->get_where('forgot_password_donatur', array('forgot_token'=>$token,'forgot_key'=>$key,'status'=>'0'))->row();
        if ($row) {
            if ($_POST) {
                //cek email apakah ada di forgot password atau tidak
                $row_post = $this->db->get_where('forgot_password_admin', array('status'=>'0','email'=>$this->input->post('email', true)))->row();
                if ($row_post) {
                    $data = array(
                        'password'=>$this->encrypt->hash($this->input->post('password', true))
                    );
                    $this->db->where('email', $this->input->post('email'));
                    $this->db->update('donatur', $data);

                    $status = array('status'=>'1');
                    //update forgot password
                    $this->db->where('email', $this->input->post('email'));
                    $this->db->update('forgot_password_donatur', $status);
                    redirect(base_url('login/sukses_recovery/'.$token));
                } else {
                    $this->load->view('front/v_recovery', array(
                        'err2'=>'Maaf, email yang anda masukkan salah.'
                    ));
                }
            } else {
                $this->load->view('front/v_recovery', array(

                ));
            }
        } else {
            $this->load->view('front/v_recovery', array(
                'err'=>'Maaf, Halaman tidak tersedia atau sudah kadaluarsa'
            ));
        }
    }

    public function getCaptcha()
    {
        //        if($_POST) {
            $vals = array(
                'img_path' => './captcha/',
                'img_url' => base_url('captcha'),
                'img_width' => 150,
                'font_path'=>'./assets/fonts/captcha4.ttf',
                'img_height' => 50,
                'expiration' => 7200,
                'word_length' => 5,
                'font_size'=>20
            );

        $cap = create_captcha($vals);
        echo json_encode(array('word' => $cap['word'], 'img' => $cap['image']));
//        }
    }
}
