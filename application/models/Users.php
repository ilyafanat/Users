<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Users extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getLoginTime($id_user, $limit) {
        return $this->db->select("t.login_time, t.logout_time, t.ip")
                        ->from("user as u")
                        ->join("time t", "u.id=t.id_user")
                        ->where("u.id", $id_user)
                        ->limit($limit)
                        ->order_by("t.login_time", "desc")
                        ->get()
                        ->result_array();
    }

    public function getUserByLogin($login) {
        return $this->db->get_where("user", ["login" => $login])->row();
    }

    public function add($data) {
        return $this->db->insert("user", $data);
    }

    function setLoginTime($time_data) {
        $this->db->insert("time", $time_data);
        return $this->db->insert_id();
    }

    public function checkUserExist($login) {
        return $this->db->where("login", $login)->get("user")->result();
    }

    public function setLogoutTime($time, $id) {
        return $this->db->set("logout_time", $time)
                        ->where("id", $id)
                        ->update("time");
    }

}
