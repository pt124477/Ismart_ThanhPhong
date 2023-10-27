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
                        <label for="post_title">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="post_title" id="post_title" value="<?php echo $get_post_by_id['post_title'] ?>">
                    </div>
                    <?php echo form_error('post_title') ?>
                    <div class="form-group">
                        <label for="post_content">Nội dung bài viết</label>
                        <textarea name="post_content" class="form-control" id="post_content" cols="30" rows="5"><?php echo $get_post_by_id['post_content'] ?></textarea>
                    </div>
                    <?php echo form_error('post_content') ?>

                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="category_name" class="form-control" id="">
                            <option>Chọn danh mục</option>
                            <?php foreach ($show_post_category_name as $item) { ?>
                                <?php if ($get_post_by_id['category_id'] == $item['category_id']) { ?>
                                    <option selected><?php echo $item['category_name'] ?></option>
                                <?php }else{ ?>
                                    <option><?php echo $item['category_name'] ?></option>
                                    <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <?php echo form_error('category_name') ?>


                    <button type="submit" name="btn-edit" class="btn btn-primary">Cập nhập</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>