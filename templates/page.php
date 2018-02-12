<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo URL.'/assets/style.css' ;?>">
    <link rel="stylesheet" href="<?php echo URL.'/assets/bootstrap/css/bootstrap.min.css' ;?>">
    <script src="<?php echo URL.'/assets/jquery-3.3.1.min.js' ;?>"></script>
    <script src="<?php echo URL.'/assets/bootstrap/js/bootstrap.min.js' ;?>"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Guest book</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo $form; ?>
        </div>
    </div>
</div>

<?php if (!empty($messages)) { ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table>
                <tr>
                    <th><a href="<?php echo URL.'?sortby=user_name&sort='.((empty($_GET['sort']) || $_GET['sort'] == "ASC")?"DESC":"ASC"); ?>">User Name</a></th>
                    <th><a href="<?php echo URL.'?sortby=user_email&sort='.((empty($_GET['sort']) || $_GET['sort'] == "ASC")?"DESC":"ASC"); ?>">User E-mail</a></th>
                    <th>User IP address</th>
                    <th>User Browser Info</th>
                    <th>User Homepage</th>
                    <th>Message</th>
                    <th><a href="<?php echo URL.'?sortby=dt&sort='.((empty($_GET['sort']) || $_GET['sort'] == "ASC")?"DESC":"ASC"); ?>">Date</a></th>
                </tr>
                <?php foreach ($messages as $k=>$message) { ?>
                    <tr>
                        <td><?php echo $message['user_name']; ?></td>
                        <td><?php echo $message['user_email']; ?></td>
                        <td><?php echo $message['user_ip']; ?></td>
                        <td><?php echo $message['user_broeser']; ?></td>
                        <td><?php echo $message['user_homepage']; ?></td>
                        <td><?php echo $message['message']; ?></td>
                        <td><?php echo $message['dt']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
</body>

</html>
