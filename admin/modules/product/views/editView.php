<?php
get_header();
get_sidebar();
?>
<div id="wp-content">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhập thông tin sản phẩm
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="product_name">Tên sản phẩm</label>
                        <input class="form-control" type="text" name="product_name" id="product_name" value="<?php echo $get_product_by_id['product_name'] ?>">
                    </div>
                    <?php echo form_error('post_title') ?>
                    <div class="form-group">
                        <label for="product_desc">Mô tả sản phẩm</label>
                        <textarea name="product_desc" class="form-control" id="product_desc" cols="30" rows="5"><?php echo $get_product_by_id['product_desc'] ?></textarea>
                    </div>
                    <?php echo form_error('post_content') ?>

                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="category_name" class="form-control" id="">
                            <option>Chọn danh mục</option>
                            <?php foreach ($show_product_category_name as $item) { ?>
                                <?php if ($get_product_by_id['category_id'] == $item['category_id']) { ?>
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