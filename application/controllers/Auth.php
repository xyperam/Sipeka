<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
    }

    public function registrasi()
    {
        // if ($this->session->userdata("login") == null && $this->session->userdata("admin") != true) {
        //     redirect(base_url('login'));
        // }
        $this->user = $this->UserModel->getOne("id", $this->session->userdata("login"));


        // $data = [
        //     "user" => $this->user,
        // ];

        $this->load->view('registrasi');
    }
    // METHODE REGIS
    public function post_register()
    {
        $username = $this->input->post("username"); // Tangkap value di form
        $name = $this->input->post("name"); // Tangkap value di form
        $email = $this->input->post("email"); // Tangkap value di form
        $password = password_hash($this->input->post("password"), PASSWORD_DEFAULT); // Tangkap value di form
        // CHECK username SUDAH ADA ATAU BELUM di DB dengan memanggil MODEL getOne
        $user = $this->UserModel->getOne("username", $username);
        if ($user != null) {
            echo "
 			<script>
 				alert('Username telah terdaftar, pilih username lain');
 				document.location.href
                  = 'registrasi';
 			</script>";
        } else {    // JIKA TIDAK ADA LAKUKAN INI
            $data = [
                "role" => "member",
                "username" => $username,
                "name" => $name,
                "email" => $email,
                "password" => $password
            ];
            if ($this->UserModel->create($data) == 1) {    // INSERT DATA
                echo "
 				<script>
 					alert('Register berhasil');
 					document.location.href = '../auth/registrasi';
 				</script>";
            } else {
                echo "
 				<script>
 					alert('Register gagal');
 					document.location.href = '../auth/registrasi';
 				</script>";
            }
        }
    }

    // Page Login
    public function login()
    {
        $this->load->view('login');
    }

    // LOGIC LOGIN
    public function post_login()
    {
        // INSERT
        $username = $this->input->post("username"); // Tangkap value di form
        $password = $this->input->post("password"); // Tangkap value di form

        // CHECK username SUDAH ADA ATAU BELUM di DB dengan memanggil MODEL getOne
        $user = $this->UserModel->getOne("username", $username);
        if ($user != null) {
            if (password_verify($password, $user->password)) {    // Verify pass
                $this->session->set_userdata(["login" => $user->id]);    // userdata di set dengan user unik id agar sistem tahu siapa yang sedang login
                if ($user->role == "admin") {
                    $this->session->set_userdata(["admin" => true]);
                    redirect(base_url("admin"));
                } else {
                    redirect(base_url(""));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar</div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('Auth/login'));
    }
}
