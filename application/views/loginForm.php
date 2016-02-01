<?php
defined("BASEPATH") OR exit("No direct script access allowed");
$title['title'] = 'Log In';
$this->load->view('header', $title)
?>
<body>
    <div class="" id="loginModal">
        <div class="modal-header">
            <?php if (isset($text)) { ?>
                <div style="color: #ff0000">
                    <?php echo $text ?>
                </div>
            <?php } ?>
        </div>
        <div class="modal-body">
            <div class="well">
                <?php echo form_open("login/loginUser", ["class" => "form-horizontal", "method" => "POST"]); ?>
                <fieldset>
                    <div id="legend">
                        <legend class="">Log In</legend>
                    </div>    
                    <div class="control-group">
                        <?php echo form_label("Login", "lblUsername", ["class" => "control-label", "for" => "username"]); ?>
                        <?php echo form_error("username"); ?>
                        <div class="controls">
                            <?php echo form_input("username", "", ["class" => "input-xlarge", "id" => "username", "placeholder" => ""]); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo form_label("Password", "lblPassword", ["class" => "control-label", "for" => "password"]); ?>
                        <?php echo form_error("password"); ?>
                        <div class="controls">
                            <?php echo form_password("password", "", ["class" => "input-xlarge", "id" => "password", "placeholder" => ""]); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <?php echo form_submit("sub", "Log in", ["class" => "btn btn-success"]); ?>
                            <a  class="signref" href="<?php echo site_url("login/signupUser"); ?>">Sign Up</a> 
                        </div>
                    </div>
                </fieldset>
                <?php echo form_close(); ?>               
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>">></script>
    <?php
    $this->load->view('footer');
    ?>