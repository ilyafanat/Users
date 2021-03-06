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
</div>
