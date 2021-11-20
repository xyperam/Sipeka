<?php
defined('BASEPATH') or exit('No direct script access allowed');

// PostModel berisi semua tentang data arsip apa saja yang di simpan di database oleh user
class PostModel extends CI_Model
{
    private $table = "post";


    public function getOne($col, $val)
    {
        return $this->db->get_where($this->table, [$col => $val])->row();
    }

    public function getAll()
    {   // Menampilkan seluruh data di table user dan post dengan syarat user yang sedang login memiliki kecocokan unik id di tampilkan berdasarkan created_at 
        return $this->db->query("SELECT u.*, p.* FROM post p INNER JOIN user u WHERE p.user_id=u.id ORDER BY created_at DESC")->result();
    }

    public function getAllByUser($id)
    {   // Hanya menampilkan data dari table post berdasarkan user yang sedang login saja
        return $this->db->query("SELECT * FROM post WHERE user_id='$id' ORDER BY created_at DESC")->result();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getDataById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('post');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('post');
    }


    public function editPost($id)
    {
        $query = $this->db->get_where('post', ['id' => $id]);
        return $query->row();
    }

    public function updateFile($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('post', $data);
    }
}
