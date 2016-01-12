<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
    </head>
    <body>
        <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.min.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>

        <div class="" id="loginModal">
            <div class="modal-header">
                <div style="color: green">
                    <?= $this->session->flashdata('status'); ?>
                    <?php $this->session->unset_userdata('status'); ?>
                </div>
                <div style="color: red">
                    <?= $this->session->flashdata('error'); ?>
                    <?php $this->session->unset_userdata('error'); ?>
                </div>
            </div>
            <div class="modal-body">
                <div class="well">
                    <?= form_open('login/signin', array('class' => 'form-horizontal', 'method' => "POST")); ?>
                    <fieldset>
                        <div id="legend">
                            <legend class="">Вход</legend>
                        </div>    
                        <div class="control-group">
                            <!-- Username -->
                            <?= form_label('Логин', 'lblUsername', array('class' => 'control-label', 'for' => "username")); ?>
                            <?= form_error('username'); ?>
                            <div class="controls">
                                <?= form_input('username', '', array('class' => 'input-xlarge', 'id' => "username", 'placeholder' => "")); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- Password-->
                            <?= form_label('Пароль', 'lblPassword', array('class' => 'control-label', 'for' => "password")); ?>
                            <?= form_error('password'); ?>
                            <div class="controls">
                                <?= form_password('password', '', array('class' => 'input-xlarge', 'id' => "password", 'placeholder' => "")); ?>
                            </div>
                        </div>


                        <div class="control-group">
                            <!-- Button -->
                            <div class="controls">
                                <?= form_submit('sub', 'Вход', array('class' => 'btn btn-success')); ?>
                                <a  class='signref' href="<?= site_url('login/signup'); ?>">Зарегистрироваться</a> 
                            </div>
                        </div>
                    </fieldset>
                    <?= form_close(); ?>               
                </div>
            </div>
        </div>
    </body>
</html>