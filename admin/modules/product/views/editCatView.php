<?php
get_header();
get_sidebar();
?>
<div id="wp-content">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhập thông tin bài viết
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="category_name">Tên Danh mục</label>
                        <input class="form-control" type="text" name="category_name" id="category_name" value="<?php echo $get_cat_by_id['category_name'] ?>">
                    </div>
                    <?php echo form_error('category_name') ?>
                    <div class="form-group">
                        <label for="category_desc">Nội dung danh mục</label>
                        <textarea name="category_desc" class="form-control" id="category_desc" cols="30" rows="5"><?php echo $get_cat_by_id['category_desc'] ?></textarea>
                    </div>
                    <?php echo form_error('category_desc') ?>
               
                    <button type="submit" name="btn-edit" class="btn btn-primary">Cập nhập</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>