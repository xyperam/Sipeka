<?php
defined('BASEPATH') or exit('No direct script access allowed');

// PostModel berisi semua tentang data arsip apa saja yang di simpan di database oleh user
class DataKendaraanModel extends CI_Model
{
    private $table = "data_kendaraan";


    public function getOne($col, $val)
    {
        return $this->db->get_where($this->table, [$col => $val])->row();
    }

    public function getAll()
    {   // Menampilkan seluruh data di table user dan post dengan syarat user yang sedang login memiliki kecocokan unik id di tampilkan berdasarkan created_at 
        return $this->db->query("SELECT * FROM data_kendaraan  ")->result();
    }

    public function getAllByUser($id)
    {   // Hanya menampilkan data dari table post berdasarkan user yang sedang login saja
        return $this->db->query("SELECT * FROM data_kendaraan WHERE id='$id' ")->result();
    }

    public function CreateKendaraan($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getDataById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('data_kendaraan');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('data_kendaraan');
    }



    public function updateKendaraan($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data, array('id' => $id));
    }

    public function delete_kendaraan($id)     // DELETE ACCOUNT USER (delete)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }

    function get_no_polisi($postData)
    {

        $response = array();

        if (isset($postData['search'])) {
            // Select record
            $this->db->select('*');
            $this->db->where("no_polisi like '%" . $postData['search'] . "%' ");

            $records = $this->db->get('data_kendaraan')->result();

            foreach ($records as $row) {
                $response[] = array("value" => $row->id, "label" => $row->username);
            }
        }

        return $response;
    }
}
