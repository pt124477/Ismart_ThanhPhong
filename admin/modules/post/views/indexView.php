<<?php
get_header();
get_sidebar();
?>
<div id="wp-content">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="user_id">Id người dùng</label>
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
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    </div>



                    <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>