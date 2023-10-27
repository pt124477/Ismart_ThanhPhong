
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lấy lại mật khẩu</title>
  <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
  <div id="wp_form">
    <form id="form_login" action="" method="post">
      <h1 class="title">LẤY LẠI MẬT KHẨU</h1>
      <input type="text" name="password" class="password" placeholder="password..." value="<?php echo set_value('password'); ?>">
      <?php echo form_error('password'); ?>
   
      <input type="submit" name="btn_newpass" id="btn_login" value="LƯU MẬT KHẨU">
      <?php echo form_error('account'); ?>

    </form>
    <a href="?mod=user&action=reg">Đăng ký</a>  <a href="?mod=user&action=login">Đăng nhập</a> 

  </div>
</body>
</html>