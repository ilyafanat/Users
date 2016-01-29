<?php
defined("BASEPATH") OR exit("No direct script access allowed");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sign In</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/style.css"); ?>"/>
    </head>
    <body>
        <div class="" id="loginModal">
            <div class="modal-header">
                <?php if (isset($text)) { ?>
                    <div style="color: red">
                        <?php echo $text ?>
                    </div>
                <?php } ?>
            </div>
            <div class="modal-body">
                <div class="well">
                    <?php echo form_open("login/registrationUser", ["id" => "tab"]); ?>
                    <div id="legend">
                        <legend class="">Sign Up</legend>
                    </div> 
                    <div class="control-group">
                        <?php echo form_label("Username", "lblUsername", ["class" => "control-label", "for" => "tabUsername"]); ?>
                        <?php echo form_error("tabUsername"); ?>
                        <div class="controls">
                            <?php echo form_input("tabUsername", "", ["class" => "input-xlarge"]); ?>
                        </div>
                    </div>
                    <div class="control-group">

                        <?php echo form_label("Password", "lblPassword", ["class" => "control-label", "for" => "tabPassword"]); ?>
                        <?php echo form_error("tabPassword"); ?>
                        <div class="controls">
                            <?php echo form_password("tabPassword", "", ["class" => "input-xlarge"]); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php echo form_label("Email", "lblEmail", ["class" => "control-label", "for" => "tabEmail"]); ?>
                        <?php echo form_error("tabEmail"); ?>
                        <div class="controls">
                            <?php echo form_input("tabEmail", "", ["class" => "input-xlarge"]); ?>
                        </div>
                    </div>
                    <div>
                        <?php echo form_submit("sub", "Create", ["class" => "btn btn-primary"]); ?>
                        <a  class="signref" href="<?php echo site_url("login/index"); ?>">Sign In</a> 
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.min.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>">></script>
    </body>
</html>