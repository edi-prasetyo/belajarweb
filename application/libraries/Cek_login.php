<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek_login
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function cek()
    {
        //Fungsi ini akan di gunakan untuk melindungi halaman admin sebelum user melakukan login
        if (
            //Cek jika data sesion email dan role tidak ada
            $this->CI->session->userdata('email') == "" && $this->CI->session->userdata('role') == ""
        ) {
            //Maka tampilkan notif harus login jika ingin mengakses halaman admin
            $this->CI->session->set_flashdata('message', 'Silahkan Login terlebih dahulu');
            //arahkan user ke halaman login
            redirect(base_url('auth'), 'refresh');
        }
    }

    public function logout()
    {
        $this->CI->session->unset_userdata('id');
        $this->CI->session->unset_userdata('email');
        $this->CI->session->unset_userdata('name');
        $this->CI->session->unset_userdata('role');
        //Jika user melakukan logout maka semua data session akan di hapus
        //tampilkan notif bahwa user telah logout dan tidak dapat mengakses halaman admin
        $this->CI->session->set_flashdata('logout', 'Anda Telah keluar dari administrator');
        //arahkan user ke halaman login
        redirect(base_url('auth'), 'refresh');
    }
}
