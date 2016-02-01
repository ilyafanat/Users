<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$title['title'] = 'Last login time';
$this->load->view('header', $title);
?>

<body>
    <div class="header">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="pull-right">
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Welcome, <?php echo $data[0]['login']; ?>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('login/logoutUser'); ?>"><i class="icon-off"></i> Logout</a></li>
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
                        <?php for ($i = 0; $i < count($data); ++$i) { ?>
                            <tr>
                                <td><?php echo ($i + 1); ?></td>
                                <td><?php echo $data[$i]['login']; ?></td>
                                <td><?php echo long2ip($data[$i]['ip']); ?></td>
                                <td><?php echo $data[$i]['email']; ?></td>
                                <td><?php echo $data[$i]['login_time']; ?></td>
                                <td><?php echo $data[$i]['logout_time']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    $this->load->view('footer');
    ?>
