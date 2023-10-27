<?php
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
                <form action="" enctype="multipart/form-data" method="POST">
                    <!-- <div class="form-group">
                        <label for="category_id">Id của danh mục</label>
                        <input class="form-control" type="text" name="catagory_id" id="name">
                    </div>-->
                    

                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="post_title" id="name">
                    </div>
                    <?php echo form_error('post_title') ?>
                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="post_content" class="form-control" id="content" cols="30" rows="5"></textarea>
                    </div>
                    <?php echo form_error('post_content') ?>

                    <div class="form-group">
                        <label for="intro">Ảnh sản phẩm</label>
                        <input type="file" name="file" class="form-control"/>
                    </div>
                    <?php echo form_error('image_url') ?>
                    
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="category_name" class="form-control" id="">
                            <option>Chọn danh mục</option>
                            <?php foreach ($show_post_category_name as $item) { ?>
                                <option><?php echo $item['category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php echo form_error('category_name') ?>
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