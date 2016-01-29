<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('loginForm');
    }

    public function signup() {
        $this->load->view('signupForm');
    }

    public function registrationUser() {
        $this->load->library(['form_validation', 'encryption']);
        $this->load->helper('email');
        $this->form_validation->set_rules('tabUsername', 'Username', 'trim|required|min_length[5]|max_length[12] ');
        $this->form_validation->set_rules('tabPassword', 'Password', 'required|min_length[2]|max_length[12] ');
        $this->form_validation->set_rules('tabEmail', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->load->view('signupForm');
        } else {
            $this->encryption->initialize(
                    [
                        'cipher' => 'aes-128',
                        'mode' => 'cbc'
                    ]
            );
            $user_signin_data = [
                'login' => $this->db->escape($this->input->post('tabUsername', true)),
                'password' => $this->encryption->encrypt($this->db->escape($this->input->post('tabPassword'))),
                'email' => $this->db->escape($this->input->post('tabEmail'))
            ];
            $this->load->model('Users');
            if (empty($this->Users->checkUserExist($user_signin_data['login']))) {
                if ($this->Users->addUser($user_signin_data)) {
                    $message = [
                        'text' => 'User ' . $user_signin_data['login'] . ' successfully registered'
                    ];
                    $this->load->view('login', $message);
                } else {
                    $message = [
                        'text' => 'User ' . $user_signin_data['login'] . ' already exist'
                    ];
                    $this->load->view('signupForm', $message);
                }
            } else {
                $message = [
                    'text' => 'User ' . $user_signin_data['login'] . ' already exist'
                ];
                $this->load->view('signupForm', $message);
            }
        }
    }

    public function loginUser() {
        $this->load->library(['form_validation', 'encryption']);
        $this->load->helper('date');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_error_delimiters('<div class = "text-danger">', '</div>');
            $this->load->view('login');
        } else {
            $user_login_data = array(
                'login' => $this->db->escape($this->input->post('username', true)),
                'password' => $this->db->escape($this->input->post('password'))
            );
            $this->load->model('Users');
            $login_data = $this->Users->checkUserLogin($user_login_data['login']);
            if (!empty($login_data)) {
                $this->encryption->initialize(
                        [
                            'cipher' => 'aes-128',
                            'mode' => 'cbc'
                        ]
                );
                $temp_password = $this->encryption->decrypt($login_data[0]['password']);
                if ($user_login_data['password'] === $temp_password) {
                    $ipTimeData = array(
                        'ip' => ip2long($this->input->server('REMOTE_ADDR')),
                        'last_activity' => date('Y-m-d H:i:s')
                    );
                    $this->Users->setLastLoginTime($user_login_data['login'], $ipTimeData);
                    $this->load->view('lastLogin');
                } else {
                    $message = [
                        'text' => 'wrong password'
                    ];
                    $this->load->view('loginForm', $message);
                }
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->view('login');
    }

}
