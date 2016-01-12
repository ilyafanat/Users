<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function getData() {
        $this->db->limit(5);
        $this->db->order_by("last_activity", "desc"); 
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function user_login($login, $password) {
        $this->db->where('login', $login);
        $this->db->where($this->encrypt->decode('password'), $password);
        $query_check_user = $this->db->get('user');
        $userdata = $query_check_user->num_rows();
        if ($userdata > 0) {
            $this->update($login);
            return true;
        } else {
            return false;
        }
    }
    
    public function insert($data){
        $this->db->insert('user', $data);
    }
    
    function update($login){
        $data=array(
            'ip'=> ip2long($_SERVER['REMOTE_ADDR']),
            'last_activity'=>date('Y-m-d H:i:s', now())
        );
        $this->db->where('login',$login);
        if ($this->db->update('user', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function user_verify($login) {
        $this->db->where('login', $login);
        $query_check_user = $this->db->get('user');
        $userdata = $query_check_user->num_rows();
        if ($userdata < 1) {
            return true;
        } else {
            return false;
        }
    }

}
