<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Users extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getUserTime($id_user, $limit) {
        return $this->db->select("*")->from("user")
                        ->join("time", "user.id=time.id_user")
                        ->where("user.id", $id_user)
                        ->limit($limit)
                        ->order_by("login_time", "desc")
                        ->get()->result_array();
    }

    public function checkUserLogin($login) {
        return $this->db->where("login", $login)->get("user")->result_array();
    }

    public function addUser($data) {
        return $this->db->insert("user", $data);
    }

    function setLoginTime($time_data) {
        $this->db->insert("time", $time_data);
        return $this->db->insert_id();
    }

    public function checkUserExist($login) {
        return $this->db->where("login", $login)->get("user")->result();
    }

    function setLogoutTime($time, $id) {
        return $this->db->set("logout_time", $time)
                        ->where("id", $id)
                        ->update("time");
    }

}
