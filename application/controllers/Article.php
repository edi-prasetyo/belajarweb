<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('category_model');
    }

    //Halaman Utama
    public function index()
    {
        $article        = $this->article_model->get_all();
        $all_category   = $this->category_model->get_all();
        $latepost       = $this->article_model->latest();

        // List Semua article Navigasi Halaman
        $this->load->library('pagination');

        $config['base_url']       = base_url('article/index/');
        $config['total_rows']     = count($this->article_model->total());
        $config['per_page']       = 4;
        $config['uri_segment']    = 3;
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        $this->pagination->initialize($config);

        $article                   = $this->article_model->article($limit, $start);

        $data = array(
            'paginasi'          => $this->pagination->create_links(),
            'article'           => $article,
            'all_category'      => $all_category,
            'latepost'          => $latepost,
            'content'           => 'frontend/article/get_all'
        );
        $this->load->view('frontend/layout/wrapp', $data, FALSE);
    }

    // Fungsi untuk Menampilkan Artikel per Category
    public function category($category_slug)
    {
        $category                   = $this->category_model->view_category($category_slug);
        $all_category               = $this->category_model->get_all();
        $category_id                = $category->id;
        $latepost                   = $this->article_model->latest();

        $this->load->library('pagination');

        $config['base_url']         = base_url('article/category/' . $category_slug . '/index/');
        $config['total_rows']       = count($this->article_model->total_category($category_id));
        $config['per_page']         = 4;
        $config['uri_segment']      = 5;
        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        $this->pagination->initialize($config);

        $article                    = $this->article_model->article_category($category_id, $limit, $start);
        $data = array(
            'paginasi'              => $this->pagination->create_links(),
            'article'               => $article,
            'latepost'              => $latepost,
            'all_category'          => $all_category,
            'content'               => 'frontend/article/get_all'
        );
        $this->load->view('frontend/layout/wrapp', $data, FALSE);
    }

    //Fungsi untuk menampilkan Detail Artikel
    public function detail($article_slug = NULL)
    {
        if (!empty($article_slug)) {
            $article_slug;
        } else {
            redirect(base_url('article'));
        }

        $article                = $this->article_model->view_detail($article_slug);
        $all_category           = $this->category_model->get_all();
        $latepost               = $this->article_model->latest();

        $data = array(
            'id'                => $this->session->userdata('id'),
            'title'             => $article->title,
            'deskripsi'         => $article->title,
            'keywords'          => $article->keywords,
            'article'           => $article,
            'all_category'      => $all_category,
            'latepost'          => $latepost,
            'tanggal_post'      => date('Y-m-d H:i:s'),
            'content'           => 'frontend/article/detail'
        );

        $this->load->view('frontend/layout/wrapp', $data, FALSE);
    }
}

/* End of file article.php */
/* Location: ./application/controllers/article.php */
