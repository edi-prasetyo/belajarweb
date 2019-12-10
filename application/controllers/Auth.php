<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    //Load Login Page
    public function index()
    {

        if ($this->session->userdata('email')) {
            redirect(base_url('admin/dashboard'), 'refresh');
        }
        //Validasi form login user
        $valid = $this->form_validation;
        //Validasi Email
        $valid->set_rules(
            'email',
            'Email',
            'required|trim',
            array('required'      => '%s harus diisi')
        );
        //Validasi Password
        $valid->set_rules(
            'password',
            'Password',
            'required',
            array('required'      => '%s harus diisi')
        );
        if ($valid->run()) {
            //ambil data dari form inputan login
            $email          = $this->input->post('email');
            $password       = $this->input->post('password');
            //Cek ke database apakan hasil inputan ada di database
            $cek_login   = $this->user_model->login($email, $password);
            //Jika data email dan password ada maka buat SESSION (id, email, name dan role)
            if ($cek_login) {
                $this->session->set_userdata('id', $cek_login->id);
                $this->session->set_userdata('email', $cek_login->email);
                $this->session->set_userdata('name', $cek_login->name);
                $this->session->set_userdata('role', $cek_login->role);
                $this->session->set_flashdata('login', 'Selamat datang! Anda Berhasil Login');
                redirect(base_url('admin/dashboard'), 'refresh');
            } else {
                //Jika data email dan password tidak ada redirect ke halaman login lagi
                //Tampilkan pesan error
                $this->session->set_flashdata('message', 'Login Gagal');
                redirect(base_url('auth'), 'refresh');
            }
        }
        $data = array('title' => 'Login Administrator');
        $this->load->view('backend/auth/login', $data, FALSE);
    }
    //Fungsi Logout
    public function logout()
    {
        $this->cek_login->logout();
    }
}
