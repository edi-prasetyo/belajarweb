<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    //load data yang di butuhkan, jika sudah ada di autoload maka tidak perlu diload lagi
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model'); //load data user model agar bisa di panggil oleh setiap fungsi
    }

    //List Semua data user
    public function index()
    {
        //Ambil variable semua data user di database dengan memanggil fungsi database
        $user = $this->user_model->get_all();
        //Tampilkan semua user menggunakan variable $user yang akan di looping
        $data = array(
            'title'     => 'Data User',
            'user'      => $user,
            'content'   => 'backend/user/get_user'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }
    //Create User
    public function create()
    {
        //Fungsi validasi form
        $valid = $this->form_validation;
        //rules nama harus di isi
        $valid->set_rules(
            'name',
            'Nama',
            'required',
            array('required'      => '%s Tidak boleh kosong')
        );
        //rules email harus diisi serta harus unik, sehingga tidak terjadi double email
        $valid->set_rules(
            'email',
            'Email',
            'required|valid_email|trim|is_unique[user.email]',
            array(
                'required'      => '%s Tidak boleh kosong',
                'is_unique'     => '%s <strong>' . $this->input->post('email') .
                    '</strong> sudah digunakan. Silahkan gunakan email yang lain!',
                'valid_email'   => 'Format %s Tidak Valid'
            )
        );
        //Rules Role
        $valid->set_rules(
            'role',
            'Role',
            'required',
            array('required'      => 'Silahkan pilih %s ')
        );
        //Rules status
        $valid->set_rules(
            'status',
            'Status',
            'required',
            array('required'      => 'Silahkan pilih %s ')
        );
        //Rules password harus di isi
        $valid->set_rules(
            'password',
            'Password',
            'required',
            array('required'      => '%s Tidak boleh kosong')
        );
        if ($valid->run()) {
            $config['upload_path']          = './assets/uploads/avatars/';
            //Foto Avatar akan disimpan di folder assets/uploads/avatars
            //Pastikan kamu sudah membuat folder di atas
            $config['allowed_types']        = 'gif|jpg|png|jpeg'; //tipe file yang di dukung
            $config['max_size']             = 5000; //ukuran file dalam Kilobyte
            $config['max_width']            = 5000; //Lebar (pixel)
            $config['max_height']           = 5000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('avatar')) {

                //Jika Validasi Gagal tampilkan error disini
                $data = array(
                    'title'             => 'Tambah User',
                    'error_upload'      => $this->upload->display_errors(),
                    'content'           => 'backend/user/create'
                );
                $this->load->view('backend/layout/wrapp', $data, FALSE);
            } else {
                //Jika validasi berhasil maka
                //Buat variable data upload image
                $upload_data    = array('uploads'  => $this->upload->data());

                // Ambil data dari inputan create user
                $data  = array(
                    'name'           => $this->input->post('name'),
                    'avatar'         => $upload_data['uploads']['file_name'],
                    'email'          => $this->input->post('email'),
                    'password'       => sha1($this->input->post('password')),
                    'role'           => $this->input->post('role'),
                    'status'         => $this->input->post('status'),
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')

                );
                //lalu kirim ke database melalui model di bawah ini
                $this->user_model->create($data);
                //Jika berhasil tampilkan pesan berhasil
                $this->session->set_flashdata('sukses', 'Data telah ditambahkan');
                //Lalu redirect ke halaman list User
                redirect(base_url('admin/user'), 'refresh');
            }
        }
        //Proses pengiriman ke database selesai
        //Menampilkan halaman create user
        $data = array(
            'title'             => 'Tambah User',
            'content'           => 'backend/user/create'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }
    //Fungsi untuk mengubah data profile user
    public function update($id)
    {
        //Ambil id user yang akan di ubah
        $user = $this->user_model->detail($id);
        //Validasi form
        $valid = $this->form_validation;

        $valid->set_rules(
            'name',
            'Nama',
            'required',
            array('required'      => '%s harus diisi')
        );

        $valid->set_rules(
            'email',
            'Email',
            'required|valid_email',
            array(
                'required'      => '%s harus diisi',
                'valid_email'   => 'Format %s Tidak Valid'
            )
        );


        if ($valid->run()) {

            //Jika Foto Avatar tidak di ganti
            if (!empty($_FILES['avatar']['name'])) {

                $config['upload_path']          = './assets/uploads/avatars/';
                //Foto Avatar akan disimpan di folder assets/uploads/avatars
                //Pastikan kamu sudah membuat folder di atas
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('avatar')) {

                    //Jika validasi gagal tampilkan data berdasarkan id user yang di pilih
                    $data = array(
                        'title'         => 'Update User: ' . $user->nama,
                        'user'          => $user,
                        'error_upload'  => $this->upload->display_errors(),
                        'content'       => 'backend/user/update'
                    );
                    $this->load->view('backend/layout/wrapp', $data, FALSE);
                } else {

                    //Jika validasi berhasil maka
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Foto Avatar akan disimpan di folder assets/uploads/avatars
                    //Pastikan kamu sudah membuat folder di atas

                    // Hapus Foto Avatar Lama Jika ada foto baru yang di upload
                    if ($user->avatar != "") {
                        unlink('./assets/uploads/avatars/' . $user->avatar);
                    }
                    //Proses penghapusan selesai
                    //lalu ambil data yang dikirim melalui form update user
                    $data  = array(
                        'id'             => $id,
                        'name'           => $this->input->post('name'),
                        'avatar'         => $upload_data['uploads']['file_name'],
                        'email'          => $this->input->post('email'),
                        'role'           => $this->input->post('role'),
                        'status'         => $this->input->post('status'),
                        'updated_at'     => date('Y-m-d H:i:s')
                    );
                    //Proses Update data ke database
                    $this->user_model->update($data);
                    //Jika berhasil tampilkan pesan
                    $this->session->set_flashdata('message', 'Data User <b>' . $user->name . '</b> telah di Update');
                    redirect(base_url('admin/user'), 'refresh');
                }
            } else {
                //Jika Update data user tanpa mengupload Foto Avatar
                $i     = $this->input;
                // Hapus Gambar Lama Jika ada upload foto baru
                if ($user->avatar != "")
                    $data  = array(
                        'id'             => $id,
                        'name'           => $this->input->post('name'),
                        'email'          => $this->input->post('email'),
                        'role'           => $this->input->post('role'),
                        'status'         => $this->input->post('status'),
                        'updated_at'     => date('Y-m-d H:i:s')
                    );
                $this->user_model->update($data);
                $this->session->set_flashdata('message', 'Data User <b> ' . $user->name . ' </b>telah diubah');
                redirect(base_url('admin/user'), 'refresh');
            }
        }
        //Proses Masuk database Selesai
        $data = array(
            'title'         => 'Update User ' . $user->name,
            'user'          => $user,
            'content'       => 'backend/user/update'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }
    //Fungsi hapus data user
    public function delete($id)
    {
        $this->cek_login->cek();
        //dapatkan id user yang akan di hapus
        $user = $this->user_model->detail($id);
        //Hapus foto Avatar
        if ($user->avatar != "") {
            unlink('./assets/uploads/avatars/' . $user->avatar);
        }
        //kirim data user yang akan di hapus berdasarkan id user
        $data = array('id'   => $user->id);
        //menjalankan perintah penghapusan user
        $this->user_model->delete($data);
        //jika berhasil tampilkan pesan bahwa data user telah di hapus
        $this->session->set_flashdata('message', 'Data User <b> ' . $user->name . '</b> telah di Hapus');
        redirect(base_url('admin/user'), 'refresh');
    }
}
