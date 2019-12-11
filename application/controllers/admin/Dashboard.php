<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('category_model');
        $this->load->model('user_model');
    }

    //listing data user
    public function index()
    {
        $article    = $this->article_model->get_all();
        $category   = $this->category_model->get_all();
        $user       = $this->user_model->get_all();
        $data = array(
            'title'     => 'Welcome To Admin',
            'article'   => $article,
            'category'  => $category,
            'user'      => $user,
            'content'   => 'backend/dashboard/dashboard'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }
}
