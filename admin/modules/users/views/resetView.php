<?php get_header(); ?>
<?php get_sidebar('users') ?>
<div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhập tài khoản
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="pass_old">Mật khẩu cũ</label>
                    <input class="form-control" type="password" name="pass_old" id="pass_old">
                </div>
                <?php echo form_error('pass_old'); ?>
                <div class="form-group">
                    <label for="pass_new">Mật khẩu mới</label>
                    <input class="form-control" type="password" name="pass_new" id="pass_new">
                </div>
                <?php echo form_error('pass_new'); ?>
                <div class="form-group">
                    <label for="confirm_pass">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="confirm_pass" id="confirm_pass">
                </div> 
                <?php echo form_error('confirm_pass'); ?>                      

                <button type="submit" name="btn-reset" class="btn btn-primary">Cập nhập</button>
            </form>
        </div>
    </div>
</div>
</div>


<?php get_footer(); ?>