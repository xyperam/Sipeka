<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->home = base_url();
        $this->load->helper(array('form', 'url'));
        $this->load->model("UserModel");
        $this->load->model("PostModel");

        if ($this->session->userdata("login") == null) {
            redirect(base_url('login'));
        }
        $this->user = $this->UserModel->getOne("id", $this->session->userdata("login"));
    }

    // Page Home
    public function index()
    {
        $data = [
            "user" => $this->user,
            "letter" => $this->PostModel->getAll()
        ];
        $this->load->view('home', $data);
    }

    // Page Massage
    public function massage()
    {
        $data = [
            "user" => $this->user,
        ];
        $this->load->view('massage', $data);
    }

    public function lihatSurat()
    {
        $data = [
            "user" => $this->user,
            "letter" => $this->PostModel->getAllByUser($this->user->id)
        ];

        $this->load->view('lihatSurat', $data);
    }

    public function semuaSurat()
    {
        $data = [
            "user" => $this->user,
            "letter" => $this->PostModel->getAll()
        ];

        $this->load->view('semuaSurat', $data);
    }


    public function updateProfile()
    {
        // Buat kerangka sesuai field di table database
        $id = $this->input->post("id");
        $username = $this->input->post("username");
        $email = $this->input->post("email");
        $avatar = $this->input->post("old_avatar");
        if (!empty($_FILES["new_avatar"]["name"])) {
            $avatar = $this->_upload_avatar();
        }

        // tentukan data mana saja yang ingin atau bisa di ubah (Susai Form di HTML)
        $data = [
            "username" => $username,
            "email" => $email,
            "avatar" => $avatar
        ];

        if ($this->UserModel->update($data, $id) == 1) {
            redirect(base_url("home"));
        } else {
            redirect(base_url("home"));
        }
    }

    //mengupload foto profil
    private function _upload_avatar()
    {
        $config['upload_path']          = './avatar/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 1000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('new_avatar')) {
            redirect(base_url("home"));
        } else {
            if ($this->user->avatar != null && file_exists("./avatar/" . $this->user->avatar)) {
                unlink("./avatar/" . $this->user->avatar);
            }
            return $this->upload->data("file_name");
        }
    }


    // INSERT
    public function create_letter()
    {
        $id = $this->input->post("id");
        $tgl_surat = $this->input->post("tgl_surat");
        $no_surat = $this->input->post("no_surat");
        $alamat = $this->input->post("alamat");
        $kelurahan = $this->input->post("kelurahan");
        // $keterangan = $this->input->post("keterangan");
        $image = $this->upload_foto();
        // $status = $this->input->post("status");
        $created_at = date("Y-m-d H:i:s");

        $data = [
            "id" => $id,
            "user_id" => $this->user->id,
            "tgl_surat" => $tgl_surat,
            "no_surat" => $no_surat,
            "alamat" => $alamat,
            "kelurahan" => $kelurahan,
            "image" => $image,
            "created_at" => $created_at
        ];

        // LOGIC INSERT DATA
        if ($this->PostModel->create($data) != 1) {
            redirect(base_url("massage"));
        }
        redirect(base_url("massage"));
    }

    //upload image postingan
    public function upload_foto()
    {
        $config['upload_path']          = './image/';
        $config['allowed_types']        = 'png|jpg|jpeg';
        $config['overwrite']            = true;
        $config['max_size']             = 102400;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            redirect(base_url("massage"));
        } else {
            return $this->upload->data("file_name");
        }
    }
    // INSERT END

    public function deletePost($id)
    {
        $data = $this->PostModel->getDataById($id)->row();
        $image = './image/' . $data->image;

        if (is_readable($image) && unlink($image)) {
            $delete = $this->PostModel->delete($id);
            redirect(base_url("lihatSurat"));
        } else {
            redirect(base_url("lihatSurat"));
        }
    }

    public function editSurat()
    {
        $id = $this->input->post('id');

        $data = $this->PostModel->getDataById($id)->row();
        $image = './image/' . $data->image;

        if (is_readable($image) && unlink($image)) {

            $config['upload_path']          = './image/';
            $config['allowed_types']        = 'png|jpg|jpeg';
            $config['overwrite']            = true;
            $config['max_size']             = 102400;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                redirect(base_url("Admin/lihatSurat"));
            } else {
                // return $this->upload->data("file_name");

                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];

                $data = array(
                    "id" => $this->input->post('id'),
                    "no_surat" => $this->input->post('no_surat'),
                    "alamat" => $this->input->post('alamat'),
                    "kelurahan" => $this->input->post('kelurahan'),
                    "keterangan" => $this->input->post('keterangan'),
                    "image" => $image,
                    "status" => $this->input->post('status'),
                );

                $update = $this->PostModel->updateFile($id, $data);

                if ($update) {
                    redirect(base_url("Member/lihatSurat"));
                } else {
                    redirect(base_url("Member/lihatSurat"));
                }
            }
        }
    }
}
