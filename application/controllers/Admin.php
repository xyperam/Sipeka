<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->model("PostModel");
        $this->load->model("DataKendaraanModel");
        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->session->userdata("login") == null && $this->session->userdata("admin") != true) {
            redirect(base_url('login'));
        }
        $this->user = $this->UserModel->getOne("id", $this->session->userdata("login"));
    }


    // PAGES
    public function index()
    {
        $data = [
            "user" => $this->user,
            "member" =>  $this->UserModel->getAll()
        ];

        $this->load->view('admin', $data);
    }

    public function suratMasuk()
    {
        $data = [
            "user" => $this->user,
            "letter" => $this->PostModel->getAll()
        ];
        $this->load->view('suratMasuk', $data);
    }
    public function datakendaraan()
    {
        $data = [
            "user" => $this->user,
            "kendaraan" => $this->DataKendaraanModel->getAll()
        ];
        $this->load->view('dataKendaraan', $data);
    }

    public function about()
    {
        $data = [
            "user" => $this->user,
        ];
        $this->load->view('about', $data);
    }


    // PAGES END
    public function semuaSurat()
    {
        $data = [
            "user" => $this->user,
            "letter" => $this->PostModel->getAll()
        ];

        $this->load->view('semuaSurat', $data);
    }


    // CRUD PAGES USER ACCOUNT
    public function delete_user($id)
    {
        if ($this->UserModel->deleteUser($id) != 1) {
            // echo "
            // <script>
            //     alert('Post gagal dihapus');
            //     document.location.href = \"$this->admin\";
            // </script>";
            redirect(base_url("admin"));
        } else {
            // echo "
            // <script>
            //     alert('Post berhasil dihapus');
            //     document.location.href = \"$this->admin\";
            // </script>";
            redirect(base_url("admin"));
        }
    }

    public function editUser()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $avatar = $this->input->post('avatar');

        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
        );

        if ($this->UserModel->update($data, $id) == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
            redirect(base_url("admin"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
            redirect(base_url("admin"));
        }
    }
    // CRUD PAGES USER ACCOUNT END


    // CRUD PAGES SURAT MASUK BPBD

    public function delete_post($id)
    {
        $data = $this->PostModel->getDataById($id)->row();
        $delete = $this->PostModel->delete($id);
        redirect(base_url("Admin/suratMasuk"));
    }

    public function updateSurat()
    {
        $id = $this->input->post('id');

        $data = $this->PostModel->getDataById($id)->row();

        $data = array(
            "id" => $this->input->post('id'),
            "status_pengajuan" => $this->input->post('status_pengajuan'),
            "tgl_servis" => $this->input->post('tgl_servis'),
        );

        $update = $this->PostModel->updatePengajuan($id, $data);

        if ($update) {
            redirect(base_url("Admin/suratMasuk"));
        } else {
            redirect(base_url("Admin/suratMasuk"));
        }
    } //end function






    //Crud Data Kendaraan
    public function addKendaraan()
    {
        $id = $this->input->post("no");
        $no_polisi = $this->input->post("no_polisi");
        $jenis_kendaraan = $this->input->post("jenis_kendaraan");
        $tipe = $this->input->post("tipe");
        $no_rangka = $this->input->post("no_rangka");
        $operator = $this->input->post("operator");
        $status = $this->input->post("status");


        $data = [
            "id" => $id,
            "no_polisi" => $no_polisi,
            "jenis_kendaraan" => $jenis_kendaraan,
            "tipe" => $tipe,
            "no_rangka" => $no_rangka,
            "operator" => $operator,
            "status" => $status,
        ];

        // LOGIC INSERT DATA
        $this->db->insert('data_kendaraan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created</div>');
        redirect('admin/datakendaraan');
    }


    //Edit Kendaraan
    public function editKendaraan()
    {
        $id = $this->input->post("no");
        $no_polisi = $this->input->post("no_polisi");
        $jenis_kendaraan = $this->input->post("jenis_kendaraan");
        $tipe = $this->input->post("tipe");
        $no_rangka = $this->input->post("no_rangka");
        $operator = $this->input->post("operator");
        $status = $this->input->post("status");

        $data = array(
            "id" => $id,
            "no_polisi" => $no_polisi,
            "jenis_kendaraan" => $jenis_kendaraan,
            "tipe" => $tipe,
            "no_rangka" => $no_rangka,
            "operator" => $operator,
            "status" => $status,
        );

        $update = $this->DataKendaraanModel->editKendaraan($id, $data);
        if ($update) {
            redirect(base_url("Admin/datakendaraan"));
        } else {
            redirect(base_url("Admin/datakendaraan"));
        }
    }


    public function updateKendaraan()
    {
        $id = $this->input->post('id');
        $no_polisi = $this->input->post("no_polisi");
        $jenis_kendaraan = $this->input->post("jenis_kendaraan");
        $tipe = $this->input->post("tipe");
        $no_rangka = $this->input->post("no_rangka");
        $operator = $this->input->post("operator");
        $status = $this->input->post("status");

        // $data = $this->DataKendaraanModel->getDataById($id)->row();

        $data = array(
            "id" => $id,
            "no_polisi" => $no_polisi,
            "jenis_kendaraan" => $jenis_kendaraan,
            "tipe" => $tipe,
            "no_rangka" => $no_rangka,
            "operator" => $operator,
            "status" => $status,
        );



        if ($this->DataKendaraanModel->updateKendaraan($data, $id) == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
            redirect(base_url("Admin/datakendaraan"));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
            redirect(base_url("Admin/datakendaraan"));
        }
    }

    //delete data kendaraan
    public function delete_kendaraan($id)
    {
        if ($this->DataKendaraanModel->delete_kendaraan($id) != 1) {

            redirect(base_url("Admin/datakendaraan"));
        } else {
            redirect(base_url("Admin/datakendaraan"));
        }
    }
}
