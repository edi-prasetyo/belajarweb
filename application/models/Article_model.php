<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //Ambil semua data article
    public function get_all()
    {
        $this->db->select('article.*, category.category_name, user.name');
        $this->db->from('article');
        //join dengan tabel category
        $this->db->join('category', 'category.id = article.category_id', 'LEFT');
        $this->db->join('user', 'user.id = article.user_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Detail data article berdasarkan id
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Menambahkan data
    public function create($data)
    {
        $this->db->insert('article', $data);
    }
    //Mengubah data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('article', $data);
    }
    //Menghapus Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('article', $data);
    }

    //list semua artikel yang di tampilkan di frontend
    public function article($limit, $start)
    {
        $this->db->select('article.*,category.category_name, category.category_slug, user.name');
        $this->db->from('article');
        // Join
        $this->db->join('category', 'category.id = article.category_id', 'LEFT');
        $this->db->join('user', 'user.id = article.user_id', 'LEFT');
        //End Join
        $this->db->where(array('article_status'     =>  'Publish'));
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //list Article terbaru untuk sidebar
    public function latest()
    {
        $this->db->select('article.*,category.category_name, category.category_slug, user.name');
        $this->db->from('article');
        // Join
        $this->db->join('category', 'category.id = article.category_id', 'LEFT');
        $this->db->join('user', 'user.id = article.user_id', 'LEFT');
        //End Join
        $this->db->where(array('article_status'     =>  'Publish'));
        $this->db->order_by('id', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        return $query->result();
    }
    public function total()
    {
        $this->db->select('article.*,category.category_name, category.category_slug, user.name');
        $this->db->from('article');
        // Join
        $this->db->join('category', 'category.id = article.category_id', 'LEFT');
        $this->db->join('user', 'user.id = article.user_id', 'LEFT');
        //End Join
        $this->db->where(array('article_status'     =>  'Publish'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //list Category Article
    public function article_category($category_id, $limit, $start)
    {
        $this->db->select('article.*,category.category_name, category.category_slug, user.name');
        $this->db->from('article');
        // Join
        $this->db->join('category', 'category.id = article.category_id', 'LEFT');
        $this->db->join('user', 'user.id = article.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'article_status'           =>  'Publish',
            'article.category_id'      =>  $category_id
        ));
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Kategori Berita
    public function total_category($category_id)
    {
        $this->db->select('article.*,category.category_name, category.category_slug, user.name');
        $this->db->from('article');
        // Join
        $this->db->join('category', 'category.id = article.category_id', 'LEFT');
        $this->db->join('user', 'user.id = article.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'article_status'           =>  'Publish',
            'article.category_id'      =>  $category_id
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Detail berita
    public function view_detail($article_slug)
    {
        $this->db->select('article.*,category.category_name, category.category_slug, user.name, user.avatar');
        $this->db->from('article');
        // Join
        $this->db->join('category', 'category.id = article.category_id', 'LEFT');
        $this->db->join('user', 'user.id = article.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'article_status'           =>  'Publish',
            'article.article_slug'      =>  $article_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }
}
