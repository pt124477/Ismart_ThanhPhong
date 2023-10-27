<?php get_header(); ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <?php foreach ($category_name as $item) {
                        if ($category_id == $item['category_id']) {
                    ?>
                            <h3 class="section-title fl-left"><?php echo $item['category_name'] ?></h3>
                        <?php } ?>
                    <?php } ?>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <!-- lấy image thông qua id  -->
                        <?php
                        $imageMap = array();
                        foreach ($product_images as $image_item) {
                            $imageMap[$image_item['image_id']] = $image_item['image_url'];
                        } ?>

                        <?php if (!empty($list_product)) { ?>
                            <?php foreach ($list_product as $item) {
                                $imageId = $item['image_id'];
                                $imageUrl = isset($imageMap[$imageId]) ? $imageMap[$imageId] : 'chưa có';
                            ?>
                                <li>
                                    <a href="?mod=product&action=detail&id=<?php echo $item['product_id'] ?>" title="" class="thumb">
                                        <img src="admin/public/images/<?php echo $imageUrl ?>">
                                    </a>
                                    <a href="?mod=product&action=detail&id=<?php echo $item['category_id'] ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo $item['product_price']; ?></span>
                                        <span class="old">20.900.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } else { ?>
                            <?php foreach ($category_name as $item) {
                                if ($category_id == $item['category_id']) {
                            ?>
                                    <p>Danh mục <b><?php echo $item['category_name'] ?></b> không có sản phẩm</p>
                                <?php }  ?>
                            <?php }  ?>
                        <?php }  ?>
                    </ul>



                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>