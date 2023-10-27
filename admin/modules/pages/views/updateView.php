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
                        <label for="page_id">Id bài viết cần cập nhập</label>
                        <input class="form-control" type="text" name="page_id" id="page_id">
                    </div>
                    <?php echo form_error('page_id') ?>

                    <div class="form-group">
                        <label for="user_id">Id người cập nhập</label>
                        <input class="form-control" type="text" name="user_id" id="user_id">
                    </div>
                    <?php echo form_error('user_id') ?>

                    <div class="form-group">
                        <label for="page_title">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="page_title" id="page_title">
                    </div>
                    <?php echo form_error('page_title') ?>
                    <div class="form-group">
                        <label for="page_content">Nội dung bài viết</label>
                        <textarea name="page_content" class="form-control" id="page_content" cols="30" rows="5"></textarea>
                    </div>
                    <?php echo form_error('page_content') ?>

                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control" id="">
                            <option>Chọn danh mục</option>
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