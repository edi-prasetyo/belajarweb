<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //list semua data category
    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    //Detail data category per id
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //tambah / Insert Data
    public function create($data)
    {
        $this->db->insert('category', $data);
    }
    //Update data category
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('category', $data);
    }
    //Delete Data category
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('category', $data);
    }
    //View In frontend
    //Read kategori
    public function view_category($category_slug)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_slug', $category_slug);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
}
