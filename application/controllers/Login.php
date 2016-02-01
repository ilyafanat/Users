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
            $loginTime["last_login_data"] = $this->Users->getLoginTime($sessionLogedIn["id"], 5);
            $template = "lastLogin";
        }
        $this->templateView($template, $loginTime);
    }

    private function templateView($view, $sended_data) {
        $template = [
            "sended_data" => $sended_data,
            "view" => $view
        ];
        $this->load->view("template", $template);
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

        $message = [];

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
        $this->templateView($template, $message);
    }

    public function loginUser() {
        $this->load->library(["form_validation"]);

        $this->load->helper("date");

        $this->form_validation->set_rules("username", "Username", "trim|required");
        $this->form_validation->set_rules("password", "Password", "required");

        $message = [];
        $template = "loginForm";

        if ($this->form_validation->run()) {
            $this->load->model("Users");

            $user_login_data = [
                "login" => $this->input->post("username", true),
                "password" => $this->input->post("password")
            ];

            $login_data = $this->Users->getUserByLogin($user_login_data["login"]);

            if (!empty($login_data)) {
                if (password_verify($user_login_data["password"], $login_data->password)) {
                    $time_data = [
                        "ip" => ip2long($this->input->server("REMOTE_ADDR")),
                        "logged_at" => date("Y-m-d H:i:s"),
                        "id_user" => $login_data->id
                    ];

                    $id_time = $this->Users->setLoginTime($time_data);

                    $logged_in = [
                        "id_time" => $id_time,
                        "login" => $login_data->login,
                        "email" => $login_data->email,
                        "id" => $login_data->id
                    ];
                    $this->session->set_userdata("logged_in", $logged_in);

                    $message["last_login_data"] = $this->Users->getLoginTime($login_data->id, 5);
                    $template = "lastLogin";
                } else {
                    $message = [
                        "text" => "Wrong password"
                    ];
                }
            } else {
                $message = [
                    "text" => "User doesn't exist"
                ];
            }
        } else {
            $this->form_validation->set_error_delimiters("<div class = 'text-danger'>", "</div>");
        }
        $this->templateView($template, $message);
    }

    public function logoutUser() {
        $this->load->model("Users");
        $this->Users->setLogoutTime(date("Y-m-d H:i:s"), $this->session->userdata("logged_in")["id_time"]);
        $this->session->sess_destroy();
        redirect("login", "index");
    }

}
