<?php
defined("BASEPATH") OR exit("No direct script access allowed");
?>
<div class="row">
    <div class="" id="loginModal col-md-4 col-xs-12">
        <div class="modal-header">
            <?php if (isset($error_text)) : ?>
                <div class="header-message">
                    <?php echo $text ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal-body col-md-3 col-xs-12 col-centered">
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
</div>
