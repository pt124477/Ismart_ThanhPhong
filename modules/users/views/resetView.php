
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Khôi phục mật khẩu</title>
  <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
  <div id="wp_form">
    <form id="form_login" action="" method="post">
      <h1 class="title">KHÔI PHỤC MẬT KHẨU</h1>
      <input type="text" name="email" class="email" placeholder="email..." value="<?php echo set_value('email'); ?>">
      <?php echo form_error('email'); ?>
   
      <input type="submit" name="btn_reset" id="btn_login" value="GIỬI YÊU CẦU">
      <?php echo form_error('account'); ?>

    </form>
    <a href="?mod=user&action=reg">Đăng ký</a>  <a href="?mod=user&action=login">Đăng nhập</a> 

  </div>
</body>
</html>