<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getUserTime() {
       return $this->db->select('*')->from('user')->join('time', 'user.id=time.id_user')->get()->result_array();
//        $this->db->from('user');
//        $this->db->join('time', 'user.id=time.id_user');
//        $this->db->limit($limit)->order_by("last_activity", "desc");
//        $this->db->order_by("last_activity", "desc");
//        $query = $this->db->get('user');
//        return $this->db->get();
    }

    public function checkUserLogin($login) {
        return $this->db->where('login', $login)->get('user')->result_array();
    }

    public function addUser($data) {
        return $this->db->insert('user', $data);
    }

    function setLastLoginTime($time_data) {
        return $this->db->insert('time', $time_data);
    }

    public function checkUserExist($login) {
        return $this->db->where('login', $login)->get('user')->result();
    }

}
