<?php 
function get_category_name(){
    $item = db_fetch_array("SELECT * FROM `tbl_product_categories`");
    if (!empty($item))
        return $item;
}
function get_product(){
    $item = db_fetch_array("SELECT * FROM `tbl_product`");
    if (!empty($item))
        return $item;
}
//lấy category_id
function get_category_id()
{
    $item = db_fetch_array("SELECT `category_id` FROM `tbl_product_categories`");
    if (!empty($item))
        return $item;
}
//lấy ảnh 
function get_product_by_image_id(){
    $item = db_fetch_array(
        "SELECT `tbl_product`.*, `tbl_images`.image_url
                            FROM `tbl_product`
                            INNER JOIN `tbl_images`  ON `tbl_product`.image_id = `tbl_images`.image_id
                            WHERE `tbl_product`.image_id = `tbl_images`.image_id"

    );
    if (!empty($item))
        return $item;
}
