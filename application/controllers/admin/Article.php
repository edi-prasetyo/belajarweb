<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('article_model');
        $this->load->model('category_model');
    }

    //listing data Post Article
    public function index()
    {
        $article = $this->article_model->get_all();
        $data = array(
            'title'     => 'Data Article',
            'article'   => $article,
            'content'   => 'backend/article/get_article'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }
    //Create New Artice
    public function create()
    {
        $category = $this->category_model->get_all();
        $valid = $this->form_validation;
        $valid->set_rules(
            'title',
            'Judul Artikel',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'title',
            'Judul Artikel',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'content',
            'Konten Artikel',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'article_status',
            'Status',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'category_id',
            'Kategori',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        if ($valid->run()) {
            $config['upload_path']          = './assets/uploads/images/';
            //Gambar Artikel akan disimpan di folder assets/uploads/images
            //Pastikan kamu sudah membuat folder di atas
            $config['allowed_types']        = 'gif|jpg|png|jpeg'; //tipe file yang di dukung
            $config['max_size']             = 5000; //ukuran file dalam Kilobyte
            $config['max_width']            = 5000; //Lebar (pixel)
            $config['max_height']           = 5000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {

                //Jika Validasi Gagal tampilkan error disini
                $data = array(
                    'title'             => 'Create New Article',
                    'error_upload'      => $this->upload->display_errors(),
                    'category'          => $category,
                    'content'           => 'backend/article/create'
                );
                $this->load->view('backend/layout/wrapp', $data, FALSE);
            } else {
                //Jika validasi berhasil maka
                //Buat variable data upload image
                $upload_data    = array('uploads'  => $this->upload->data());

                // Ambil data dari inputan create article
                $article_slug  = url_title($this->input->post('title'), 'dash', TRUE);
                $slug_unik = random_string('numeric', 5);
                $data  = array(
                    'user_id'        => $this->session->userdata('id'),
                    'category_id'    => $this->input->post('category_id'),
                    'title'          => $this->input->post('title'),
                    'article_slug'   => $article_slug . '-' . $slug_unik,
                    'content'        => $this->input->post('content'),
                    'image'          => $upload_data['uploads']['file_name'],
                    'article_status'         => $this->input->post('article_status'),
                    'keywords'       => $this->input->post('keywords'),
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')

                );
                //lalu kirim ke database melalui model di bawah ini
                $this->article_model->create($data);
                //Jika berhasil tampilkan pesan berhasil
                $this->session->set_flashdata('sukses', 'Artikel telah ditambahkan');
                //Lalu redirect ke halaman list article
                redirect(base_url('admin/article'), 'refresh');
            }
        }
        //Proses pengiriman ke database selesai
        //Menampilkan halaman create article
        $data = array(
            'title'             => 'Create New Article',
            'category'          => $category,
            'content'           => 'backend/article/create'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }

    //Fungsi untuk mengubah data article
    public function update($id)
    {
        //Ambil id article yang akan di ubah
        $article = $this->article_model->detail($id);
        $category = $this->category_model->get_all();
        //Validasi form
        $valid = $this->form_validation;
        $valid->set_rules(
            'title',
            'Judul Artikel',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'title',
            'Judul Artikel',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'content',
            'Konten Artikel',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'article_status',
            'Status',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );
        $valid->set_rules(
            'category_id',
            'Kategori',
            'required',
            array(
                'required'         => '%s Harus Di isi',
            )
        );


        if ($valid->run()) {

            //Jika Gambar tidak di ganti
            if (!empty($_FILES['image']['name'])) {

                $config['upload_path']          = './assets/uploads/images/';
                //Gambar akan disimpan di folder assets/uploads/images
                //Pastikan kamu sudah membuat folder di atas
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {

                    //Jika validasi gagal tampilkan data berdasarkan id article yang di pilih
                    $data = array(
                        'title'         => 'Update Article: ' . $article->title,
                        'article'       => $article,
                        'category'      => $category,
                        'error_upload'  => $this->upload->display_errors(),
                        'content'       => 'backend/article/update'
                    );
                    $this->load->view('backend/layout/wrapp', $data, FALSE);
                } else {

                    //Jika validasi berhasil maka
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar akan disimpan di folder assets/uploads/images
                    //Pastikan kamu sudah membuat folder di atas

                    // Hapus Gambar Lama Jika ada gambar baru yang di upload
                    if ($article->image != "") {
                        unlink('./assets/uploads/images/' . $article->image);
                    }
                    //Proses penghapusan selesai
                    //lalu ambil data yang dikirim melalui form update Article
                    $data  = array(
                        'id'             => $id,
                        'user_id'        => $this->session->userdata('id'),
                        'category_id'    => $this->input->post('category_id'),
                        'title'          => $this->input->post('title'),
                        'content'        => $this->input->post('content'),
                        'image'          => $upload_data['uploads']['file_name'],
                        'article_status'         => $this->input->post('article_status'),
                        'keywords'       => $this->input->post('keywords'),
                        'updated_at'     => date('Y-m-d H:i:s')
                    );
                    //Proses Update data ke database
                    $this->article_model->update($data);
                    //Jika berhasil tampilkan pesan
                    $this->session->set_flashdata('message', 'article <b>' . $article->title . '</b> telah di Update');
                    redirect(base_url('admin/article'), 'refresh');
                }
            } else {
                //Jika Update data Article tanpa mengupload Gambar
                $i     = $this->input;
                // Hapus Gambar Lama Jika ada upload foto baru
                if ($article->image != "")
                    $data  = array(
                        'id'             => $id,
                        'user_id'        => $this->session->userdata('id'),
                        'category_id'    => $this->input->post('category_id'),
                        'title'          => $this->input->post('title'),
                        'content'        => $this->input->post('content'),
                        'article_status' => $this->input->post('article_status'),
                        'keywords'       => $this->input->post('keywords'),
                        'updated_at'     => date('Y-m-d H:i:s')
                    );
                $this->article_model->update($data);
                $this->session->set_flashdata('message', 'Article <b> ' . $article->title . ' </b>telah diubah');
                redirect(base_url('admin/article'), 'refresh');
            }
        }
        //Proses Masuk database Selesai
        $data = array(
            'title'         => 'Update Article ' . $article->title,
            'article'       => $article,
            'category'      => $category,
            'content'       => 'backend/article/update'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }
    //Fungsi delete article
    public function delete($id)
    {
        //Cek user apakah sudah login
        $this->cek_login->cek();
        $article = $this->article_model->detail($id);
        //Menghapus gambar
        if ($article->image != "") {
            unlink('./assets/uploads/images/' . $article->image);
        }
        //Penghapusan gambar selesai
        $data = array(
            'id'   => $article->id
        );
        $this->article_model->delete($data);
        $this->session->set_flashdata('message', 'Article <b>' . $article->title . '</b> telah di Hapus');
        redirect(base_url('admin/article'), 'refresh');
    }
}
