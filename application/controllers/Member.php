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
        $this->load->model("DataKendaraanModel");

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
    public function pengajuanServis()
    {
        $data = [
            "user" => $this->user,
        ];
        $this->load->view('pengajuanServis', $data);
    }

    public function jadwalServis()
    {
        $data = [
            "user" => $this->user,
            "letter" => $this->PostModel->getAllByUser($this->user->id)
        ];

        $this->load->view('jadwalServis', $data);
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
    public function create_pengajuan()
    {
        $id = $this->input->post("id");
        $no_polisi = $this->input->post("no_polisi");
        $jenis_kendaraan = $this->input->post("jenis_kendaran");
        $tipe = $this->input->post("tipe");
        $no_rangka = $this->input->post("no_rangka");
        $operator = $this->input->post("operator");
        $keterangan = $this->input->post("keterangan");
        $status_pengajuan = $this->input->post("status_pengajuan");
        $created_at = date("Y-m-d H:i:s");

        $data = [
            "id" => $id,
            "user_id" => $this->user->id,
            "no_polisi" => $no_polisi,
            "jenis_kendaraan" => $jenis_kendaraan,
            "tipe" => $tipe,
            "no_rangka" => $no_rangka,
            "operator" => $operator,
            "keterangan" => $keterangan,
            "status_pengajuan" => $status_pengajuan,
            "created_at" => $created_at
        ];

        // LOGIC INSERT DATA
        if ($this->PostModel->create($data) != 1) {
            redirect(base_url("pengajuanServis"));
        }
        redirect(base_url("pengajuanServis"));
    }



    public function deletePengajuan($id)
    {
        $data = $this->PostModel->getDataById($id)->row();
        $delete = $this->PostModel->delete($id);
        if ($delete) {
            redirect(base_url("Member/jadwalServis"));
        } else {
            redirect(base_url("Member/jadwalServis"));
        }
    }

    public function editPengajuan()
    {
        $id = $this->input->post('id');

        $data = $this->PostModel->getDataById($id)->row();
        $data = array(
            "id" => $this->input->post('id'),
            "no_polisi" => $this->input->post('no_polisi'),
            "jenis_kendaraan" => $this->input->post('jenis_kendaraan'),
            "tipe" => $this->input->post('tipe'),
            "no_rangka" => $this->input->post('no_rangka'),
            "operator" => $this->input->post('operator'),
            "keterangan" => $this->input->post('keterangan'),
            "status_pengajuan" => $this->input->post('status_pengajuan'),

        );

        $update = $this->PostModel->updatePengajuan($id, $data);

        if ($update) {
            redirect(base_url("Member/jadwalServis"));
        } else {
            redirect(base_url("Member/jadwalServis"));
        }
    }
    //autocomplete
    // function get_autocomplete()
    // {
    //     if (isset($_GET['term'])) {
    //         $result = $this->DataKendaraanModel->search_nopol($_GET['term']);
    //         if (count($result) > 0) {
    //             foreach ($result as $row)
    //             $arr_result[] = $array(
    //                 'label'=>$row->no_polisi,
    //             )
    //                 // $arr_result[] = $array(
    //                 //     'label'=>$row->no_polisi,
    //                 //     'jenis_kendaraan' =>$row->jenis_kendaraan,
    //                 //     'tipe' =>$row->tipe,
    //                 //     'no_rangka' =>$row->no_rangka,
    //                 //     'operator' =>$row->operator

    //                 // )
    //             echo json_encode($arr_result);
    //         }
    //     }
    // }
    function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->DataKendaraanModel->search_nopol($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'         => $row->no_polisi,
                        'jenis_kendaraan'   => $row->jenis_kendaraan,
                        'tipe' => $row->tipe,
                        'no_rangka' => $row->no_rangka,
                        'operator' => $row->operator
                    );
                echo json_encode($arr_result);
            }
        }
    }
}
