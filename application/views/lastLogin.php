<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Логин</th>
                            <th>ip</th>
                            <th>email</th>
                            <th>Время последнего захода</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($logins); ++$i) { ?>
                            <tr>
                                <td><?= ($i + 1); ?></td>
                                <td><?= $logins[$i]['login']; ?></td>
                                <td><?= long2ip($logins[$i]['ip']); ?></td>
                                <td><?= $logins[$i]['email']; ?></td>
                                <td><?= $logins[$i]['last_activity'];; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>