<?php get_header(); ?>
<?php get_sidebar('users') ?>
<div id="wp-content">
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhập thông tin
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="fullname">Tên hiển thị</label>
                    <input class="form-control" type="text" name="fullname" id="fullname" value="<?php echo $info_users['fullname'] ?>">
                </div>
                <?php echo form_error('fullname'); ?>
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $info_users['username'] ?>" readonly= "ReadOnly">
                </div>
                <?php echo form_error('username'); ?>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password" value="<?php echo $info_users['password'] ?>">
                </div>
                <?php echo form_error('password'); ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $info_users['email'] ?>">
                </div>
                <?php echo form_error('email'); ?>
                <div class="form-group">
                    <label for="phone_number">Số điện thoại</label>
                    <input class="form-control" type="text" name="phone_number" id="phone_number" value="<?php echo $info_users['phone_number'] ?>">
                </div>
                <?php echo form_error('phone_number'); ?>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input class="form-control" type="text" name="address" id="address" value="<?php echo $info_users['address'] ?>">
                </div>
                <?php echo form_error('address'); ?>
               

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <button type="submit" name="btn-update" class="btn btn-primary">Cập nhập</button>
            </form>
        </div>
    </div>
</div>
</div>


<?php get_footer(); ?>