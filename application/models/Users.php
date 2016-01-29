<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_user_info($limit) {
        $this->db->limit(5);
        $this->db->order_by("last_activity", "desc");
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function checkUserLogin($login) {
        return $this->db->where('login', $login)->get('user')->result_array();
    }

    public function addUser($data) {
        return $this->db->insert('user', $data);
    }

    function setLastLoginTime($login, $ipTimeData) {
        return $this->db->where('login', $login)->update('user', $ipTimeData);
    }

    public function checkUserExist($login) {
        return $this->db->where('login', $login)->get('user')->result();
    }

}
