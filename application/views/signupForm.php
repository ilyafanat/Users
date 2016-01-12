<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
    </head>
    <body>
        <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.min.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>

        <div class="" id="loginModal">
            <div class="modal-header">
                <div style="color: red">
                    <?= $this->session->flashdata('status'); ?>
                    <?php $this->session->unset_userdata('status'); ?>   
                </div>
            </div>
            <div class="modal-body">
                <div class="well">
                    <?= form_open('login/signupUser', array('id' => 'tab')); ?>
                    <div id="legend">
                        <legend class="">Регистрация</legend>
                    </div> 

                    <div class="control-group">
                        <?= form_label('Логин', 'lblUsername', array('class' => 'control-label', 'for' => "tabUsername")); ?>
                        <?= form_error('tabUsername'); ?>
                        <div class="controls">
                            <?= form_input('tabUsername', '', array('class' => 'input-xlarge')); ?>
                        </div>
                    </div>
                    <div class="control-group">

                        <?= form_label('Пароль', 'lblPassword', array('class' => 'control-label', 'for' => "tabPassword")); ?>
                        <?= form_error('tabPassword'); ?>
                        <div class="controls">
                            <?= form_password('tabPassword', '', array('class' => 'input-xlarge')); ?>
                        </div>
                    </div>
                    <div class="control-group">

                        <?= form_label('Email', 'lblEmail', array('class' => 'control-label', 'for' => "tabEmail")); ?>
                        <?= form_error('tabEmail'); ?>
                        <div class="controls">
                            <?= form_input('tabEmail', '', array('class' => 'input-xlarge')); ?>
                        </div>
                    </div>
                    <div>
                        <?= form_submit('sub', 'Создать аккаунт', array('class' => 'btn btn-primary')); ?>
                        <a  class='signref' href="<?= site_url('login/index'); ?>">или Войти</a> 
                    </div>
                    <?= form_close(); ?>

                </div>
            </div>
        </div>