<?php

if ($view === "lastLogin") {
    $title["title"] = "Last login time";
} else if ($view === "signupForm") {
    $title["title"] = "Signup User";
} else {
    $title["title"] = "Login User";
}
$this->load->view("header", $title);
$this->load->view($view, $sended_data);
$this->load->view("footer");

