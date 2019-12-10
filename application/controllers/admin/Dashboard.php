<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
    }

    //listing data user
    public function index()
    {
        $data = array(
            'title'     => 'Welcome To Admin',
            'content'   => 'backend/dashboard/dashboard'
        );
        $this->load->view('backend/layout/wrapp', $data, FALSE);
    }
}
