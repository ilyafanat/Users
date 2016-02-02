<?php
defined("BASEPATH") OR exit("No direct script access allowed");
?>
<div class="header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Welcome, <?php echo $username; ?>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url("login/logoutUser"); ?>"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>LogIn</th>
                        <th>ip</th>
                        <th>email</th>
                        <th>login time</th>
                        <th>logout time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($last_login_data); ++$i) : ?>
                        <tr>
                            <td><?php echo ($i + 1); ?></td>
                            <td><?php echo $last_login_data[$i]["login"]; ?></td>
                            <td><?php echo long2ip($last_login_data[$i]["ip"]); ?></td>
                            <td><?php echo $last_login_data[$i]["email"]; ?></td>
                            <td><?php echo $last_login_data[$i]["logged_at"]; ?></td>
                            <td><?php echo $last_login_data[$i]["logouted_at"]; ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
