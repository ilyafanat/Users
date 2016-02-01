<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model("Users");
            $limit = 5;
            $last_user_login_time = $this->Users->getUserTime($this->session->userdata('logged_in')["id"], $limit);
            $this->load->view('lastLogin', ['data' => $last_user_login_time]);
        } else {
            $this->load->view("loginForm");
        }
    }

    public function signupUser() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model("Users");
            $limit = 5;
            $last_user_login_time = $this->Users->getUserTime($this->session->userdata('logged_in')["id"], $limit);
            $this->load->view('lastLogin', ['data' => $last_user_login_time]);
        } else {
            $this->load->view("signupForm");
        }
    }

    public function registrationUser() {
        $this->load->library(["form_validation"]);
        $this->load->helper("email");
        $this->form_validation->set_rules("tabUsername", "Username", "trim|required|min_length[5]|max_length[40] ");
        $this->form_validation->set_rules("tabPassword", "Password", "required|min_length[2]|max_length[60] ");
        $this->form_validation->set_rules("tabEmail", "Email", "trim|required|valid_email|max_length[254]");
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_error_delimiters("<div class='text-danger'>", "</div>");
            $this->load->view("signupForm");
        } else {
            $user_signin_data = [
                "login" => $this->db->escape($this->input->post("tabUsername", true)),
                "password" => password_hash($this->db->escape($this->input->post("tabPassword")), PASSWORD_BCRYPT),
                "email" => $this->db->escape($this->input->post("tabEmail"))
            ];
            $this->load->model("Users");
            if (empty($this->Users->checkUserExist($user_signin_data["login"]))) {
                if ($this->Users->addUser($user_signin_data)) {
                    $message = [
                        "text" => "User " . $user_signin_data["login"] . " successfully registered"
                    ];
                    $this->load->view("loginForm", $message);
                } else {
                    $message = [
                        "text" => "User " . $user_signin_data["login"] . " already exist"
                    ];
                    $this->load->view("signupForm", $message);
                }
            } else {
                $message = [
                    "text" => "User " . $user_signin_data["login"] . " already exist"
                ];
                $this->load->view("signupForm", $message);
            }
        }
    }

    public function loginUser() {
        $this->load->library(["form_validation"]);
        $this->load->helper("date");
        $this->form_validation->set_rules("username", "Username", "trim|required");
        $this->form_validation->set_rules("password", "Password", "required");
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_error_delimiters("<div class = 'text-danger'>", "</div>");
            $this->load->view("loginForm");
        } else {
            $user_login_data = [
                "login" => $this->db->escape($this->input->post("username", true)),
                "password" => $this->db->escape($this->input->post("password"))
            ];
            $this->load->model("Users");
            $login_data = $this->Users->checkUserLogin($user_login_data["login"]);
            if (!empty($login_data)) {
                if (password_verify($user_login_data["password"], $login_data[0]["password"])) {
                    $time_data = [
                        "ip" => ip2long($this->input->server("REMOTE_ADDR")),
                        "login_time" => date("Y-m-d H:i:s"),
                        "id_user" => $login_data[0]["id"]
                    ];
                    $id_time = $this->Users->setLoginTime($time_data);
                    $limit = 5;
                    $last_user_login_time = $this->Users->getUserTime($login_data[0]["id"], $limit);
                    $logged_in = [
                        'id_time' => $id_time,
                        'login' => $login_data[0]['login'],
                        'id' => $login_data[0]['id']
                    ];
                    $this->session->set_userdata('logged_in', $logged_in);
                    $this->load->view("lastLogin", ["data" => $last_user_login_time]);
                } else {
                    $message = [
                        "text" => "wrong password"
                    ];
                    $this->load->view("loginForm", $message);
                }
            } else {
                $message = [
                    "text" => "User doesn't exist"
                ];
                $this->load->view("loginForm", $message);
            }
        }
    }

    public function logoutUser() {
        $this->load->model("Users");
        if ($this->Users->setLogoutTime(date("Y-m-d H:i:s"), $this->session->userdata('logged_in')["id_time"])) {
            $this->session->sess_destroy();
            redirect('login', 'index');
        } else {
            
        }
    }

}
