<?php get_header();
get_sidebar();
?>
<div id="wp-content">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm sản phẩm
            </div>
            <div class="card-body">
                <form id="upload_multi" enctype="multipart/form-data" action="" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="product_name" id="name">
                            </div>
                            <?php echo form_error('product_title') ?>
                            <div class="form-group">
                                <label for="name">Giá</label>
                                <input class="form-control" type="text" name="product_price" id="name">
                            </div>
                            <?php echo form_error('product_price') ?>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Mô tả sản phẩm</label>
                                <textarea name="product_desc" class="form-control" id="intro" cols="30" rows="5"></textarea>
                            </div>
                            <?php echo form_error('product_desc') ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="intro">Ảnh sản phẩm</label>
                        <input type="file" name="file" id="file" class="form-control" multiple=""/>
                    </div>         
                    <?php echo form_error('image_url') ?>


                    <div class="form-group">
                        <label for="intro">Chi tiết sản phẩm</label>
                        <textarea name="product_detail" class="form-control" id="intro" cols="30" rows="5"></textarea>
                    </div>
                    <?php echo form_error('product_detail') ?>


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



                    <button type="submit" name="btn_add" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>