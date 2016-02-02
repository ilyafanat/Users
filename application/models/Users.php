<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Users extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function getLoginTime($id_user, $limit) {
        return $this->db->select("u.login, u.email, t.logged_at, t.logouted_at, t.ip")
                        ->from("user as u")
                        ->join("time t", "u.id=t.id_user")
                        ->where("u.id", $id_user)
                        ->limit($limit)
                        ->order_by("t.logouted_at", "desc")
                        ->get()
                        ->result_array();
    }

    public function getUserByLogin($login) {
        return $this->db->get_where("user", ["login" => $login])->row(0, "Users");
    }

    public function add($user_data) {
        return $this->db->insert("user", $user_data);
    }

    function setLoginTime($time_data) {
        $this->db->insert("time", $time_data);
        return $this->db->insert_id();
    }

    public function setLogoutTime($time, $id) {
        return $this->db->set("logouted_at", $time)
                        ->where("id", $id)
                        ->update("time");
    }

}
