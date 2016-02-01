<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    private function getUserLoginTime($template) {
        $this->load->model("Users");

        $loginTime = [];

        $sessionLogedIn = $this->session->userdata("logged_in");

        if ($sessionLogedIn) {
            $loginTime = $this->Users->getLoginTime($sessionLogedIn["id"], 5);
            $template = "lastLogin";
        }

        $this->load->view($template, $loginTime);
    }

    private function validateData($validation) {
        
    }

    public function index() {
        $this->getUserLoginTime("loginForm");
    }

    public function signupUser() {
        $this->getUserLoginTime("signupForm");
    }

    public function registrationUser() {
        $this->load->library(["form_validation"]);

        $this->load->helper("email");

        $this->form_validation->set_rules("tabUsername", "Username", "trim|required|min_length[5]|max_length[40] ");
        $this->form_validation->set_rules("tabPassword", "Password", "required|min_length[2]|max_length[60] ");
        $this->form_validation->set_rules("tabEmail", "Email", "trim|required|valid_email|max_length[254]");



        if ($this->form_validation->run()) {
            $this->load->model("Users");

            $user_signin_data = [
                "login" => $this->input->post("tabUsername", true),
                "password" => password_hash($this->input->post("tabPassword"), PASSWORD_BCRYPT),
                "email" => $this->input->post("tabEmail")
            ];

            $message = [
                "text" => "User " . $user_signin_data["login"]
            ];

            if (empty($this->Users->getUserByLogin($user_signin_data["login"]))) {
                $this->Users->add($user_signin_data);
                $template = "loginForm";
                $message["text"].=" succesfully registered";
            } else {
                $template = "signupForm";
                $message["text"].= " already exist";
            }
        } else {
            $this->form_validation->set_error_delimiters("<div class='text-danger'>", "</div>");
            $template = "signupForm";
        }
        $this->load->view($template, $message);
    }

    public function loginUser() {
        $this->load->library(["form_validation"]);

        $this->load->helper("date");

        $this->form_validation->set_rules("username", "Username", "trim|required");
        $this->form_validation->set_rules("password", "Password", "required");

        if ($this->form_validation->run()) {
            $this->load->model("Users");

            $user_login_data = [
                "login" => $this->input->post("username", true),
                "password" => $this->input->post("password")
            ];

            $login_data = $this->Users->getUserByLogin($user_login_data["login"]);

            if (!empty($login_data)) {
                if (password_verify($user_login_data["password"], $login_data["password"])) {
                    $time_data = [
                        "ip" => ip2long($this->input->server("REMOTE_ADDR")),
                        "login_time" => date("Y-m-d H:i:s"),
                        "id_user" => $login_data[0]["id"]
                    ];
                    $id_time = $this->Users->setLoginTime($time_data);
                    $limit = 5;
                    $last_user_login_time = $this->Users->getLoginTime($login_data[0]["id"], $limit);
                    $logged_in = [
                        'id_time' => $id_time,
                        'login' => $login_data[0]['login'],
                        'email' => $login_data[0]['login'],
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
        } else {
            $this->form_validation->set_error_delimiters("<div class = 'text-danger'>", "</div>");
            $this->load->view("loginForm");
        }
    }

    public function logoutUser() {
        $this->load->model("Users");
        $this->Users->setLogoutTime(date("Y-m-d H:i:s"), $this->session->userdata('logged_in')["id_time"]);
        $this->session->sess_destroy();
        redirect('login', 'index');
    }

}
