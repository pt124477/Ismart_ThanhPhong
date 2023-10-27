
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Xaay dun form submit admin</title>
  <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
  <div id="wp_form">
    <form id="form_login" action="" method="post">
      <h1 class="title">Đăng nhập</h1>
      <input type="text" name="username" class="username" placeholder="username..." value="<?php echo set_value('username'); ?>">
      <?php echo form_error('username'); ?>
      <input type="password" name="password" class="password" placeholder="password...">
      <?php echo form_error('password'); ?>
      <input type="submit" name="btn_login" id="btn_login" value="Đăng nhập">
      <?php echo form_error('account'); ?>

    </form>
  </div>
</body>
</html>