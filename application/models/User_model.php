<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //Ambil semua data user
    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Detail data user berdasarkan id
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Login user
    public function login($email, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where(array(
            'email'      => $email,
            'password'   => sha1($password),
            'status'     => 1
        ));
        $query = $this->db->get();
        return $query->row();
    }
    //Menambahkan data
    public function create($data)
    {
        $this->db->insert('user', $data);
    }
    //Mengubah data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user', $data);
    }
    //Menghapus Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('user', $data);
    }
}
