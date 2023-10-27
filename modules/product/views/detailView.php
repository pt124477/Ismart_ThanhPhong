<?php get_header(); ?>
<div id="main-content-wp" class="clearfix detail-product-page">
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
            <div class="section" id="detail-product-wp">
                <!-- lấy image thông qua id  -->
                <?php
                $imageMap = array();
                foreach ($product_images as $image_item) {
                    $imageMap[$image_item['image_id']] = $image_item['image_url'];
                } ?>
                <?php if (!empty($product_item)) {
                    foreach ($product_item as $item) {
                        $imageId = $item['image_id'];
                        $imageUrl = isset($imageMap[$imageId]) ? $imageMap[$imageId] : 'chưa có';
                ?>
                        <div class="section-detail clearfix">
                            <div class="thumb-wp fl-left ">
                                <style>
                                   .zoomWrapper{
                                    position: relative;}
                                    /* #main-thumb img {
                                        width: 350px;
                                        height: 350px;
                                    } */

                                    
                                   
                                </style>
                                <a href="" title="" id="main-thumb">
                                    <img class="image_product" id="zoom" src="admin/public/images/<?php echo $imageUrl ?>" data-zoom-image="admin/public/images/<?php echo $imageUrl ?>" />
                                </a>
                                <div id="list-thumb" class="product-detail">
                                    <a href="" data-image="admin/public/images/<?php echo $imageUrl ?>" data-zoom-image="admin/public/images/<?php echo $imageUrl ?>">
                                        <img id="zoom" src="admin/public/images/<?php echo $imageUrl ?>" />
                                    </a>
                                    <a href="" data-image="admin/public/images/<?php echo $imageUrl ?>" data-zoom-image="admin/public/images/<?php echo $imageUrl ?>">
                                        <img id="zoom" src="admin/public/images/<?php echo $imageUrl ?>" />
                                    </a>
                                    <a href="" data-image="admin/public/images/<?php echo $imageUrl ?>" data-zoom-image="admin/public/images/<?php echo $imageUrl ?>">
                                        <img id="zoom" src="admin/public/images/<?php echo $imageUrl ?>" />
                                    </a>
                                    <a href="" data-image="admin/public/images/<?php echo $imageUrl ?>" data-zoom-image="admin/public/images/<?php echo $imageUrl ?>">
                                        <img id="zoom" src="admin/public/images/<?php echo $imageUrl ?>" />
                                    </a>
                                    <a href="" data-image="admin/public/images/<?php echo $imageUrl ?>" data-zoom-image="admin/public/images/<?php echo $imageUrl ?>">
                                        <img id="zoom" src="admin/public/images/<?php echo $imageUrl ?>" />
                                    </a>
                                    <a href="" data-image="admin/public/images/<?php echo $imageUrl ?>" data-zoom-image="admin/public/images/<?php echo $imageUrl ?>">
                                        <img id="zoom" src="admin/public/images/<?php echo $imageUrl ?>" />
                                    </a>
                                </div>
                            </div>
                            <div class="thumb-respon-wp fl-left">
                                <img src="public/images/img-pro-01.png" alt="">
                            </div>
                            <div class="info fl-right">
                                <h3 class="product-name"><?php echo $item['product_name'] ?></h3>
                                <div class="desc">
                                    <p><?php echo $item['product_detail'] ?></p>

                                </div>
                                <div class="num-product">
                                    <span class="title">Sản phẩm: </span>
                                    <span class="status">Còn hàng</span>
                                </div>
                                <p class="price"><?php echo $item['product_price'] ?></p>
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                            </div>
                        </div>

            </div>

            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p><?php echo $item['product_desc'] ?></p>
                </div>
            </div>

            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($list_product as $item2) {
                            if ($item['category_id'] == $item2['category_id']) {
                                $imageId = $item2['image_id'];
                                $imageUrl = isset($imageMap[$imageId]) ? $imageMap[$imageId] : 'chưa có';

                        ?>

                                <li>
                                    <a href="?mod=product&action=detail&id=<?php echo $item2['product_id'] ?>" title="" class="thumb">
                                        <img src="admin/public/images/<?php echo $imageUrl ?>">
                                    </a>
                                    <a href="?mod=product&action=detail&id=<?php echo $item2['product_id'] ?>" title="" class="product-name"><?php echo $item2['product_name'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo $item2['product_price'] ?></span>
                                        <span class="old"><?php echo $item2['product_price'] ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                      
                                        <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>