<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Недавняя активность </title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css"/>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
    </head>
    <body>
        <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.min.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="pull-right">
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Welcome, <?php echo $this->session->userdata('username'); ?>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('login/logout'); ?>"><i class="icon-off"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>