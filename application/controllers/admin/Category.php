<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

    public function index()
    {
        $category = $this->category_model->get_all();
        //Validasi Form
        $this->form_validation->set_rules(
            'category_name',
            'Nama Category',
            'required|is_unique[category.category_name]',
            array(
                'required'         => '%s Harus Di isi',
                'is_unique'         => '%s Sudah ada, buat Nama kategori lain'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'             => 'Data Category',
                'category'          => $category,
                'content'           => 'backend/category/get_category'
            );
            $this->load->view('backend/layout/wrapp', $data, FALSE);
        } else {
            //Jika Berhasil data akan masuk ke database
            $category_slug  = url_title($this->input->post('category_name'), 'dash', TRUE);
            $data  = array(
                'category_slug'   => $category_slug,
                'category_name'   => $this->input->post('category_name')
            );
            $this->category_model->create($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambahkan');
            redirect(base_url('admin/category'), 'refresh');
        }
    }
    public function update($id)
    {
        //Ambil id category
        $category = $this->category_model->detail($id);
        //Validasi Form
        $this->form_validation->set_rules(
            'category_name',
            'Nama Category',
            'required|is_unique[category.category_name]',
            array(
                'required'         => '%s Harus Di isi',
                'is_unique'         => '%s Sudah ada, buat Nama kategori lain'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'             => 'Update Category',
                'category'          => $category,
                'content'           => 'backend/category/update'
            );
            $this->load->view('backend/layout/wrapp', $data, FALSE);
        } else {
            //Jika Berhasil data akan masuk ke database
            $data  = array(
                'id'              => $id,
                'category_name'   => $this->input->post('category_name')
            );
            $this->category_model->update($data);
            $this->session->set_flashdata('sukses', 'Data telah di ubah');
            redirect(base_url('admin/category'), 'refresh');
        }
    }
    //Hapus data category
    public function delete($id)
    {
        $this->cek_login->cek();
        $category = $this->category_model->detail($id);
        $data = array('id'   => $category->id);

        $this->category_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah di Hapus');
        redirect(base_url('admin/category'), 'refresh');
    }
}
