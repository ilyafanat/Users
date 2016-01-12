<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->view('login');
    }

    public function signup() {
        $this->load->view('signupForm');
    }

    public function signupUser() {

        $arr = array(
            'login' => $this->db->escape($this->input->post('tabUsername', TRUE)),
            'password' => $this->encrypt->encode($this->db->escape($this->input->post('tabPassword'))),
            'email' => $this->db->escape($this->input->post('tabEmail'))
        );
        $this->form_validation->set_rules('tabUsername', 'Логин', 'trim|required|min_length[5]|max_length[12] ');
        $this->form_validation->set_rules('tabPassword', 'Пароль', 'required|min_length[2]|max_length[12] ');
        $this->form_validation->set_rules('tabEmail', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->load->view('signupForm');
        } else {
            $this->load->model('Users');
            if ($this->Users->user_verify($arr['login'])) {
                $this->Users->insert($arr);
                $this->session->set_flashdata('status', 'Пользователь ' . $arr['login'] . ' успешно зарегистрирован');
                $this->load->view('login');
            } else {
                $this->session->set_flashdata('status', 'Пользователь таким логином ' . $arr['login'] . ' уже зарегистрирован в системе');
                $this->load->view('signupForm');
            }
        }
    }

    public function signin() {
        $arr = array(
            'login' => $this->db->escape($this->input->post('username', TRUE)),
            'password' => $this->db->escape($this->input->post('password'))
        );
        $this->form_validation->set_rules('username', 'Логин', 'trim|required');
        $this->form_validation->set_rules('password', 'Пароль', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $this->load->view('login');
        } else {
            $this->load->model('Users');
            if ($this->Users->user_login($arr['login'], $arr['password'])) {
                $data['logins'] = $this->Users->getData();
                $this->session->set_userdata('username', $arr['login']);
                $this->load->view('header');
                $this->load->view('lastLogin', $data);
            } else {
                $this->session->set_flashdata('error', 'Пользователя ' . $arr['login'] . ' не зарегистрировано в системе');
                $this->load->view('login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->view('login');
    }

}
